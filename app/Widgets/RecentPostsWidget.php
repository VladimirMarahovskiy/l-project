<?php
namespace App\Widgets;

use App\Models\Post;
use App\Widgets\Contract\ContractWidget;

class RecentPostsWidget implements ContractWidget
{
    public function execute(){
        $posts = Post::mostRead(6)->get();
        return view('Widgets::recentPosts', [
            'posts' => $posts
        ]);
    }
}
