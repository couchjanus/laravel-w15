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
        Route::get('/', 'DashboardController'); 	 
        Route::get('posts/status', 'PostController@getPostsByStatus')->name('posts.status'); 	 
        Route::resource('posts', 'PostController');
        Route::get('categories/status', 'CategoryController@getCategoriesByStatus')->name('categories.status'); 	 
        Route::resource('categories', 'CategoryController');
        Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');
        Route::post('users/restore/{id}', 'UserController@restore')->name('users.restore');
        Route::delete('users/force/{id}', 'UserController@force')->name('users.force');
        Route::resource('users', 'UserController');
        Route::resource('tags', 'TagController');
        Route::get('invitations', 'InvitationsController@index')->name('showInvitations');
        Route::post('invite/{id}', 'InvitationsController@sendInvite')
        ->name('send.invite');
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

Route::get('/home', function () {
    return redirect('profile');
});

Route::get('test', 'WidgetTestController@index');
// ==========================================

// Route::get('reminder', function () {
//     return new \App\Mail\Reminder();
// })->name('reminder');

// Route::get('reminder', function () {
//     return new App\Mail\Reminder('Blah уже скоро!');
// })->name('reminder');

// Route::post('reminder', function (\Illuminate\Http\Request $request) {
//     dd($request);
//     // return redirect()->back();    
// })->name('reminder');

Route::post('reminder', function (\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer) {
    $mailer->to($request->email)->send(new \App\Mail\Reminder($request->event));
    return redirect()->back();    
})->name('reminder');


// Route::get('invite', function () {
//     return (new App\Mail\InvitationMail())->render();
// });

// Route::get('invite', function () {
//     $url = 'Your Invite Link';
//     return (new App\Mail\InvitationMail($url))->render();
// });

Route::get('invite', function () {
    $url = 'http://google.com';
    return (new App\Mail\InvitationMail($url))->render();
});

Route::get('register/request', 'Auth\RegisterController@requestInvitation')->name('requestInvitation');

Route::post('invitations', 'InvitationsController@store')->middleware('guest')->name('storeInvitation');

Route::get('invite', function () {
    $url = App\Invitation::find(1)->getLink();
    return (new App\Mail\InvitationMail($url))->render();
});

// Еще какие-то маршруты....

// Route::fallback(function() {
//     return "Oops… How you've trapped here?";
// });
