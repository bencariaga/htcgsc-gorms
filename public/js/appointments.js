document.addEventListener('alpine:init', () => {
    Alpine.data('rescheduleModal', (config) => ({
        show: false,
        appointmentId: '',
        studentName: '',
        currentDate: '',
        holidays: config.holidays,
        totalSlots: config.totalSlots,
        modalId: config.modalId,

        openModal(detail) {
            if (detail && detail.id === this.modalId) {
                this.appointmentId = detail.formattedId || detail.appointmentId;
                this.studentName = detail.studentName;
                this.currentDate = detail.currentDate;
                this.show = true;
            }
        },

        get selectedDate() {
            return this.$wire.newDate;
        },

        get isWeekend() {
            if (!this.selectedDate) return false;
            const date = new Date(this.selectedDate);
            const day = date.getDay();
            return day === 0 || day === 6;
        },

        get holidayName() {
            if (!this.selectedDate) return null;
            return this.holidays[this.selectedDate] || null;
        },

        isSlotAvailable(slotValue, isoTime) {
            if (!this.selectedDate) return false;
            if (this.isWeekend || this.holidayName) return false;

            const slotDateTime = new Date(`${this.selectedDate}T${isoTime}`);

            if (slotDateTime < new Date()) return false;

            const occupied = this.$wire.unavailableSlots || [];

            return !occupied.includes(slotValue);
        },

        get canSubmit() {
            if (!this.selectedDate || !this.$wire.newTime) return false;
            
            const isoTime = this.getIsoTime(this.$wire.newTime);
            return this.isSlotAvailable(this.$wire.newTime, isoTime);
        },

        getIsoTime(slotValue) {
            const map = {
                '8:30 AM - 9:30 AM': '08:30:00',
                '9:30 AM - 10:30 AM': '09:30:00',
                '10:30 AM - 11:30 AM': '10:30:00',
                '1:30 PM - 2:30 PM': '13:30:00',
                '2:30 PM - 3:30 PM': '14:30:00',
                '3:30 PM - 4:30 PM': '15:30:00',
            };

            return map[slotValue] || '00:00:00';
        },

        resetModal() {
            this.show = false;
            this.appointmentId = '';
            this.studentName = '';
            this.$wire.set('newDate', null);
            this.$wire.set('newTime', null);
            this.$wire.set('unavailableSlots', []);
        },

        submitReschedule() {
            this.$dispatch('show-loading');
            this.$wire.rescheduleAppointment(this.appointmentId);
        }
    }));
});