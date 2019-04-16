export default {
    createDateRange: function(beginDiffDay, endDiffDay) {
        const todayDate = new Date();

        let beginDate = new Date(todayDate);
        beginDate.setDate(todayDate.getDate() + beginDiffDay);
        let endDate = new Date(todayDate);
        endDate.setDate(todayDate.getDate() + endDiffDay);

        return [
            beginDate,
            endDate
        ];
    },
    formatRDayToZhDay: function (rday) {
        if (rday < 0 || rday > 6) {
            return '';
        }

        const mapping = [
            '日',
            '一',
            '二',
            '三',
            '四',
            '五',
            '六',
        ];

        return mapping[rday];
    }
}