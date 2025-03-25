<?php

// frontend pages
use App\Http\Controllers\WebsiteController;




Route::controller(WebsiteController::class)->group(function() {
    Route::get('/', 'index')->name('welcome');
    // header routes
    Route::get('info', 'info')->name('info');
    Route::get('customize', 'customization')->name('customize');
    Route::get('signin', 'signin')->name('signin');
    Route::get('signup', 'signup')->name('signup');
    Route::get('uploads', 'uploadImages')->name('uploads');
    // footer routes
    Route::get('about-us', 'aboutUs')->name('about-us');
    Route::get('testimonials', 'testimonial')->name('testimonials');
    Route::get('image-research', 'imageResearch')->name('image-research');
});








Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
