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
  const carouselItems = [
    {
      tab: "Websites",
      title: "Website laten maken",
      description: "Sterke structuur, duidelijke CTA’s en meer aanvragen.",
      tags: ["Homepage", "Funnel", "SEO-basis"],
      status: "Bezoeker → CTA → Aanvraag",
    },
    {
      tab: "Apps",
      title: "App of systeem bouwen",
      description: "Dashboards, klantportalen en tools die werk simpeler maken.",
      tags: ["Dashboard", "Portaal", "MVP"],
      status: "Proces → Overzicht → Actie",
    },
    {
      tab: "AI-agents",
      title: "AI-agent automatisering",
      description: "Agents die leads opvolgen, vragen beantwoorden en acties klaarzetten.",
      tags: ["Leads", "E-mail", "Taken"],
      status: "Input → AI-agent → Opvolging",
    },
  ];

  qsa('[data-service-switcher]').forEach(switcher => {
    if (switcher.serviceRotationId) {
      window.clearInterval(switcher.serviceRotationId);
      switcher.serviceRotationId = null;
    }

    const tabs = qsa('[data-service-tab]', switcher);
    const panels = qsa('[data-service-panel]', switcher);
    const progressItems = qsa('.service-progress span', switcher);
    if (!tabs.length || !panels.length) return;

    const totalSlides = Math.min(carouselItems.length, tabs.length, panels.length);
    if (!totalSlides) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const rotationDelay = 5000;
    const state = {
      activeIndex: 0,
      isPaused: false,
    };

    const formatStatus = status => status
      .split('→')
      .map(part => part.trim())
      .map((part, index, parts) => index < parts.length - 1 ? `${part} <span>→</span>` : part)
      .join(' ');

    const setActiveIndex = index => {
      const activeIndex = (index + totalSlides) % totalSlides;
      const activeItem = carouselItems[activeIndex];
      state.activeIndex = activeIndex;
      switcher.dataset.activeService = String(activeIndex);

      tabs.forEach((tab, tabIndex) => {
        const item = carouselItems[tabIndex];
        const isActive = tabIndex === activeIndex;
        if (item) tab.textContent = item.tab;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-selected', String(isActive));
        tab.tabIndex = isActive ? 0 : -1;
      });

      panels.forEach((panel, panelIndex) => {
        const isActive = panelIndex === activeIndex;
        panel.classList.toggle('is-active', isActive);
        panel.hidden = !isActive;

        const item = carouselItems[panelIndex] || activeItem;
        const title = qs('h2', panel);
        const description = qs('p', panel);
        const tags = qs('.service-tags', panel);
        const status = qs('.service-status', panel);

        if (title) title.textContent = item.title;
        if (description) description.textContent = item.description;
        if (tags) tags.innerHTML = item.tags.map(tag => `<span>${tag}</span>`).join('');
        if (status) status.innerHTML = formatStatus(item.status);
      });

      progressItems.forEach(item => item.classList.remove('is-active'));
      if (!reduceMotion) switcher.offsetHeight;
      progressItems.forEach((item, itemIndex) => {
        item.classList.toggle('is-active', itemIndex === activeIndex);
      });
    };

    const rotate = () => {
      if (!state.isPaused) {
        setActiveIndex(state.activeIndex + 1);
      }
    };

    const restartRotation = () => {
      if (reduceMotion) return;
      if (switcher.serviceRotationId) window.clearInterval(switcher.serviceRotationId);
      switcher.serviceRotationId = window.setInterval(rotate, rotationDelay);
    };

    tabs.forEach((tab, tabIndex) => {
      if (tab.dataset.serviceTabBound === 'true') return;
      tab.dataset.serviceTabBound = 'true';

      tab.addEventListener('click', () => {
        setActiveIndex(tabIndex);
        restartRotation();
      });

      tab.addEventListener('keydown', event => {
        if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;
        event.preventDefault();
        const nextIndex = event.key === 'Home'
          ? 0
          : event.key === 'End'
            ? totalSlides - 1
            : (state.activeIndex + (event.key === 'ArrowRight' ? 1 : -1) + totalSlides) % totalSlides;
        setActiveIndex(nextIndex);
        restartRotation();
        tabs[nextIndex]?.focus();
      });
    });

    if (switcher.dataset.servicePauseBound !== 'true') {
      switcher.dataset.servicePauseBound = 'true';
      switcher.addEventListener('pointerenter', () => { state.isPaused = true; });
      switcher.addEventListener('pointerleave', () => { state.isPaused = false; });
      switcher.addEventListener('focusin', () => { state.isPaused = true; });
      switcher.addEventListener('focusout', event => {
        if (!switcher.contains(event.relatedTarget)) state.isPaused = false;
      });
    }

    const initialTab = tabs.findIndex(tab => tab.classList.contains('is-active'));
    setActiveIndex(initialTab >= 0 ? initialTab : 0);
    restartRotation();
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
