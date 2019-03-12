<?php
namespace App\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Widgets\Contract\ContractWidget;

class CategoryListWidget implements ContractWidget
{
    public function execute(){
        $categories = Category::all();
        return view('Widgets::categoriesList', [
            'categories' => $categories
        ]);
    }
}
