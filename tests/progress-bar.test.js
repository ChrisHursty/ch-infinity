const { JSDOM } = require('jsdom');

test('progress bar updates to 50% on half scroll', () => {
  const dom = new JSDOM(`<!DOCTYPE html><div id="progressBar"></div>`);
  global.window = dom.window;
  global.document = dom.window.document;

  // Mock scroll properties for documentElement
  Object.defineProperty(document.documentElement, 'scrollHeight', { value: 1000, writable: true });
  Object.defineProperty(document.documentElement, 'clientHeight', { value: 500, writable: true });
  Object.defineProperty(document.documentElement, 'scrollTop', { value: 250, writable: true });

  // Mirror properties on body as the script checks both
  Object.defineProperty(document.body, 'scrollHeight', { value: 1000, writable: true });
  Object.defineProperty(document.body, 'clientHeight', { value: 500, writable: true });
  Object.defineProperty(document.body, 'scrollTop', { value: 250, writable: true });

  require('../js/progress-bar.js');

  // Dispatch scroll event
  const event = new dom.window.Event('scroll');
  document.dispatchEvent(event);

  expect(document.getElementById('progressBar').style.width).toBe('50%');
});
