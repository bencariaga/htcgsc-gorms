document.addEventListener('livewire:init', () => {
    const getScreen = () => el('loading-screen');
    const getMessage = () => el('loading-message');
    const getPerson = () => el('loading-person');

    window.addEventListener('show-loading-accounts', ({ detail }) => {
        const screen = getScreen();
        if (!screen) return;

        const message = getMessage();
        const person = getPerson();

        if (message) message.textContent = detail.message;
        if (person) person.textContent = detail.userName;

        screen.classList.replace('hidden', 'flex');
    });

    window.addEventListener('hide-loading-accounts', () => {
        getScreen()?.classList.replace('flex', 'hidden');
    });
});
