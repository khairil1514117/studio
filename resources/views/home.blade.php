@extends('layouts.app')
@section('content')
{{-- HERO --}}
<section id="home" class="relative min-h-[100svh] bg-fallback overflow-hidden flex flex-col justify-center px-6 md:px-10 pt-28 pb-16">
  <x-particle-background />
  <div class="relative z-10">
    <p class="label mb-6">Creative Visual Studio</p>
    <h1 class="big" id="hero-title"><span class="block hl">We turn</span><span class="block hl">moments</span><span class="block hl">into <em class="not-italic text-accent">stories.</em></span></h1>
    <p class="mt-8 max-w-md text-mute" data-reveal>Kami menangkap orang, tempat, ide, dan momen melalui fotografi, film, dan visual storytelling.</p>
    <div class="mt-8 flex flex-wrap gap-4" data-reveal><a href="#work" class="btn btn-fill" data-magnetic>View our work →</a><a href="#contact" class="btn" data-magnetic>Let's talk</a></div>
  </div>
  <div class="relative z-10 mt-14 md:absolute md:right-10 md:bottom-16 md:w-[38vw] aspect-video overflow-hidden rounded-lg ph" id="hero-media">
    <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/hero.jpg') }}" onerror="this.remove()"><source src="{{ asset('assets/videos/hero-video.mp4') }}" type="video/mp4"></video>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
  </div>
</section>
{{-- MANIFESTO --}}
<section class="px-6 md:px-10 py-40 md:py-72">
  <p class="big !text-[clamp(2rem,7vw,7rem)]">@foreach(["We don't just","capture moments.","We preserve","the feeling."] as $l)<span class="block mf">{{ $l }}</span>@endforeach</p>
</section>
{{-- WORK --}}
<section id="work" class="px-6 md:px-10 py-24">
  <x-section-title label="01 — Work" title="Selected Work">Kumpulan momen, proyek, dan cerita yang telah kami abadikan.</x-section-title>
  <div class="grid md:grid-cols-12 gap-6 md:gap-8">@foreach($projects as $p)<x-project-card :p="$p" />@endforeach</div>
</section>
{{-- FEATURED VIDEO --}}
<section class="py-32">
  <div class="px-6 md:px-10"><x-section-title label="02 — Reel" title="Watch the story" /></div>
  <div class="group relative mx-3 md:mx-6 aspect-video overflow-hidden ph" id="reel" data-video="{{ asset('assets/videos/reel.mp4') }}" data-cursor="PLAY" tabindex="0" role="button" aria-label="Putar reel">
    <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="none" poster="{{ asset('assets/images/hero.jpg') }}" data-lazy-src="{{ asset('assets/videos/reel.mp4') }}"></video>
    <div class="absolute inset-0 bg-black/30 grid place-items-center"><span class="mid opacity-0 group-hover:opacity-100 transition">Play reel →</span></div>
  </div>
</section>
{{-- ACTIVITIES (horizontal) --}}
<section id="activities" class="overflow-hidden py-24">
  <div class="px-6 md:px-10"><x-section-title label="03 — Life" title="Behind the scenes" /></div>
  <div class="hs-track" id="hs">@foreach($activities as $a)
    <figure class="relative shrink-0 w-[75vw] md:w-[38vw] aspect-[4/5] overflow-hidden ph"><img src="{{ asset('assets/'.$a['image']) }}" alt="Dokumentasi kegiatan {{ $a['n'] }}" loading="lazy" onerror="this.remove()" class="absolute inset-0 w-full h-full object-cover"><figcaption class="absolute bottom-4 left-4 mid">{{ $a['n'] }}</figcaption></figure>@endforeach</div>
