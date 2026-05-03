tailwind.config = {
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                app: {
                    bg: 'rgb(var(--color-background) / <alpha-value>)',
                    surface: 'rgb(var(--color-surface) / <alpha-value>)',
                    body: 'rgb(var(--color-text) / <alpha-value>)',
                },
            },
        },
    },
};
