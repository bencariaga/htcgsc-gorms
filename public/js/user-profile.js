const el = (id) => document.getElementById(id);

const isChanged = (input) => {
    if (!input) return false;

    const current = input.value.trim();
    const original = input.getAttribute('data-original') || "";

    return current !== original;
};

const getChangedFields = () => {
    const changes = [];

    const mapping = {
        firstNameInput: 'first name',
        lastNameInput: 'last name',
        middleNameInput: 'middle name',
        suffixHiddenInput: 'suffix',
        emailInput: 'email address',
        phoneInput: 'phone number'
    };

    Object.entries(mapping).forEach(([id, label]) => {
        const element = el(id);
        if (element && isChanged(element)) changes.push(label);
    });

    return changes;
};

window.toggleModal = (show) => {
    const modal = el('passwordModal');
    if (!modal) return;

    if (show) {
        const changed = getChangedFields();

        if (changed.length > 0) {
            const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });
            return alert(`You cannot change your password while changing your ${formatter.format(changed)}.`);
        }

        modal.classList.replace('hidden', 'flex');
    } else {
        modal.classList.replace('flex', 'hidden');
    }
};

window.addEventListener('pageshow', (e) => {
    if (e.persisted) {
        ['loadingPassword', 'loadingProfile'].forEach(id => {
            const loader = document.getElementById(id);

            if (loader) {
                loader.classList.remove('flex');
                loader.classList.add('hidden');
            }
        });
    }
});

