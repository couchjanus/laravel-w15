<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blog/{id}', 'BlogController@show')->name('show');
Route::get('blog/create', 'BlogController@create')->name('create');
Route::post('blog/create', 'BlogController@store')->name('store');
Route::get('blog/{id}/edit', 'BlogController@edit')->name('edit');
Route::post('blog/{id}/edit', 'BlogController@update')->name('update');

// Route::get('about', 'AboutController')->name('about');
// Route::get('contact-us', 'ContactController@index')->name('contact');

Route::get('posts', 'BlogController@getPosts');
// Route::get('posts', 'BlogController@takeLatestPosts');
// Route::get('posts', 'BlogController@skipAndGetLatestPosts');
// Route::get('posts', 'BlogController@getLimitLatestPosts');
// 

Route::get('chunk', function () {
    \DB::table('posts')->orderBy('id')->chunk(10, function ($posts) {
        foreach ($posts as $post) {
            dump($post);
        }
     // можете остановить обработку последующих "кусков" вернув false из Closure:
        return false;
    });
});

Route::get('agr', function () {
    dump(DB::table('users')->count());
    dump(DB::table('posts')->max('updated_at'));
});
 
Route::get('having', function () {
    $users = DB::table('users')
           ->groupBy('id')
           ->having('id', '>', 5)
       ->get();
       dump($users);
});

Route::get('when', function () {
    $categories = collect([1, 2, 3, 4]);
    $posts = DB::table('posts')
        ->when($categories, function ($query) use ($categories) {
            return $query->whereIn('category_id', $categories);
    })->get();
    dump($posts);
});

Route::get('sort-by', function () {
    $sortBy = null;
    $users = DB::table('users')
        ->when($sortBy, function ($query) use ($sortBy) {
            return $query->orderBy($sortBy);
            }, function ($query) {
                return $query->orderBy('name');
            })->get();
    dump($users);
});

Route::get('join', function () {
    $categories = DB::table('categories')
    ->join('posts', 'categories.id', '=', 'posts.category_id')
    ->select('categories.*', 'posts.title')
    ->get();
    dump($categories);
});

Route::get('leftjoin', function () {
    $posts = DB::table('posts')
    ->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->get();
    dump($posts);
});

Route::get('crossjoin', function () {
    $posts = DB::table('posts')
    ->crossJoin('categories')
    ->get();
    dump($posts);
});

Route::get('union', function () {
    $first = DB::table('posts')
                ->whereNull('created_at');
    $posts = DB::table('posts')
                ->whereNull('updated_at')
                ->union($first)
                ->get();
    dump($posts);
});
 
// getPostsWithCategory 

Route::get('post-list', 'BlogController@getPostsWithCategory'); 
