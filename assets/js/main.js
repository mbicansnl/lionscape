(function () {
  'use strict';

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function qs(selector, scope) {
    return (scope || document).querySelector(selector);
  }

  function qsa(selector, scope) {
    return Array.from((scope || document).querySelectorAll(selector));
  }

  function smoothScrollTo(target) {
    const el = document.getElementById(target);
    if (!el) return;
    const behavior = prefersReducedMotion ? 'auto' : 'smooth';
    el.scrollIntoView({ behavior, block: 'start' });
  }

  function initNav() {
    const toggle = qs('.nav__toggle');
    const menu = qs('#nav-menu');
    const links = qsa('.nav__link');
    if (!toggle || !menu) return;

    const focusableSelectors = 'a, button';
    let lastFocused = null;

    function setOpen(isOpen) {
      menu.classList.toggle('is-open', isOpen);
      toggle.setAttribute('aria-expanded', String(isOpen));
      document.body.classList.toggle('nav-open', isOpen);
      if (isOpen) {
        lastFocused = document.activeElement;
        const first = qs(focusableSelectors, menu);
        first && first.focus();
      } else if (lastFocused) {
        lastFocused.focus({ preventScroll: true });
      }
    }

    toggle.addEventListener('click', () => {
      const isOpen = menu.classList.contains('is-open');
      setOpen(!isOpen);
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && menu.classList.contains('is-open')) {
        setOpen(false);
      }
      if (!menu.classList.contains('is-open') || event.key !== 'Tab') return;
      const focusables = qsa(focusableSelectors, menu);
      if (focusables.length === 0) return;
      const first = focusables[0];
      const last = focusables[focusables.length - 1];
      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    });

    links.forEach((link) => {
      link.addEventListener('click', (event) => {
        const href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
          event.preventDefault();
          setOpen(false);
          smoothScrollTo(href.replace('#', ''));
        }
      });
    });
  }

  function initSmoothAnchors() {
    qsa('a[href^="#"]:not(.nav__link)').forEach((anchor) => {
      anchor.addEventListener('click', (event) => {
        const href = anchor.getAttribute('href');
        if (!href) return;
        const targetId = href.replace('#', '');
        if (!targetId) return;
        event.preventDefault();
        smoothScrollTo(targetId);
      });
    });
  }

  function initFaq() {
    qsa('.faq__item').forEach((item) => {
      const button = qs('.faq__question', item);
      const answer = qs('.faq__answer', item);
      if (!button || !answer) return;
      button.addEventListener('click', () => {
        const isOpen = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', String(!isOpen));
        answer.hidden = isOpen;
      });
    });
  }

  function initCookieBanner() {
    const banner = qs('.cookie-banner');
    const acceptBtn = qs('[data-cookie-accept]');
    if (!banner || !acceptBtn || !window.localStorage) return;
    const consentKey = 'lionscape_cookie_consent';
    const hasConsent = localStorage.getItem(consentKey);
    if (hasConsent) {
      banner.classList.add('is-hidden');
    }
    acceptBtn.addEventListener('click', () => {
      localStorage.setItem(consentKey, 'accepted');
      banner.classList.add('is-hidden');
      document.dispatchEvent(new CustomEvent('lionscape:consent')); // placeholder hook
    });
  }

  function initActiveLinks() {
    const sections = qsa('section[id]');
    const navLinks = qsa('.nav__link');
    if (sections.length === 0 || navLinks.length === 0) return;
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          const id = entry.target.getAttribute('id');
          navLinks.forEach((link) => {
            const href = link.getAttribute('href') || '';
            const clean = href.split('#')[1];
            link.classList.toggle('is-active', clean === id);
          });
        });
      },
      { threshold: 0.3 }
    );
    sections.forEach((section) => observer.observe(section));
  }

  function init() {
    initNav();
    initSmoothAnchors();
    initFaq();
    initCookieBanner();
    initActiveLinks();
  }

  document.addEventListener('DOMContentLoaded', init);
})();
