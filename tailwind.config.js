/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: ['./resources/**/*.blade.php', './resources/**/*.js'],
    theme: {
        extend: {
            colors: {
                app: {
                    bg: 'rgb(var(--color-background) / <alpha-value>)',
                    surface: 'rgb(var(--color-surface) / <alpha-value>)',
                    body: 'rgb(var(--color-text) / <alpha-value>)',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
