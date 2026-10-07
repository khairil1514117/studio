import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);

export function initAnimations() {
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const loader = document.getElementById('loader');
  const nav = document.getElementById('nav');
  const mobile = document.getElementById('mobile-menu'), burger = document.getElementById('burger');

  // Nav: scrolled state, burger, smooth anchor scroll
  const onScroll = () => nav.classList.toggle('nav-scrolled', scrollY > 40);
  addEventListener('scroll', onScroll, { passive: true }); onScroll();
  burger?.addEventListener('click', () => { const o = mobile.classList.toggle('hidden'); burger.setAttribute('aria-expanded', String(!o)); });
  document.querySelectorAll('a[href^="#"]').forEach(a => a.addEventListener('click', e => {
    const t = document.querySelector(a.getAttribute('href')); if (!t) return;
    e.preventDefault(); mobile?.classList.add('hidden');
    t.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth' });
  }));

  // Count-up (dasar HTML sudah berisi angka akhir, jadi aman tanpa JS)
  document.querySelectorAll('[data-count]').forEach(el => {
    const end = +el.dataset.count, o = { v: 0 };
    if (reduce) return;
    ScrollTrigger.create({ trigger: el, start: 'top 90%', once: true, onEnter: () => gsap.to(o, { v: end, duration: 1.6, ease: 'power2.out', onUpdate: () => (el.textContent = String(Math.round(o.v)).padStart(end < 10 ? 2 : 0, '0')) }) });
  });

  // Contact form validation
  const form = document.getElementById('contact-form');
  form?.addEventListener('submit', e => {
    e.preventDefault(); let ok = true;
    form.querySelectorAll('[required]').forEach(f => {
      const err = f.parentElement.querySelector('.err'); let m = '';
      if (!f.value.trim()) m = 'Wajib diisi.'; else if (f.type === 'email' && !/^\S+@\S+\.\S+$/.test(f.value)) m = 'Email tidak valid.';
      err.textContent = m; err.classList.toggle('hidden', !m); f.classList.toggle('border-red-400', !!m); if (m) ok = false;
    });
    document.getElementById('form-ok').classList.toggle('hidden', !ok); if (ok) form.reset();
  });

  // Loader selesai -> intro
  const finish = () => {
    loader.remove();
    if (reduce) return;
    gsap.from('.hl', { yPercent: 40, opacity: 0, filter: 'blur(10px)', duration: 1.2, stagger: .2, ease: 'power3.out' });
    gsap.from('#hero-media', { opacity: 0, scale: .94, duration: 1.4, delay: .5, ease: 'power3.out' });
    scrollTriggers();
  };
  const bar = document.getElementById('loader-bar'), pct = document.getElementById('loader-pct');
  const p = { v: 0 };
  gsap.to(p, { v: 100, duration: reduce ? .1 : 1.1, ease: 'power1.inOut', onUpdate: () => { bar.style.width = p.v + '%'; pct.textContent = Math.round(p.v) + '%'; }, onComplete: () => gsap.to(loader, { opacity: 0, duration: .5, onComplete: finish }) });
  setTimeout(() => loader.isConnected && finish(), 4000); // pengaman

  function scrollTriggers() {
    const mm = gsap.matchMedia();
    gsap.utils.toArray('[data-reveal]').forEach(el => gsap.from(el, { y: 50, opacity: 0, duration: 1, ease: 'power3.out', scrollTrigger: { trigger: el, start: 'top 88%' } }));
    gsap.utils.toArray('.mf').forEach((el, i) => gsap.from(el, { y: 60, opacity: 0, filter: 'blur(12px)', duration: 1.1, ease: 'power3.out', scrollTrigger: { trigger: el, start: 'top 85%' } }));
    gsap.utils.toArray('[data-img-reveal],#reel,.gal-item').forEach(el => gsap.from(el, { clipPath: 'inset(12% 8% 12% 8%)', opacity: 0, duration: 1.3, ease: 'power3.out', scrollTrigger: { trigger: el, start: 'top 88%' } }));
    gsap.utils.toArray('[data-img-reveal] img').forEach(img => gsap.from(img, { scale: 1.2, duration: 1.6, ease: 'power3.out', scrollTrigger: { trigger: img, start: 'top 90%' } }));
    mm.add('(min-width: 768px)', () => {
      gsap.to('#hero-media', { yPercent: -15, ease: 'none', scrollTrigger: { trigger: '#home', start: 'top top', end: 'bottom top', scrub: true } });
      const hs = document.getElementById('hs');
      gsap.to(hs, { x: () => -(hs.scrollWidth - innerWidth), ease: 'none', scrollTrigger: { trigger: '#activities', start: 'top top', end: () => '+=' + (hs.scrollWidth - innerWidth), pin: true, scrub: 1, invalidateOnRefresh: true } });
    });
    // Mobile: horizontal swipe native (overflow-x), tanpa pin.
    mm.add('(max-width: 767px)', () => { const hs = document.getElementById('hs'); hs.parentElement.style.overflowX = 'auto'; });
    let t; addEventListener('resize', () => { clearTimeout(t); t = setTimeout(() => ScrollTrigger.refresh(), 200); });
  }
}
