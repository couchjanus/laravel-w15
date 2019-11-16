<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Enums\PostEnumStatusType;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();
        return view('blog.index', compact('posts'))->withTitle('Awesome Blog');
    }

    public function show($slug)
    {
        if (is_numeric($slug)) {
            $post = Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $lug), 301);
        }

        $post = Post::whereSlug($slug)->with('category')->with('user')->firstOrFail();
        return view('blog.show', ['post' => $post, 'hascomments'=>true]);
    }

    public function getPostsByCategory($categoryId)   {
        $posts = Post::where([
                        'status' => PostEnumStatusType::Published, 
                        'category_id' => $categoryId
                    ])
                    ->with('category')
                    ->orderBy('updated_at', 'desc')
                    ->paginate(5);
        return view('blog.index')->with(compact('posts'))->withTitle('Awesome Blog');
    } 
}
