import { gsap } from 'gsap';

export function initGallery() {
  const items = [...document.querySelectorAll('.gal-item')];
  const filters = document.querySelectorAll('[data-filter]');
  const lb = document.getElementById('lightbox'), img = document.getElementById('lb-img');
  let visible = items, idx = 0;

  filters.forEach(b => b.addEventListener('click', () => {
    filters.forEach(x => x.classList.toggle('btn-fill', x === b));
    const f = b.dataset.filter;
    const hide = items.filter(i => f !== 'all' && i.dataset.cat !== f);
    visible = items.filter(i => !hide.includes(i));
    gsap.to(items, { opacity: 0, scale: .92, duration: .25, onComplete: () => {
      items.forEach(i => (i.style.display = hide.includes(i) ? 'none' : 'block'));
      gsap.to(visible, { opacity: 1, scale: 1, duration: .5, stagger: .05, clearProps: 'clipPath' });
    } });
  }));

  const show = i => {
    idx = (i + visible.length) % visible.length; const it = visible[idx];
    img.src = it.dataset.src; img.alt = it.dataset.title;
    document.getElementById('lb-title').textContent = it.dataset.title; document.getElementById('lb-cat').textContent = it.dataset.cat;
  };
  const open = i => { show(i); lb.classList.remove('hidden'); lb.classList.add('flex'); gsap.fromTo(lb, { opacity: 0 }, { opacity: 1, duration: .4 }); };
  const close = () => { lb.classList.add('hidden'); lb.classList.remove('flex'); };
  items.forEach(it => it.addEventListener('click', () => open(visible.indexOf(it))));
  lb.querySelector('[data-close]').addEventListener('click', close);
  lb.querySelector('[data-prev]').addEventListener('click', () => show(idx - 1));
  lb.querySelector('[data-next]').addEventListener('click', () => show(idx + 1));
  addEventListener('keydown', e => { if (lb.classList.contains('hidden')) return; if (e.key === 'Escape') close(); if (e.key === 'ArrowLeft') show(idx - 1); if (e.key === 'ArrowRight') show(idx + 1); });
}
