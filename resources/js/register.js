class webNotificationRegister {
    constructor() {
        if ('serviceWorker' in navigator && 'PushManager' in window) {
            this.applicationServerPublicKey = 'BFs5b6Ou_LrVlhLo6hV1r-zD1LjEF9QfQYj84st0s0qACMlN67XnTfzgvm31xJgqTsZQiBNuw1imVb0HYoENiI0';
            this.isSubscribed   = false;
            this.swRegistration = null;

            navigator.serviceWorker.register(
                '/sw.js?' + new Date().getTime(),
                {scope: '/'}
            ).then((response) => {
                this.swRegistration = response;

                this.subscribeUser().then((subscription) => {
                    // console.log(JSON.stringify(subscription));
                    this.updateSubscriptionOnServer(subscription, true);
                    this.isSubscribed = true;
                }).catch((err) => {});
            }).catch((err) => {});
        }
    }

    subscribeUser() {
        const applicationServerKey = webNotificationRegister.urlB64ToUint8Array(this.applicationServerPublicKey);

        return this.swRegistration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: applicationServerKey
        })
    }

    unsubscribeUser() {
        let sub = null;

        this.swRegistration.pushManager.getSubscription({}).then((subscription) => {
            if (subscription) {
                sub = subscription;
                return subscription.unsubscribe();
            }
        }).catch(function (error) {
            console.log('Error unsubscribed', error);
        }).then(() => {
            if (sub) this.updateSubscriptionOnServer(sub, false);

            console.log('User is unsubscribed.');
            this.isSubscribed = false;
        });
    }

    updateSubscriptionOnServer(subscription, flag) {
        if (subscription) {
            const w = window,
                d = document,
                e = d.documentElement,
                g = d.getElementsByTagName('body')[0],
                x = w.innerWidth || e.clientWidth || g.clientWidth,
                y = w.innerHeight || e.clientHeight || g.clientHeight;

            const data = {
                subscription: JSON.parse(JSON.stringify(subscription)),
                info: {
                    host: window.location.host,
                    screen: {x: x, y: y}
                },
                isSubscribe: flag,
                target: 'dinRoom',
                user: 'sidraw'
            };

            window.$http.put(
                'http://localhost:9010/api/web-push/subscribe',
                JSON.stringify(data)
            ).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        }
    }

    static urlB64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/-/g, '+')
            .replace(/_/g, '/');

        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }

        return outputArray;
    }
}

const webPush = new webNotificationRegister();
