<!-- TOP INFORMATION BAR -->
<div class="topbar py-1 border-bottom d-none d-md-block" style="background: var(--nh-primary); color: #9CA3AF; font-size: 0.85rem;">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center">
            <div class="col-md-4">
                <span class="fw-bold text-white me-2">NEWSHUB PRO</span>
                <span class="border-end border-secondary me-2 pe-2"></span>
                <span><i class="fa-regular fa-clock me-1"></i> {{ date('l, d F Y') }}</span>
            </div>
            <div class="col-md-4 text-center">
                <span class="badge bg-danger me-1"><i class="fa-solid fa-location-dot"></i> ঢাকা</span>
                <span class="text-white fw-semibold">☀ ৩১° সে.</span>
                <span class="text-muted ms-2">আংশিক মেঘলা</span>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-inline-flex align-items-center gap-3">
                    <a href="{{ \App\Models\Setting::get('facebook', '#') }}" class="text-reset hover-danger" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ \App\Models\Setting::get('youtube', '#') }}" class="text-reset hover-danger" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                    <a href="{{ \App\Models\Setting::get('instagram', '#') }}" class="text-reset hover-danger" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ \App\Models\Setting::get('twitter', '#') }}" class="text-reset hover-danger" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <span class="border-end border-secondary h-100"></span>
                    <button id="themeToggle" class="btn btn-sm btn-link text-reset p-0 border-0" aria-label="Toggle Theme">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-semibold ms-2">
                            <i class="fa-solid fa-gauge-high me-1"></i> ড্যাশবোর্ড
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-white text-decoration-none fw-semibold ms-2">
                            <i class="fa-regular fa-user me-1"></i> লগইন
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MAIN HEADER SECTION -->
<header class="py-3 border-bottom" style="background: var(--nh-surface);">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center">
            <div class="col-6 col-md-4">
                <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center gap-2">
                    <div class="bg-danger text-white fw-black px-3 py-1 rounded-3 fs-3 font-en" style="letter-spacing: -1px;">
                        NH<span class="text-dark">P</span>
                    </div>
                    <div>
                        <h1 class="h3 fw-extrabold m-0 text-uppercase font-en" style="color: var(--nh-text); line-height: 1;">
                            NEWSHUB<span class="text-danger">PRO</span>
                        </h1>
                        <small class="text-muted d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">খবরের সাথে, সবসময়</small>
                    </div>
                </a>
            </div>
            <div class="col-md-4 d-none d-md-block text-center">
                <div class="p-2 rounded-3 text-center border border-dashed" style="background: var(--nh-bg); font-size: 0.8rem;">
                    {!! renderAdSlot('header_banner', 'w-100') !!}
                    @if(empty(renderAdSlot('header_banner')))
                        <span class="badge bg-secondary mb-1">বিজ্ঞাপন</span>
                        <p class="m-0 text-muted fw-semibold">ডিজিটাল বাংলাদেশ মেলা ২০২৬ — স্টল বুকিং চলছে!</p>
                    @endif
                </div>
            </div>
            <div class="col-6 col-md-4 text-end">
                <div class="d-flex align-items-center justify-content-end gap-2 gap-md-3">
                    <button onclick="openSearch()" class="btn btn-outline-secondary rounded-circle" style="width:42px; height:42px;" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <a href="#" class="btn btn-danger rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2 fw-bold shadow-sm">
                        <span class="live-pulse bg-white"></span>
                        <span style="font-size: 0.9rem;">LIVE TV</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