</section>
{{-- ABOUT --}}
<section id="about" class="px-6 md:px-10 py-40 bg-bg2">
  <div class="grid md:grid-cols-2 gap-16">
    <div><p class="label mb-4">04 — About us</p><h2 class="big !text-[clamp(2.5rem,8vw,7rem)]" data-reveal>We create visuals that stay.</h2></div>
    <div class="md:pt-24" data-reveal><p class="text-lg text-mute">Kami adalah tim kreatif yang berfokus pada fotografi, pembuatan film, dokumentasi visual, dan digital storytelling. Setiap momen punya cerita, dan setiap cerita layak diingat.</p>
      <dl class="mt-14 grid grid-cols-2 gap-10">@foreach([['10','Projects','+'],['25','Stories','+'],['15','Clients','+'],['5','Years','']] as $s)<div><dt class="sr-only">{{ $s[1] }}</dt><dd class="mid"><span data-count="{{ $s[0] }}">{{ $s[0] }}</span>{{ $s[2] }}</dd><p class="label mt-2">{{ $s[1] }}</p></div>@endforeach</dl></div>
  </div>
</section>
{{-- SERVICES --}}
<section class="px-6 md:px-10 py-32">
  <x-section-title label="05 — Services" title="What we do" />
  <ul>@foreach($services as $i=>$s)<li class="group flex items-baseline gap-6 border-t border-white/10 py-6 md:py-8 transition-all hover:pl-4 hover:border-accent"><span class="text-xs text-mute group-hover:text-accent">{{ sprintf('%02d',$i+1) }} —</span><span class="mid">{{ $s }}</span></li>@endforeach</ul>
</section>
{{-- GALLERY --}}
<section class="px-6 md:px-10 py-24">
  <x-section-title label="06 — Archive" title="The archive" />
  <div class="flex flex-wrap gap-3 mb-10" id="filters" role="group" aria-label="Filter">@foreach(['all'=>'All','photo'=>'Photo','video'=>'Video','event'=>'Event','bts'=>'Behind the scenes'] as $k=>$v)<button class="btn {{ $k=='all'?'btn-fill':'' }}" data-filter="{{ $k }}">{{ $v }}</button>@endforeach</div>
  <div class="columns-2 md:columns-3 gap-4" id="grid">@foreach($gallery as $g)<x-gallery-item :g="$g" />@endforeach</div>
</section>
{{-- CONTACT --}}
<section id="contact" class="px-6 md:px-10 py-40">
  <h2 class="big" data-reveal>Let's create something <span class="text-accent">together.</span></h2>
  <div class="mt-20 grid md:grid-cols-2 gap-16">
    <ul class="space-y-4 text-lg">
      <li><span class="label block">Email</span><a class="ul" href="mailto:hello@example.com">hello@@example.com</a></li>
      <li><span class="label block">Phone / WhatsApp</span>+62 xxx xxxx xxxx</li>
      <li><span class="label block">Instagram</span>@@yourbrand</li><li><span class="label block">YouTube</span>Your Channel</li>
    </ul>
    <form id="contact-form" novalidate class="space-y-6">
      @foreach([['name','Nama','text'],['email','Email','email']] as $f)<div><label class="label" for="{{ $f[0] }}">{{ $f[1] }}</label><input id="{{ $f[0] }}" name="{{ $f[0] }}" type="{{ $f[2] }}" required class="w-full bg-transparent border-b border-white/20 py-3 focus:border-accent outline-none"><p class="err text-red-400 text-xs mt-1 hidden"></p></div>@endforeach
      <div><label class="label" for="type">Jenis proyek</label><select id="type" name="type" class="w-full bg-bg border-b border-white/20 py-3"><option>Photography</option><option>Videography</option><option>Event</option><option>Campaign</option></select></div>
      <div><label class="label" for="message">Pesan</label><textarea id="message" name="message" rows="4" required class="w-full bg-transparent border-b border-white/20 py-3 focus:border-accent outline-none"></textarea><p class="err text-red-400 text-xs mt-1 hidden"></p></div>
      <button class="btn btn-fill" data-magnetic>Send message →</button>
      <p id="form-ok" class="text-accent hidden" role="status">Terima kasih! Pesan Anda terkirim (demo).</p>
    </form>
  </div>
</section>
@endsection
