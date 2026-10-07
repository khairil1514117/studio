@props(['label' => '', 'title'])
<div class="mb-14 md:mb-24" data-reveal>
  @if($label)<p class="label mb-4">{{ $label }}</p>@endif
  <h2 class="mid">{{ $title }}</h2>
  @if($slot->isNotEmpty())<p class="mt-6 max-w-xl text-mute">{{ $slot }}</p>@endif
</div>
