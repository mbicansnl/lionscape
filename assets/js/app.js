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
      attachServiceSwitcher();
      attachMakeoverEffects();
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
    const setMenuState = open => {
      const currentNav = qs('.nav');
      const currentButton = qs('.menu-toggle');
      if (!currentNav || !currentButton) return;
      currentNav.classList.toggle('open', open);
      document.body.classList.toggle('menu-open', open);
      currentButton.setAttribute('aria-expanded', String(open));
    };

    menuButton.onclick = () => {
      const open = !nav.classList.contains('open');
      setMenuState(open);
    };

    qsa('a', nav).forEach(link => {
      link.addEventListener('click', () => setMenuState(false));
    });

    if (!document.body.dataset.menuBound) {
      document.body.dataset.menuBound = 'true';
      document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
          setMenuState(false);
        }
      });
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 960) {
          setMenuState(false);
        }
      });
    }
  }

  qsa('[data-language-toggle] a').forEach(link => {
    link.onclick = evt => {
      evt.preventDefault();
      switchLanguage(link.dataset.lang || 'nl');
    };
  });
}

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/pwa/sw.js').catch(() => {});
  });
}

attachInteractions();
attachServiceSwitcher();
handleStoredLanguage();

function attachServiceSwitcher() {
  qsa('[data-service-switcher]').forEach(switcher => {
    if (switcher.serviceRotationId) {
      window.clearTimeout(switcher.serviceRotationId);
      switcher.serviceRotationId = null;
    }

    const tabs = qsa('[data-service-tab]', switcher);
    const panels = qsa('[data-service-panel]', switcher);
    const progressItems = qsa('.service-progress span', switcher);
    if (!tabs.length || !panels.length) return;

    const indexes = tabs
      .map(tab => Number(tab.dataset.serviceTab))
      .filter(Number.isInteger)
      .sort((a, b) => a - b);
    if (!indexes.length) return;

    const getCurrentIndex = () => {
      const activeTab = tabs.find(tab => tab.classList.contains('is-active'));
      const activeIndex = activeTab ? Number(activeTab.dataset.serviceTab) : indexes[0];
      return indexes.includes(activeIndex) ? activeIndex : indexes[0];
    };

    let activeIndex = getCurrentIndex();
    const rotationDelay = 6000;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const getNextIndex = index => {
      const currentPosition = indexes.indexOf(index);
      return indexes[(currentPosition + 1) % indexes.length];
    };

    const restartRotation = () => {
      if (switcher.serviceRotationId) {
        window.clearTimeout(switcher.serviceRotationId);
        switcher.serviceRotationId = null;
      }
      queueNextRotation();
    };

    const setActive = index => {
      activeIndex = indexes.includes(index) ? index : indexes[0];
      switcher.dataset.activeService = String(activeIndex);

      tabs.forEach(tab => {
        const isActive = Number(tab.dataset.serviceTab) === activeIndex;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-selected', String(isActive));
        tab.tabIndex = isActive ? 0 : -1;
      });

      panels.forEach(panel => {
        const isActive = Number(panel.dataset.servicePanel) === activeIndex;
        panel.classList.toggle('is-active', isActive);
        panel.hidden = !isActive;
      });

      progressItems.forEach((item, itemIndex) => {
        item.classList.toggle('is-active', itemIndex === indexes.indexOf(activeIndex));
      });
    };

    const queueNextRotation = () => {
      if (reduceMotion) return;
      switcher.serviceRotationId = window.setTimeout(() => {
        setActive(getNextIndex(activeIndex));
        queueNextRotation();
      }, rotationDelay);
    };

    tabs.forEach(tab => {
      if (tab.dataset.serviceTabBound === 'true') return;
      tab.dataset.serviceTabBound = 'true';

      tab.addEventListener('click', () => {
        setActive(Number(tab.dataset.serviceTab));
        restartRotation();
      });

      tab.addEventListener('keydown', event => {
        if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;
        event.preventDefault();
        const currentPosition = indexes.indexOf(activeIndex);
        const nextIndex = event.key === 'Home'
          ? indexes[0]
          : event.key === 'End'
            ? indexes[indexes.length - 1]
            : indexes[(currentPosition + (event.key === 'ArrowRight' ? 1 : -1) + indexes.length) % indexes.length];
        setActive(nextIndex);
        restartRotation();
        tabs.find(item => Number(item.dataset.serviceTab) === activeIndex)?.focus();
      });
    });

    setActive(activeIndex);
    queueNextRotation();
  });
}

function attachMakeoverEffects() {
  const revealItems = qsa('.reveal-on-scroll');
  document.body.classList.add('effects-ready');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.16, rootMargin: '0px 0px -8% 0px' });
    revealItems.forEach(item => observer.observe(item));
  } else {
    revealItems.forEach(item => item.classList.add('is-visible'));
  }

  qsa('.magnetic').forEach(button => {
    button.addEventListener('pointermove', event => {
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
      const rect = button.getBoundingClientRect();
      const x = ((event.clientX - rect.left) / rect.width - 0.5) * 10;
      const y = ((event.clientY - rect.top) / rect.height - 0.5) * 10;
      button.style.transform = `translate(${x}px, ${y}px)`;
    });
    button.addEventListener('pointerleave', () => {
      button.style.transform = '';
    });
  });
}

attachMakeoverEffects();
