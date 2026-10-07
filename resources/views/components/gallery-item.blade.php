@props(['g'])
<button type="button" class="gal-item mb-4 block w-full relative overflow-hidden ph {{ $g['ratio'] }}" data-cat="{{ $g['category'] }}" data-title="{{ $g['title'] }}" data-src="{{ asset('assets/'.$g['image']) }}" data-cursor="VIEW" aria-label="Buka {{ $g['title'] }}">
  <img src="{{ asset('assets/'.$g['image']) }}" alt="{{ $g['title'] }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover transition duration-700 hover:scale-105">
</button>
