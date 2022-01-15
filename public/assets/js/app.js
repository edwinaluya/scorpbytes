(function (d) {
    d.addEventListener('click', function (e) {
        var target = e.target;

        if (!target.matches) {
            return undefined;
        }

        if (target.dataset.toggle === 'menu') {
            var body = d.body;

            body.classList.toggle('nav:open');

            if (body.classList.contains('nav:open')) {
                target.textContent = 'Close';
            } else {
                target.textContent = 'Menu';
            }
        }
    });
}(document));