import { gsap } from 'gsap';

export function initVideo() {
  const modal = document.getElementById('video-modal'), mv = document.getElementById('modal-video');
  const open = src => { mv.src = src; modal.classList.remove('hidden'); modal.classList.add('flex'); gsap.fromTo(modal, { opacity: 0 }, { opacity: 1, duration: .4 }); mv.play().catch(() => {}); };
  const close = () => { mv.pause(); mv.removeAttribute('src'); modal.classList.add('hidden'); modal.classList.remove('flex'); };
  document.querySelectorAll('[data-video]').forEach(el => {
    el.addEventListener('click', () => open(el.dataset.video));
    el.addEventListener('keydown', e => e.key === 'Enter' && open(el.dataset.video));
  });
  modal.querySelector('[data-close]').addEventListener('click', close);
  modal.addEventListener('click', e => e.target === modal && close());
  addEventListener('keydown', e => e.key === 'Escape' && close());
  // Lazy-load video reel hanya saat mendekati viewport
  document.querySelectorAll('video[data-lazy-src]').forEach(v => new IntersectionObserver(([e], o) => { if (e.isIntersecting) { v.src = v.dataset.lazySrc; v.play().catch(() => {}); o.disconnect(); } }, { rootMargin: '300px' }).observe(v));
}
