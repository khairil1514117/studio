export function initCursor() {
  if (!matchMedia('(pointer:fine)').matches || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  document.documentElement.classList.add('fine');
  const dot = document.getElementById('cur-dot'), ring = document.getElementById('cur-ring'), label = document.getElementById('cur-label');
  let x = innerWidth / 2, y = innerHeight / 2, rx = x, ry = y;
  addEventListener('mousemove', e => { x = e.clientX; y = e.clientY; });
  (function loop() {
    rx += (x - rx) * .15; ry += (y - ry) * .15;
    dot.style.transform = `translate(${x}px,${y}px)`; ring.style.transform = `translate(${rx}px,${ry}px)`;
    requestAnimationFrame(loop);
  })();
  document.addEventListener('mouseover', e => {
    const c = e.target.closest('[data-cursor]'), l = e.target.closest('a,button');
    if (c) { ring.classList.add('big-r'); label.textContent = c.dataset.cursor; }
    else if (l) { ring.classList.add('big-r'); label.textContent = '→'; }
    else { ring.classList.remove('big-r'); label.textContent = ''; }
  });
  // Magnetic buttons
  document.querySelectorAll('[data-magnetic]').forEach(b => {
    b.addEventListener('mousemove', e => { const r = b.getBoundingClientRect(); b.style.transform = `translate(${(e.clientX - r.left - r.width / 2) * .25}px,${(e.clientY - r.top - r.height / 2) * .25}px)`; });
    b.addEventListener('mouseleave', () => (b.style.transform = ''));
  });
}
