function otpTimer(expiryTimestamp) {
    return {
        expiry: expiryTimestamp * 1000,
        remaining: 0,

        init() {
            this.updateTimer();
            setInterval(() => this.updateTimer(), 1000);
        },

        updateTimer() {
            this.remaining = Math.max(
                0,
                Math.round((this.expiry - Date.now()) / 1000),
            );
        },

        resetTimer(seconds) {
            this.expiry = Date.now() + seconds * 1000;
            this.updateTimer();
        },
    };
}

function otpHandler(component) {
    return {
        focusNext(index) {
            if (this.$refs["otp" + index]) this.$refs["otp" + index].focus();
        },

        checkComplete() {
            const otpValues = Array.from(
                { length: 6 },
                (_, i) => this.$refs["otp" + i]?.value || "",
            );

            if (otpValues.every((val) => /^\d$/.test(val))) {
                component.verify();
            }
        },

        handleInput(e, index) {
            const value = e.target.value;
            if (!/^\d$/.test(value)) return (e.target.value = "");

            component.set(`otp_array.${index}`, value);

            if (index < 5) {
                this.focusNext(index + 1);
            } else {
                this.checkComplete();
            }
        },

        handleBackspace(e, index) {
            if (!e.target.value && index > 0) {
                this.focusNext(index - 1);
                this.$refs["otp" + (index - 1)].value = "";
                component.set(`otp_array.${index - 1}`, "");
            }
        },

        handleArrows(e, index) {
            if (e.key === "ArrowLeft" && index > 0) this.focusNext(index - 1);
            if (e.key === "ArrowRight" && index < 5) this.focusNext(index + 1);
        },

        handlePaste(e) {
            e.preventDefault();
            const data = e.clipboardData.getData("text").trim().slice(0, 6);
            if (!/^\d+$/.test(data)) return;

            data.split("").forEach((digit, i) => {
                if (this.$refs["otp" + i]) {
                    this.$refs["otp" + i].value = digit;
                    component.set(`otp_array.${i}`, digit);
                }
            });

            if (data.length === 6) {
                this.checkComplete();
            }
        },
    };
}
