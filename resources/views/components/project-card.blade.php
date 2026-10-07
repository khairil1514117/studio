@props(['p'])
<article class="{{ $p['span'] }} group relative overflow-hidden ph" data-img-reveal data-cursor="{{ $p['video'] ? 'PLAY' : 'VIEW' }}" @if($p['video']) data-video="{{ asset('assets/'.$p['video']) }}" @endif>
  <img src="{{ asset('assets/'.$p['image']) }}" alt="{{ $p['title'] }} — {{ $p['category'] }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover transition duration-[900ms] group-hover:scale-105">
  <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent opacity-70 group-hover:opacity-100 transition"></div>
  <div class="absolute bottom-0 p-5 md:p-8 transition-transform duration-500 group-hover:-translate-y-2">
    <p class="label">{{ sprintf('%02d',$p['id']) }} — {{ $p['category'] }} — {{ $p['year'] }}</p>
    <h3 class="text-2xl md:text-4xl font-extrabold uppercase mt-2">{{ $p['title'] }} →</h3>
    <p class="text-sm text-mute mt-2 max-w-sm opacity-0 group-hover:opacity-100 transition">{{ $p['description'] }}</p>
  </div>
</article>
