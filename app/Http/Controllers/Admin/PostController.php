<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Enums\PostEnumStatusType;
use Validator;
use Auth;

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
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255|min:4',
            'content' => 'required',
        ]);
        // Получить post или создать, если не существует...
        $post = Post::firstOrCreate([
            'title' => $request->title, 
            'content'=>$request->content, 
            'status'=>$request->status, 
            'category_id'=>$request->category_id, 
            'user_id'=>1
            // 'user_id'=>Auth::id()
            ]);
        $post->tags()->sync((array)$request->input('tags'));
        return redirect()->route('admin.posts.index')->with('success', 'Post Created Successfully!');
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
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id'); 
        $status = PostEnumStatusType::toSelectArray(); 
        $breadcrumbItem = 'Edit Post';
       
        // dump($post->tags[0]->slug);
        // foreach ($post->tags as $value) {
        //     # code...
        //     dump($value->slug);
        // }
        // dump($post->tags->pluck('name'));
        $tags = $post->tags->pluck('id');
        return view('admin.posts.edit', compact('breadcrumbItem', 'tags'))->withTitle('Edit Post')->withPost($post)->withStatus($status)->withCategories($categories);
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
        $post->updateOrCreate([
            'title'       => $request->title, 
            'content'     => $request->content, 
            'status'      => $request->status, 
            'category_id' => $request->category_id, 
            'user_id'     => Auth::id()
            ]);

        $post->tags()->sync((array)$request->input('tags'));
        return redirect(route('admin.posts.index'))->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','Post deleted successfully');

    }
}
