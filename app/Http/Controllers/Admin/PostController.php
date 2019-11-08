<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Enums\PostEnumStatusType;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate();
        $breadcrumbItem = 'Posts';
        $title = 'Posts Management';
        $status = PostEnumStatusType::toSelectArray();
        return view('admin.posts.index', compact('posts', 'title', 'breadcrumbItem', 'status'));
    }

    public function getPostsByStatus(Request $request)
    {
        $status = PostEnumStatusType::toSelectArray();
        $statusPost = $request->status;
        // $posts = Post::status($statusPost)->get();
        $posts = Post::status($statusPost)->paginate(5);
        
        $breadcrumbItem = 'Posts Status';
        $title = 'Posts Management';
        return view('admin.posts.index', compact('posts', 'status', 'statusPost', 'title', 'breadcrumbItem'));
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Post";
        $categories = Category::all(); 
        $status = PostEnumStatusType::toSelectArray(); 
        $breadcrumbItem = 'New Post';
        return view('admin.posts.create', compact('title', 'breadcrumbItem'))->withStatus($status)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
