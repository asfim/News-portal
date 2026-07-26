@extends('layouts.app')

@section('title', $news->title . ' | NewsHub Pro')

@section('content')
<main class="container-fluid px-lg-5 py-4">

    <!-- ARTICLE READING SECTION -->
    <section id="article" class="pt-4" data-aos="fade-up">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Reading Progress Bar -->
                <div id="readingProgress" class="position-fixed top-0 start-0 bg-danger" style="height: 4px; z-index: 2050; width: 0%;"></div>

                <span class="badge bg-danger text-uppercase px-3 py-2 rounded-pill fw-bold mb-3">{{ $news->category->name }}</span>
                
                <h1 class="fw-black display-5 mb-3 lh-sm" style="font-size: calc(1.8rem + 1.5vw);">
                    {{ $news->title }}
                </h1>
                <p class="fs-5 text-muted mb-4 fw-medium">
                    {{ $news->short_description }}
                </p>

                <div class="glass-card p-3 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($news->author->name) }}&background=random" class="rounded-circle object-fit-cover" style="width: 50px; height: 50px;" alt="{{ $news->author->name }}">
                        <div>
                            <h6 class="fw-bold m-0">{{ $news->author->name }}</h6>
                            <small class="text-muted">প্রতিবেদক | ঢাকা</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 text-muted small">
                        <span><i class="fa-regular fa-calendar me-1"></i> {{ $news->created_at->format('d F Y') }}</span>
                        <span><i class="fa-regular fa-clock me-1"></i> ৪ মিনিট পাঠ</span>
                        <span><i class="fa-regular fa-eye me-1"></i> {{ number_format($news->views) }} পঠিত</span>
                    </div>
                </div>

                <!-- Reading Accessibility Actions -->
                <div class="d-flex align-items-center justify-content-between p-2 mb-4 rounded-3 bg-body-tertiary border">
                    <div class="d-flex align-items-center gap-2">
                        <span class="small fw-bold text-muted me-2">ফন্ট সাইজ:</span>
                        <button onclick="adjustFont(-1)" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:32px; height:32px;">A-</button>
                        <button onclick="adjustFont(1)" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:32px; height:32px;">A+</button>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-bookmark"></i> সেভ করুন</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()"><i class="fa-solid fa-print"></i> প্রিন্ট</button>
                    </div>
                </div>

                <div class="rounded-4 overflow-hidden mb-4 position-relative">
                    @if($news->featuredImage)
                        <img src="{{ $news->featuredImage->file_path }}" class="w-100 img-fluid" alt="{{ $news->title }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=1200&auto=format&fit=crop" class="w-100 img-fluid" alt="Fallback">
                    @endif
                </div>

                <article id="articleBody" class="article-content fs-5 lh-lg" style="color: var(--nh-text); font-size: 19px;">
                    {!! $news->content !!}
                </article>
                
                <!-- Tags -->
                @if($news->tags->count() > 0)
                <div class="mt-5 border-top pt-4">
                    <h5 class="fw-bold mb-3">ট্যাগসমূহ:</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($news->tags as $tag)
                            <a href="#" class="badge bg-secondary text-white text-decoration-none px-3 py-2 rounded-pill">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {!! renderAdSlot('inside_content', 'w-100 mt-4') !!}
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 90px;">
                    
                    {!! renderAdSlot('sidebar_top', 'w-100 mb-4') !!}
                    
                    <div class="glass-card p-4 mb-4">
                        <h5 class="fw-extrabold mb-3 border-start border-3 border-danger ps-2">সম্পর্কিত খবর</h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach(\App\Models\News::published()->where('category_id', $news->category_id)->where('id', '!=', $news->id)->latest()->take(4)->get() as $related)
                            <a href="{{ route('news.show', $related->slug) }}" class="text-reset text-decoration-none border-bottom pb-2">
                                <h6 class="fw-bold hover-danger m-0">{{ $related->title }}</h6>
                                <small class="text-muted">{{ $related->created_at->diffForHumans() }}</small>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
