<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Post;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        // Sliderda gösterilecek.
        $featured_posts=Post::where(['is_featured'=>1])
            ->orderBy('created_at','desc')
            ->limit(config('settings.featured_post_count_slider'))
            ->get();

        //Yanda gösterilecek öne çıkarılmayan postlar
        $nonfeatured_posts = Post::where(['is_featured'=>0])
            ->orderBy('created_at','desc')
            //->limit(config('settings.homepage_post_count'))
            ->get();
        //Öne çıkarılan ama 5'i geçen postlar
        $other_featured_posts=Post::where(['is_featured'=>1])
            ->orderBy('created_at','desc')
            ->get()
            ->skip(config('settings.featured_post_count_slider'));

        //Birleştirelim
        $other_posts= $other_featured_posts->merge($nonfeatured_posts);
        $other_posts= $other_posts->sortByDesc('created_at')->take(config('settings.homepage_post_count'));

        return view("frontend.homepage.index",compact('featured_posts','other_posts'));
    }
}
