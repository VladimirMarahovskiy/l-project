<?php
namespace App\Widgets;

use App\Models\Post;
use App\Widgets\Contract\ContractWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class LatestPostsWidget implements ContractWidget
{
    public function execute(){

        $minutes = Carbon::now()->addMinutes(10);

        $posts = Cache::remember('users', $minutes, function () {
            return Post::latestPosts()->get();
        });


        return view('Widgets::latestPosts', [
            'posts' => $posts
        ]);
    }
}
