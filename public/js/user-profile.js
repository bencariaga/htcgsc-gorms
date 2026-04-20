document.addEventListener('DOMContentLoaded', () => {
    const el = (id) => document.getElementById(id);

    const elements = {
        profileForm: el('profileForm'),
        passwordForm: el('passwordForm'),
        profileLoading: el('loadingProfile'),
        passwordLoading: el('loadingPassword'),
        phoneInput: el('phoneInput'),
        firstName: el('firstNameInput'),
        lastName: el('lastNameInput'),
        middleName: el('middleNameInput'),
        email: el('emailInput'),
        suffixHiddenInput: el('suffixHiddenInput')
    };

    const isChanged = (input) => {
        if (!input) return false;

        const current = input.value.trim();
        const original = input.getAttribute('data-original') || "";

        return current !== original;
    };

    const getChangedFields = () => {
        const changes = [];

        const mapping = {
            firstName: 'first name',
            lastName: 'last name',
            middleName: 'middle name',
            suffixHiddenInput: 'suffix',
            email: 'email address',
            phoneInput: 'phone number'
        };

        Object.entries(mapping).forEach(([key, label]) => {
            if (isChanged(elements[key])) changes.push(label);
        });

        return changes;
    };

    const showLoading = (loader) => {
        if (!loader) return;

        loader.classList.remove('hidden');
        loader.classList.add('flex');
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

    if (elements.profileForm) {
        elements.profileForm.addEventListener('submit', (e) => {
            const nameChanged = ['firstName', 'lastName', 'middleName', 'suffixHiddenInput'].some(k => isChanged(elements[k]));
            const emailChanged = isChanged(elements.email);
            const phoneChanged = isChanged(elements.phoneInput);

            const required = [
                { val: elements.firstName.value.trim(), lab: 'a first name' },
                { val: elements.lastName.value.trim(), lab: 'a last name' },
                { val: elements.email.value.trim(), lab: 'an email address' }
            ];

            const empty = required.filter(f => !f.val).map(f => f.lab);
            const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });

            if (empty.length > 0) {
                e.preventDefault();
                return alert(`Please enter ${formatter.format(empty)}.`);
            }

            if (isChanged(elements.firstName) || isChanged(elements.middleName) || isChanged(elements.lastName)) {
                const names = [
                    { n: 'first name', v: elements.firstName.value.trim() },
                    { n: 'middle name', v: elements.middleName.value.trim() },
                    { n: 'last name', v: elements.lastName.value.trim() }
                ].filter(f => f.v.length < 2).map(f => f.n);

                if (names.length > 0) {
                    e.preventDefault();
                    return alert(`The ${formatter.format(names)} ${names.length > 1 ? 'must all' : 'must'} be at least 2 characters long.`);
                }
            }

            if (emailChanged && phoneChanged) {
                e.preventDefault();
                return alert('For security reasons, you cannot change your email address and phone number at the same time. Please update them one at a time.');
            }

            if (nameChanged && (emailChanged || phoneChanged)) {
                e.preventDefault();
                return alert(`You cannot change your name while changing your ${emailChanged ? 'email address' : 'phone number'}.`);
            }

            let errors = [];

            if (emailChanged && !/^[a-zA-Z0-9._%+-]+@(gmail\.com|online\.htcgsc\.edu\.ph)$/.test(elements.email.value)) {
                errors.push('a valid Gmail or HTCGSC email address');
            }

            const phoneValue = elements.phoneInput.value.replace(/\s+/g, '');

            if (phoneChanged && phoneValue !== '' && !/^(09|\+639)\d{9}$/.test(phoneValue)) {
                errors.push('a valid Philippine mobile number');
            }

            if (errors.length > 0) {
                e.preventDefault();
                return alert(`Please enter ${formatter.format(errors)}.`);
            }

            showLoading(elements.profileLoading);
        });
    }

    if (elements.passwordForm) {
        elements.passwordForm.addEventListener('submit', () => {
            const modal = el('passwordModal');
            if (modal) modal.classList.replace('flex', 'hidden');
            showLoading(elements.passwordLoading);
        });
    }
});

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
