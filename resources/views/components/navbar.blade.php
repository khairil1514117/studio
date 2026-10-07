<header id="nav" class="fixed top-0 inset-x-0 z-50 transition-all duration-500">
  <nav class="flex items-center justify-between px-6 md:px-10 py-5" aria-label="Utama">
    <a href="#home" class="font-extrabold tracking-widest text-sm">BRAND<span class="text-accent">.</span></a>
    <ul class="hidden md:flex gap-10 text-xs tracking-[.2em]">
      @foreach(['home','work','about','contact'] as $l)<li><a href="#{{ $l }}" class="ul uppercase py-1">{{ $l }}</a></li>@endforeach
    </ul>
    <a href="#contact" class="hidden md:inline text-xs tracking-[.2em] text-accent uppercase">Let's Talk</a>
    <button id="burger" class="md:hidden text-xs tracking-widest" aria-label="Menu" aria-expanded="false" aria-controls="mobile-menu">MENU</button>
  </nav>
  <div id="mobile-menu" class="hidden md:hidden bg-bg/95 backdrop-blur px-6 pb-8 pt-4 space-y-4 mid">
    @foreach(['home','work','about','contact'] as $l)<a href="#{{ $l }}" class="block">{{ $l }}</a>@endforeach
  </div>
</header>
