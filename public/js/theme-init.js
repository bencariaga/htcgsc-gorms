(function () {
    const sd = localStorage.getItem('_x_sidebarOpen');
    const dm = localStorage.getItem('_x_darkMode');

    if (dm === 'true') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    const style = document.createElement('style');
    style.id = 'anti-flash-style';
    style.innerHTML = ['[x-cloak] { display: none !important; }', '.sidebar-lock {', `    width: ${sd === 'false' ? '5rem' : '18rem'} !important;`, '    transition: none !important;', '}'].join('\n');

    document.head.appendChild(style);
})();
