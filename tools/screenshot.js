const { chromium } = require('playwright');
const path = require('path');

const targets = [
  { url: 'https://www.jackontracks.nl', file: '../assets/img/cases/jackontracks-home.png', width: 1440, height: 900 },
  { url: 'https://www.jackontracks.nl', file: '../assets/img/cases/jackontracks-inner.png', width: 1440, height: 900, scroll: 1200 },
  { url: 'https://www.canservices.nl', file: '../assets/img/cases/canservices-home.png', width: 1440, height: 900 }
];

(async () => {
  const browser = await chromium.launch({ headless: true });
  const page = await browser.newPage();

  for (const target of targets) {
    await page.setViewportSize({ width: target.width, height: target.height });
    await page.goto(target.url, { waitUntil: 'networkidle' });
    if (target.scroll) {
      await page.evaluate(y => window.scrollTo(0, y), target.scroll);
      await page.waitForTimeout(1000);
    }
    const outPath = path.join(__dirname, target.file);
    await page.screenshot({ path: outPath, fullPage: true });
    console.log('Saved', outPath);
  }

  await browser.close();
})();
