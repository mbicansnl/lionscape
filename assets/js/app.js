const state = {
  lang: window.__initialLang || 'nl',
  content: window.__content || {}
};

const qs = (selector, scope = document) => scope.querySelector(selector);
const qsa = (selector, scope = document) => Array.from(scope.querySelectorAll(selector));

function getParam(name) {
  const params = new URLSearchParams(window.location.search);
  return params.get(name);
}

function setLangPreference(lang) {
  state.lang = lang;
  localStorage.setItem('lang', lang);
  document.cookie = `lang_pref=${lang};path=/;max-age=31536000`;
}

async function switchLanguage(lang) {
  if (lang === state.lang) return;
  const page = qs('main')?.dataset.page || 'home';
  setLangPreference(lang);
  const url = new URL(window.location.href);
  url.searchParams.set('lang', lang);
  history.pushState({}, '', url.toString());

  try {
    const res = await fetch(`${url.pathname}?page=${page}&lang=${lang}&fragment=1`);
    if (!res.ok) throw new Error('Lang fetch failed');
    const data = await res.json();
    if (data.header && data.main && data.footer) {
      qs('header')?.replaceWith(fragmentFromString(data.header));
      qs('main')?.replaceWith(fragmentFromString(`<main id="main" data-page="${page}">${data.main}</main>`));
      qs('footer')?.replaceWith(fragmentFromString(data.footer));
      document.documentElement.lang = data.lang;
      document.title = data.title;
      updateMeta('description', data.description);
      updateCanonical(data.canonical);
      attachInteractions();
    }
  } catch (error) {
    window.location.href = `${url.pathname}?page=${page}&lang=${lang}`;
  }
}

function fragmentFromString(html) {
  const template = document.createElement('template');
  template.innerHTML = html.trim();
  return template.content.firstElementChild;
}

function updateMeta(name, content) {
  let el = qs(`meta[name="${name}"]`);
  if (!el) {
    el = document.createElement('meta');
    el.setAttribute('name', name);
    document.head.appendChild(el);
  }
  el.setAttribute('content', content || '');
}

function updateCanonical(href) {
  let link = qs('link[rel="canonical"]');
  if (!link) {
    link = document.createElement('link');
    link.rel = 'canonical';
    document.head.appendChild(link);
  }
  link.href = href;
}

function handleStoredLanguage() {
  const urlLang = getParam('lang');
  const stored = localStorage.getItem('lang');
  if (!urlLang && stored && stored !== state.lang) {
    switchLanguage(stored);
  }
}

function attachInteractions() {
  const menuButton = qs('.menu-toggle');
  const nav = qs('.nav');
  if (menuButton && nav) {
    menuButton.onclick = () => {
      const open = nav.classList.toggle('open');
      document.body.classList.toggle('menu-open', open);
      menuButton.setAttribute('aria-expanded', String(open));
    };
  }

  qsa('[data-language-toggle] a').forEach(link => {
    link.onclick = evt => {
      evt.preventDefault();
      switchLanguage(link.dataset.lang || 'nl');
    };
  });

  qsa('.pricing-structures details').forEach((details, index, list) => {
    details.addEventListener('toggle', () => {
      const nextDetails = list[index + 1];
      if (!nextDetails) return;
      nextDetails.open = details.open;
    });
  });
}

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/pwa/sw.js').catch(() => {});
  });
}

attachInteractions();
handleStoredLanguage();
