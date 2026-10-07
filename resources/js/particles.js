// Atur jumlah particle lewat atribut data-count pada <canvas> (particle-background.blade.php).
export function initParticles(canvas) {
  if (!canvas || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  const ctx = canvas.getContext('2d'); if (!ctx) return;
  const fine = matchMedia('(pointer:fine)').matches;
  let w, h, ps = [], raf, running = true;
  const mouse = { x: -999, y: -999, sx: -999, sy: -999 };
  const base = +canvas.dataset.count || 90;
  const LINK = 110;
  const color = () => getComputedStyle(document.documentElement).getPropertyValue('--color-accent').trim() || '#c8ff00';

  function resize() {
    const dpr = Math.min(devicePixelRatio || 1, 2);
    w = canvas.clientWidth; h = canvas.clientHeight;
    canvas.width = w * dpr; canvas.height = h * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    const n = Math.round(base * (w < 640 ? .3 : w < 1024 ? .6 : 1));
    ps = Array.from({ length: n }, () => ({
      x: Math.random() * w, y: Math.random() * h, vx: (Math.random() - .5) * .15, vy: (Math.random() - .5) * .15,
      radius: Math.random() * 1.4 + .3, opacity: Math.random() * .5 + .1, depth: Math.random() * .8 + .2,
      tw: Math.random() * Math.PI * 2, accent: Math.random() < .12,
    }));
  }
  function frame() {
    if (!running) return;
    ctx.clearRect(0, 0, w, h);
    mouse.sx += (mouse.x - mouse.sx) * .08; mouse.sy += (mouse.y - mouse.sy) * .08;
    const acc = color();
    if (fine && mouse.x > 0) { const g = ctx.createRadialGradient(mouse.sx, mouse.sy, 0, mouse.sx, mouse.sy, 140); g.addColorStop(0, 'rgba(255,255,255,.06)'); g.addColorStop(1, 'transparent'); ctx.fillStyle = g; ctx.fillRect(0, 0, w, h); }
    for (const p of ps) {
      p.x += p.vx; p.y += p.vy; p.tw += .02;
      if (p.x < 0) p.x = w; if (p.x > w) p.x = 0; if (p.y < 0) p.y = h; if (p.y > h) p.y = 0;
      if (fine) { const dx = p.x - mouse.sx, dy = p.y - mouse.sy, d = Math.hypot(dx, dy);
        if (d < 160) { const f = (1 - d / 160) * .35 * p.depth; p.x += dx / d * f * (d < 60 ? 1 : -.4); p.y += dy / d * f * (d < 60 ? 1 : -.4); } }
      const a = p.opacity * (.6 + .4 * Math.sin(p.tw));
      ctx.globalAlpha = a; ctx.fillStyle = p.accent ? acc : '#fff';
      ctx.beginPath(); ctx.arc(p.x, p.y, p.radius, 0, 6.283); ctx.fill();
    }
    ctx.lineWidth = .5; ctx.strokeStyle = '#fff';
    for (let i = 0; i < ps.length; i++) for (let j = i + 1; j < ps.length; j += 2) {
      const d = Math.hypot(ps[i].x - ps[j].x, ps[i].y - ps[j].y);
      if (d < LINK) { ctx.globalAlpha = (1 - d / LINK) * .08; ctx.beginPath(); ctx.moveTo(ps[i].x, ps[i].y); ctx.lineTo(ps[j].x, ps[j].y); ctx.stroke(); }
    }
    raf = requestAnimationFrame(frame);
  }
  let t; addEventListener('resize', () => { clearTimeout(t); t = setTimeout(resize, 200); });
  if (fine) addEventListener('mousemove', e => { const r = canvas.getBoundingClientRect(); mouse.x = e.clientX - r.left; mouse.y = e.clientY - r.top; });
  // Hentikan animasi saat hero tidak terlihat (hemat CPU)
  new IntersectionObserver(([e]) => { running = e.isIntersecting; if (running) { cancelAnimationFrame(raf); frame(); } }).observe(canvas);
  resize(); frame();
}
