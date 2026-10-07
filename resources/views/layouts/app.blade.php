<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Brand Name — Visual Stories in Motion</title>
<meta name="description" content="Creative visual studio untuk photography, videography, event documentation, dan digital storytelling.">
<link rel="canonical" href="{{ url('/') }}">
<meta property="og:title" content="Brand Name — Visual Stories in Motion"><meta property="og:type" content="website">
<meta property="og:description" content="Creative visual studio untuk photography, videography, event documentation, dan digital storytelling.">
<meta property="og:image" content="{{ asset('assets/images/hero.jpg') }}">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 32 32%22><circle cx=%2216%22 cy=%2216%22 r=%2210%22 fill=%22%23c8ff00%22/></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet">
@vite(['resources/css/app.css','resources/js/app.js'])
<noscript><style>#loader{display:none}</style></noscript>
</head>
<body class="bg-bg text-ink antialiased">
<div id="loader" class="fixed inset-0 z-[100] bg-bg flex flex-col items-center justify-center gap-4">
  <div class="mid">Brand Name</div>
  <div class="w-48 h-px bg-white/10"><div id="loader-bar" class="h-full w-0 bg-accent"></div></div>
  <div id="loader-pct" class="text-xs tracking-widest text-mute">0%</div>
</div>
<x-cursor />
<x-navbar />
<main>@yield('content')</main>
<x-footer :socials="$socials" />
<div id="video-modal" class="fixed inset-0 z-[80] bg-black/95 hidden items-center justify-center p-4" role="dialog" aria-modal="true" aria-label="Video">
  <button data-close class="absolute top-6 right-6 btn" aria-label="Tutup">Close ✕</button>
  <video id="modal-video" class="max-h-[85vh] w-full max-w-6xl" controls playsinline></video>
</div>
<div id="lightbox" class="fixed inset-0 z-[80] bg-black/95 hidden flex-col items-center justify-center p-4" role="dialog" aria-modal="true" aria-label="Lightbox">
  <button data-close class="absolute top-6 right-6 btn" aria-label="Tutup">Close ✕</button>
  <img id="lb-img" alt="" class="max-h-[75vh] max-w-full object-contain">
  <p class="mt-4"><span id="lb-title" class="font-bold"></span> <span id="lb-cat" class="label ml-2"></span></p>
  <div class="absolute inset-x-4 top-1/2 flex justify-between"><button data-prev class="btn" aria-label="Sebelumnya">←</button><button data-next class="btn" aria-label="Berikutnya">→</button></div>
</div>
</body></html>
