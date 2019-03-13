
self.addEventListener('push', function(event) {
    // const data = JSON.parse(event.data.text());

    const options = {
        body: event.data.text(),
        icon: '',
        badge: '',
        // data: data.url
    };

    const notificationPromise = self.registration.showNotification(event.data.text(), options);
    event.waitUntil(notificationPromise);
});

self.addEventListener('notificationclick', function(event) {
    console.log('[Service Worker] Notification click Received.');
    const url = event.notification.data;
    event.notification.close();
    event.waitUntil(
        clients.openWindow(url)
    );
});