const fs = require('fs');
const path = require('path');
const vm = require('vm');

const script = fs.readFileSync(
  path.join(__dirname, '..', 'themes', 'bodomfk-modern-theme', 'assets', 'js', 'site.js'),
  'utf8'
);

function runStart(search) {
  let scrollCount = 0;
  let replacedUrl = '';

  const webcamSection = {
    scrollIntoView() {
      scrollCount += 1;
    }
  };

  const document = {
    body: { classList: { toggle() {} } },
    hidden: false,
    querySelector() { return null; },
    querySelectorAll() { return []; },
    getElementById(id) { return id === 'webkamera' ? webcamSection : null; },
    addEventListener() {},
    dispatchEvent() {}
  };

  const window = {
    location: { search, pathname: '/', hash: '' },
    history: {
      state: null,
      replaceState(state, title, url) {
        replacedUrl = url;
      }
    },
    innerWidth: 1280,
    requestAnimationFrame(callback) { callback(); },
    addEventListener(event, callback) {
      if (event === 'load') callback();
    },
    setTimeout() {},
    setInterval() {},
    fetch() { throw new Error('Unexpected fetch in PWA start test'); }
  };

  vm.runInNewContext(script, {
    window,
    document,
    URLSearchParams,
    CustomEvent: class CustomEvent {},
    Error
  });

  return { scrollCount, replacedUrl };
}

for (const query of ['?bmfk_pwa=webkamera', '?bmfk_pwa=webkamera/']) {
  const result = runStart(query);
  if (result.scrollCount < 1 || result.replacedUrl !== '/#webkamera') {
    throw new Error(`PWA-start feilet for ${query}`);
  }
}

const unrelated = runStart('?bmfk_pwa=forside');
if (unrelated.scrollCount !== 0 || unrelated.replacedUrl !== '') {
  throw new Error('En ukjent PWA-startverdi skal ikke flytte siden');
}

console.log('PWA-starten godtar både webkamera og webkamera/.');
