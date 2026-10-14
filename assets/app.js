const body = document.body;
const switchLinks = document.querySelectorAll('[data-switch]');

switchLinks.forEach((link) => {
  link.addEventListener('click', (event) => {
    event.preventDefault();
    const view = link.dataset.switch;
    body.dataset.view = view;
    history.replaceState(null, '', view === 'register' ? '?view=register' : window.location.pathname);
    const input = document.querySelector(view === 'register' ? '#reg-name' : '#login-email');
    input?.focus({preventScroll: true});
  });
});
