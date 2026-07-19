(function () {
  const button = document.querySelector('[data-menu-toggle]');
  const navigation = document.querySelector('[data-navigation]');

  function labelDarkModeSwitch() {
    const darkModeSwitch = document.querySelector('.wp-dark-mode-switch[role="button"]');
    if (darkModeSwitch) {
      darkModeSwitch.setAttribute('aria-label', 'Bytt mellom lys og mørk visning');
    }
  }

  labelDarkModeSwitch();
  document.addEventListener('DOMContentLoaded', function () {
    labelDarkModeSwitch();
    window.setTimeout(labelDarkModeSwitch, 500);
  }, { once: true });

  if (button && navigation) {
    const buttonLabel = button.querySelector('.screen-reader-text');

    function setMenuState(open) {
      button.setAttribute('aria-expanded', String(open));
      navigation.classList.toggle('is-open', open);
      document.body.classList.toggle('menu-open', open);
      if (buttonLabel) buttonLabel.textContent = open ? 'Lukk meny' : 'Åpne meny';
    }

    button.addEventListener('click', function () {
      setMenuState(button.getAttribute('aria-expanded') !== 'true');
    });

    navigation.addEventListener('click', function (event) {
      if (event.target.closest('a')) setMenuState(false);
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
        setMenuState(false);
        button.focus();
      }
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > 900) setMenuState(false);
    });
  }
}());
