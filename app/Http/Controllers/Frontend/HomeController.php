<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get the latest featured news
        $featured = News::published()->featured()->with(['category', 'author', 'featuredImage'])->latest()->first();
        
        // Get recent news
        $recent = News::published()->latest()->take(10)->get();
        
        // Section Categories (from Settings)
        $selectedCats = json_decode(\App\Models\Setting::get('homepage_categories', '[]'), true) ?? [];
        if (empty($selectedCats)) {
            $selectedCats = Category::where('status', true)->inRandomOrder()->take(4)->pluck('slug')->toArray();
        }

        $categorySections = Category::whereIn('slug', $selectedCats)
            ->with(['news' => function ($query) {
                $query->published()->latest()->take(4);
            }])->get();

        // Video News
        $videoNews = News::published()->whereNotNull('video_url')->latest()->take(6)->get();

        // Get trending news
        $trending = News::published()->trending()->with('category')->take(5)->get();
        
        // Get most read news (order by views)
        $mostRead = News::published()->orderBy('views', 'desc')->with('category')->take(5)->get();

        // Get Latest News (feature flag)
        $latestFeaturedNews = News::published()->where('is_latest', true)->latest()->take(6)->get();

        return view('frontend.home', compact('featured', 'recent', 'trending', 'mostRead', 'categorySections', 'videoNews', 'latestFeaturedNews'));
    }

    public function showNews($slug)
    {
        // Placeholder for single news details
        $news = News::published()->where('slug', $slug)->firstOrFail();
        return view('frontend.news-details', compact('news'));
    }

    public function latestNews()
    {
        $selectedCats = json_decode(\App\Models\Setting::get('homepage_categories', '[]'), true) ?? [];
        if (empty($selectedCats)) {
            $selectedCats = \App\Models\Category::where('status', true)->pluck('slug')->toArray();
        }

        $news = News::published()
            ->whereHas('category', function($q) use ($selectedCats) {
                $q->whereIn('slug', $selectedCats);
            })
            ->latest()
            ->paginate(16);
            
        return view('frontend.latest-news', compact('news'));
    }

    public function quickNews()
    {
        $selectedCats = json_decode(\App\Models\Setting::get('homepage_categories', '[]'), true) ?? [];
        if (empty($selectedCats)) {
            $selectedCats = \App\Models\Category::where('status', true)->pluck('slug')->toArray();
        }

        $categorySections = \App\Models\Category::whereIn('slug', $selectedCats)
            ->with(['news' => function ($query) {
                $query->published()->latest()->take(4);
            }])->get();

        return view('frontend.quick-news', compact('categorySections'));
    }

    public function category($slug)
    {
        // Placeholder for category page
        $category = Category::where('slug', $slug)->where('status', true)->firstOrFail();
        $news = News::published()->where('category_id', $category->id)->latest()->paginate(12);
        return view('frontend.category', compact('category', 'news'));
    }

    public function tag($slug)
    {
        // Placeholder for tag page
        return "Tag Page for: " . $slug;
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.required' => 'ইমেইল এড্রেস আবশ্যক।',
            'email.email' => 'সঠিক ইমেইল এড্রেস প্রদান করুন।',
            'email.unique' => 'এই ইমেইলটি ইতিপূর্বে সাবস্ক্রাইব করা হয়েছে।',
        ]);

        \App\Models\Newsletter::create([
            'email' => $request->input('email'),
            'status' => true,
        ]);

        return redirect()->back()->with('success', 'আমাদের নিউজলেটারে সাবস্ক্রাইব করার জন্য ধন্যবাদ!');
    }

    public function search(Request $request)
    {
        // Placeholder for search page
        $query = $request->input('q');
        return "Search results for: " . $query;
    }
}
