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

  const webcamImage = document.querySelector('[data-webcam-image]');
  if (webcamImage) {
    const webcam = webcamImage.closest('[data-webcam]');
    const fallback = webcam ? webcam.querySelector('[data-webcam-fallback]') : null;
    const message = fallback ? fallback.querySelector('[data-webcam-message]') : null;
    const detail = fallback ? fallback.querySelector('[data-webcam-detail]') : null;
    const source = webcamImage.dataset.webcamSource || webcamImage.src;
    const nonce = webcamImage.dataset.webcamNonce || '';
    let lastRefresh = Date.now();
    let currentObjectUrl = '';

    function setWebcamAvailable(available) {
      if (webcam) webcam.classList.toggle('is-unavailable', !available);
      if (fallback) fallback.hidden = available;
      if (available) {
        webcamImage.hidden = false;
      } else {
        if (message) message.textContent = 'Kamerabildet er midlertidig utilgjengelig';
        if (detail) detail.textContent = 'Prøv igjen om litt.';
      }
    }

    async function refreshWebcam() {
      lastRefresh = Date.now();
      try {
        const body = new URLSearchParams();
        body.set('bmfk_webcam_nonce', nonce);
        const response = await window.fetch(source, {
          method: 'POST',
          credentials: 'same-origin',
          cache: 'no-store',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: body.toString()
        });

        if (!response.ok) throw new Error('Webcam request failed');
        const imageBlob = await response.blob();
        if (imageBlob.type !== 'image/jpeg') throw new Error('Unexpected webcam response');

        const nextObjectUrl = URL.createObjectURL(imageBlob);
        webcamImage.onload = function () {
          if (currentObjectUrl) URL.revokeObjectURL(currentObjectUrl);
          currentObjectUrl = nextObjectUrl;
          setWebcamAvailable(true);
        };
        webcamImage.onerror = function () {
          URL.revokeObjectURL(nextObjectUrl);
          setWebcamAvailable(false);
        };
        webcamImage.src = nextObjectUrl;
      } catch (error) {
        setWebcamAvailable(false);
      }
    }

    refreshWebcam();
    window.setInterval(refreshWebcam, 5 * 60 * 1000);
    document.addEventListener('visibilitychange', function () {
      if (!document.hidden && Date.now() - lastRefresh > 60 * 1000) refreshWebcam();
    });
  }

  document.querySelectorAll('[data-bmfk-document-gate]').forEach(function (gate) {
    const endpoint = gate.dataset.endpoint || '';
    const documentId = gate.dataset.document || 'avinor';
    const form = gate.querySelector('[data-bmfk-document-form]');
    const passwordInput = gate.querySelector('[data-bmfk-document-password]');
    const submitButton = gate.querySelector('[data-bmfk-document-submit]');
    const status = gate.querySelector('[data-bmfk-document-status]');
    const unlocked = gate.querySelector('[data-bmfk-document-unlocked]');
    const documentLink = gate.querySelector('[data-bmfk-document-link]');

    if (!endpoint || !form || !passwordInput || !submitButton || !status || !unlocked || !documentLink) {
      return;
    }

    function setStatus(message, state) {
      status.textContent = message || '';
      if (state) {
        status.dataset.state = state;
      } else {
        delete status.dataset.state;
      }
    }

    function setBusy(busy) {
      form.setAttribute('aria-busy', String(busy));
      passwordInput.disabled = busy;
      submitButton.disabled = busy;
      submitButton.textContent = busy ? 'Kontrollerer …' : 'Lås opp';
    }

    function unlockDocument(url) {
      documentLink.href = url;
      form.hidden = true;
      unlocked.hidden = false;
      gate.dataset.state = 'unlocked';
      setStatus('', '');
    }

    async function requestAccess(password, quiet) {
      const body = new URLSearchParams();
      body.set('action', 'bmfk_avinor_access');
      body.set('document', documentId);
      if (password) body.set('password', password);

      if (!quiet) {
        setBusy(true);
        setStatus('', '');
      }

      try {
        const response = await window.fetch(endpoint, {
          method: 'POST',
          credentials: 'same-origin',
          cache: 'no-store',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: body.toString()
        });
        const result = await response.json();
        const data = result && result.data ? result.data : {};

        if (result && result.success && data.url) {
          unlockDocument(data.url);
          if (password) {
            document.dispatchEvent(new CustomEvent('bmfk:document-access-granted', {
              detail: { source: documentId }
            }));
          }
          return;
        }

        if (quiet && data.code === 'locked') return;

        setStatus(data.message || 'Kunne ikke kontrollere passordet. Prøv igjen.', 'error');
        if (data.code === 'incorrect') {
          passwordInput.value = '';
          passwordInput.focus();
        }
      } catch (error) {
        if (!quiet) setStatus('Kunne ikke kontrollere passordet. Prøv igjen.', 'error');
      } finally {
        if (!quiet && !form.hidden) setBusy(false);
      }
    }

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      requestAccess(passwordInput.value, false);
    });

    document.addEventListener('bmfk:document-access-granted', function (event) {
      const source = event.detail && event.detail.source ? event.detail.source : '';
      if (source !== documentId && gate.dataset.state !== 'unlocked') {
        requestAccess('', true);
      }
    });

    requestAccess('', true);
  });
}());
