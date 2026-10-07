import '../css/app.css';
import { initParticles } from './particles';
import { initCursor } from './cursor';
import { initAnimations } from './animations';
import { initGallery } from './gallery';
import { initVideo } from './video';

document.addEventListener('DOMContentLoaded', () => {
  initParticles(document.getElementById('particles'));
  initCursor();
  initVideo();
  initGallery();
  initAnimations();
});
