const fs = require('fs');
const path = require('path');
const vm = require('vm');

const script = fs.readFileSync(
  path.join(__dirname, '..', 'themes', 'bodomfk-modern-theme', 'assets', 'js', 'site.js'),
  'utf8'
);

async function runTest() {
  const fetchCalls = [];
  const intervals = [];
  let responseNumber = 0;

  const weatherStations = { innerHTML: '<article>Gamle verdier</article>' };
  const weatherPanel = {
    dataset: { weatherEndpoint: 'https://example.com/wp-json/bmfk/v1/weather' },
    querySelector(selector) {
      return selector === '[data-weather-stations]' ? weatherStations : null;
    }
  };

  const document = {
    body: { classList: { toggle() {} } },
    hidden: false,
    querySelector(selector) {
      return selector === '[data-weather-panel]' ? weatherPanel : null;
    },
    querySelectorAll() { return []; },
    getElementById() { return null; },
    addEventListener() {},
    dispatchEvent() {}
  };

  const window = {
    location: { search: '', pathname: '/', hash: '', origin: 'https://example.com' },
    history: { state: null, replaceState() {} },
    innerWidth: 1280,
    requestAnimationFrame(callback) { callback(); },
    addEventListener() {},
    setTimeout() {},
    setInterval(callback, milliseconds) {
      intervals.push({ callback, milliseconds });
      return intervals.length;
    },
    fetch(url, options) {
      responseNumber += 1;
      fetchCalls.push({ url, options });
      return Promise.resolve({
        ok: true,
        json() {
          return Promise.resolve({ html: `<article>Oppdatering ${responseNumber}</article>` });
        }
      });
    }
  };

  vm.runInNewContext(script, {
    window,
    document,
    URL,
    URLSearchParams,
    CustomEvent: class CustomEvent {},
    Error
  });

  await new Promise((resolve) => setImmediate(resolve));

  if (fetchCalls.length !== 1) {
    throw new Error('Værpanelet skal hente nye data straks siden åpnes');
  }

  const firstUrl = new URL(fetchCalls[0].url);
  if (firstUrl.pathname !== '/wp-json/bmfk/v1/weather' || !firstUrl.searchParams.has('_')) {
    throw new Error('Værkallet mangler riktig endepunkt eller cache-bryter');
  }

  if (fetchCalls[0].options.cache !== 'no-store' || fetchCalls[0].options.credentials !== 'same-origin') {
    throw new Error('Værkallet skal omgå nettlesercache og holde seg på samme nettsted');
  }

  if (weatherStations.innerHTML !== '<article>Oppdatering 1</article>') {
    throw new Error('Nye værverdier ble ikke satt inn i panelet');
  }

  const weatherInterval = intervals.find((interval) => interval.milliseconds === 5 * 60 * 1000);
  if (!weatherInterval) {
    throw new Error('Værpanelet mangler fem minutters automatisk oppfriskning');
  }

  await weatherInterval.callback();
  if (fetchCalls.length !== 2 || weatherStations.innerHTML !== '<article>Oppdatering 2</article>') {
    throw new Error('Den planlagte vær-oppfriskningen oppdaterte ikke panelet');
  }
}

runTest()
  .then(() => console.log('Værpanelet oppdateres straks og hvert femte minutt.'))
  .catch((error) => {
    console.error(error.message);
    process.exitCode = 1;
  });
