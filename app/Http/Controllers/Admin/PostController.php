<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Enums\PostEnumStatusType;
use Validator;
use Auth;
use Gate;

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
        
        // $user = Auth::guard('admin')->user();
        // if ($user->can('create', Post::class)) {
        //     $categories = Category::all(); 
        //     $status = PostEnumStatusType::toSelectArray();  
        //     return view('admin.posts.create', compact('title', 'breadcrumbItem'))->withStatus($status)->withCategories($categories);
        // } else {
        //     return redirect(route('admin.posts.index'))->with('warning','You can not create post');
        // }
        
        // if ($this->authorize('create', Post::class)) {
        //     echo 'Current logged in user is allowed to create new posts.';
        // } else {
        //     echo 'You can not create post';
        // }
        // exit;
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
            'user_id'=>Auth::guard('admin')->id()
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
        // if ($user->can('view', $post)) {
        //   echo "Current logged in user is allowed to update the Post: {$post->title}";
        // } else {
        //   echo 'Not Authorized.';
        // }
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
        $tags = $post->tags->pluck('id');
        return view('admin.posts.edit', compact('breadcrumbItem', 'tags'))->withTitle('Edit Post')->withPost($post)->withStatus($status)->withCategories($categories);

        // if (Gate::allows('update-post', $post)) {
        //     $categories = Category::pluck('name', 'id'); 
        //     $status = PostEnumStatusType::toSelectArray(); 
        //     $tags = $post->tags->pluck('id');
        //     return view('admin.posts.edit', compact('breadcrumbItem', 'tags'))->withTitle('Edit Post')->withPost($post)->withStatus($status)->withCategories($categories);
        // } else {
        //     return redirect(route('admin.posts.index'))->with('warning','Not Allowed Edit Post');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->updateOrCreate([
            'title'       => $request->title, 
            'content'     => $request->content, 
            'status'      => $request->status, 
            'category_id' => $request->category_id, 
            'user_id'     => Auth::guard('admin')->id()
            ]);

        $post->tags()->sync((array)$request->input('tags'));
        return redirect(route('admin.posts.index'))->with('success','Post updated successfully');

        // $user = Auth::guard('admin')->user();
        // if ($user->can('update', $post)) {
        // $post->update($request->all());
        // $post->tags()->sync((array)$request->input('tags'));
        // return redirect(route('admin.posts.index'))->with('message','Post has been updated successfully');
        // } else {
        //     return redirect(route('admin.posts.index'))->with('warning',"Current logged in user is not allowed to update the Post: {$post->id}");
        // }
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

        // $user = Auth::guard('admin')->user();
        
        // if ($user->can('delete', $post)) {
        //     $post->tags()->detach();
        //     $post->delete();
        //     return redirect()->route('admin.posts.index')->with('success','Post deleted successfully');
        // } else {
        //     return redirect()->route('admin.posts.index')->with('warning','Пользователь '.$user->name.' не может удалять статью...');
        // }
        
        // if (Gate::forUser($user)->denies('destroy-post', $post)) {
        //     // Пользователь не может удалять статью...
        //     // dd('Пользователь '.$user->name.' не может удалять статью...');
        //     return redirect()->route('posts.index')->with('warning','Пользователь '.$user->name.' не может удалять статью...');
        // } else {
        // $post->tags()->detach();
        // $post->delete();
        // return redirect()->route('posts.index')->with('type','success')->with('message','Post deleted successfully');
        // }
    }
}
