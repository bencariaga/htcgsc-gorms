document.addEventListener("livewire:init", () => {
    const el = (id) => document.getElementById(id);

    const elements = {
        screen: el("loading-screen"),
        message: el("loading-message"),
        person: el("loading-person"),
    };

    window.addEventListener("show-loading-accounts", ({ detail }) => {
        const { screen, message, person } = elements;

        if (!screen) return;
        if (message) message.textContent = detail.message;
        if (person) person.textContent = detail.userName;

        screen.classList.replace("hidden", "flex");
    });

    window.addEventListener("hide-loading-accounts", () => {
        const { screen } = elements;
        if (screen) screen.classList.replace("flex", "hidden");
    });
});
