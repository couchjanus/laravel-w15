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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'BlogController@index')->name('blog.index');
    Route::get('/{slug}', 'BlogController@show')->name('blog.show');
    Route::get('category/{id}', 'BlogController@getPostsByCategory')->name('blog.category');
});

// Route::middleware('auth', 'admin')->namespace('Admin')
Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
	->group(function () {
        Route::get('/', 'DashboardController')->name('dashboard.home'); 	 
        Route::get('posts/status', 'PostController@getPostsByStatus')->name('posts.status'); 	 
        Route::resource('posts', 'PostController');
        Route::get('categories/status', 'CategoryController@getCategoriesByStatus')->name('categories.status'); 	 
        Route::resource('categories', 'CategoryController');
        Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');
        Route::post('users/restore/{id}', 'UserController@restore')->name('users.restore');
        Route::delete('users/force/{id}', 'UserController@force')->name('users.force');
        Route::any('users/search', function (Request $request) {
            $q = $request->q;
            $users = App\User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->paginate();
            if(count($users) > 0) {
                return view('admin.users.index', compact('users', 'q'))->withTitle('Users Management')->withBreadcrumbItem('Search Users');
            } else {
                  return redirect(route('admin.users.index'))->withWarning('No Details found. Try to search again !');
            }
        })->name('users.search');
        Route::resource('users', 'UserController');
        Route::resource('tags', 'TagController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('roles', 'RoleController');
        Route::post('pictures/upload-file', 'PictureController@uploadFile');
        Route::resource('pictures', 'PictureController');
        Route::get('invitations', 'InvitationsController@index')->name('showInvitations');
        Route::post('invite/{id}', 'InvitationsController@sendInvite')
        ->name('send.invite');
         /**
         * Admin Auth Route(s)
         */
        Route::namespace('Auth')->group(function(){
            //Login Routes
            Route::get('/login','LoginController@showLoginForm')->name('login');
            Route::post('/login','LoginController@login');
            Route::post('/logout','LoginController@logout')->name('logout');

            //Forgot Password Routes
            Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

            //Reset Password Routes
            Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

        });
});

// Route::get('about', 'AboutController')->name('about');
// Route::get('contact-us', 'ContactController@index')->name('contact');
 
Route::middleware('auth')
    ->middleware('verified')
    ->prefix('profile')
    ->as('profile.')
	->group(function () {
        Route::get('', 'ProfileController@index')
            ->name('home');
        Route::get('info', 'ProfileController@info')
            ->name('info');
        Route::put('store', 'ProfileController@store')
            ->name('store');
});

Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('home', function () {
    return redirect('profile');
})->name('home');

// Socialite Register Routes

Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');

Route::get('forum', 'ForumController@index');

Route::get('articles', 'ArticleController@index')->name('articles.index');
Route::get('articles/{id}','ArticleController@show')->name('articles.show'); 

Route::get('/search', function (\App\Repositories\ElasticsearchArticleRepositoryInterface $repository) {
   
    $articles = $repository->search((string) request('q'));
 
    // dump($articles);
    return view('articles.index', [
        'posts' => $articles,
        'title' => 'Awesome Blog'
    ]);
 })->name("repo.search");
 
// Еще какие-то маршруты....

// Route::fallback(function() {
//     return "Oops… How you've trapped here?";
// });
