<?php
namespace App\Widgets;

use App\Widgets\Contracts\WidgetContract;
use App\Category;

class CategoriesWidget implements WidgetContract 
{
    // public function execute()
    // {
    //     $data = Category::all();
    //     return $data;
    // }

    // public function execute()
    // {
    //     // $cats = \App\Post::where('status',2)->get('category_id');

    //     $categories = Category::find(\App\Post::where('status', 2)->get('category_id'));
        
    //     return view('widgets::categories', [
    //         'data' => $categories
    //         ]
    //     );
    // }

    public function execute()
    {
        $categories = \App\Category::withCount(
            [
                'posts' => function($query) {
                    $query->where('status', 2);
                }
            ])
            ->find(\App\Post::where('status', 2)->get('category_id'));
        
        return view('widgets::categories', [ 'data' => $categories ] );
    }
 
}