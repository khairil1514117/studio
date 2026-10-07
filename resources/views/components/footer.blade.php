@props(['socials'])
<footer class="border-t border-white/10 px-6 md:px-10 py-12 text-xs tracking-widest">
  <div class="grid md:grid-cols-3 gap-8 items-start">
    <div class="font-extrabold">BRAND NAME</div>
    <ul class="flex gap-6 md:justify-center">@foreach(['home','work','about','contact'] as $l)<li><a class="ul uppercase" href="#{{ $l }}">{{ $l }}</a></li>@endforeach</ul>
    <ul class="flex flex-wrap gap-4 md:justify-end text-mute">@foreach($socials as $n=>$u)<li><a class="ul" href="{{ $u }}" target="_blank" rel="noopener">{{ $n }}</a></li>@endforeach</ul>
  </div>
  <div class="mt-12 flex justify-between text-mute"><span>© 2026 Brand Name. All Rights Reserved.</span><a href="#home" id="to-top" class="text-accent">BACK TO TOP ↑</a></div>
</footer>
