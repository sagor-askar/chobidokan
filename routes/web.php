<?php
// backend modules
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;

// frontend pages
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Artisan;

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');        // cache clear
    Artisan::call('config:clear');       // config clear
    Artisan::call('route:clear');        // route clear
    Artisan::call('view:clear');         // view clear

    return "All cache cleared!";
});


Route::controller(WebsiteController::class)->group(function() {
    Route::get('/', 'index')->name('welcome');
    // header routes
    Route::get('info', 'info')->name('info');
    Route::get('signin', 'signin')->name('signin');
    Route::get('signup', 'signup')->name('signup');
    Route::get('submission-guidelines', 'guidelines')->name('submission-guidelines');
    // footer routes
    Route::get('about-us', 'aboutUs')->name('about-us');
    Route::get('testimonials', 'testimonial')->name('testimonials');
    Route::get('image-research', 'imageResearch')->name('image-research');
    Route::get('pricing-info', 'pricingTable')->name('pricing-info');
    Route::get('licencing', 'licenceInfo')->name('licencing');
    Route::get('terms-of-use', 'termsofUse')->name('terms-of-use');
    Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('contact-us', 'contactUs')->name('contact-us');
    Route::get('search-tips', 'searchTips')->name('search-tips');
    Route::get('faq', 'faqs')->name('faq');
    Route::get('technical', 'technicals')->name('technical');
    // seller authentication
    Route::get('seller-registration', 'sellerReg')->name('seller-registration');
    Route::get('seller-login', 'sellerLog')->name('seller-login');
    // designer profile
    Route::get('designer-profile/{id}', 'designerProfile')->name('designer-profile');
    // image details page - static
    Route::get('view-all', 'viewAll')->name('viewAll');
    Route::get('view-details', 'viewDetails')->name('viewDetails');
});

//user & seller Registration
Route::post('/user/register', 'Auth\RegisterController@userRegister')->name('user.register');
Route::post('/user-login', 'Auth\LoginController@customLogin')->name('customLogin');
Route::post('/seller/register', 'Auth\RegisterController@sellerRegister')->name('seller.register');


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
    Route::get('users/change-status/{id}', 'UsersController@changeStatus')->name('users.changeStatus');

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Subscription
    Route::delete('subscriptions/destroy', 'SubscriptionController@massDestroy')->name('subscriptions.massDestroy');
    Route::resource('subscriptions', 'SubscriptionController');

    // faqs
    Route::resource('faqs', 'FaqController');
    Route::delete('faqs/massDestroy', 'FaqController@massDestroy')->name('faqs.massDestroy');

    // testimonials
    Route::resource('testimonials', 'TestimonialController');
    Route::delete('testimonials/massDestroy', 'TestimonialController@massDestroy')->name('testimonial.massDestroy');

    // Privacy & policy
    Route::get('privacy-policy', 'SettingController@privacyPolicy')->name('privacy.policy');
    Route::post('privacy-policy/store', 'SettingController@privacyPolicyStore')->name('privacy.store');

    // Terms of Use
    Route::get('terms-of-use', 'SettingController@termsOfUse')->name('terms.use');
    Route::post('terms-of-use/store', 'SettingController@termsOfUseStore')->name('terms.use.store');

    // Licencing
    Route::get('licencing', 'SettingController@licencing')->name('licencing.info');
    Route::post('licencing/store', 'SettingController@licencingStore')->name('licencing.info.store');

    // Search Tips
    Route::get('search-tips', 'SettingController@searchTips')->name('search.tips');
    Route::post('search-tips/store', 'SettingController@searchTipsStore')->name('search.tips.store');

    // Technical
    Route::get('technical-info', 'SettingController@technicalInfo')->name('technical.info');
    Route::post('technical-info/store', 'SettingController@technicalInfoStore')->name('technical.info.store');

    // Image Research
    Route::get('image-research', 'SettingController@imgResearch')->name('img.research');
    Route::post('image-research/store', 'SettingController@imgResearchStore')->name('img.research.store');

    // software settings
    Route::get('settings', 'SettingController@setting')->name('settings');
    Route::post('settings/store', 'SettingController@store')->name('settings.store');

    // Info Setup
    Route::get('info', 'SettingController@infoSetup')->name('info.setup');
    Route::post('info/store', 'SettingController@infoSetupStore')->name('info.setup.store');

    // Project
    Route::get('project-list', 'ProjectController@projectList')->name('project.list');
    Route::get('project-details/{id}', 'ProjectController@projectDetails')->name('project.details');
    Route::get('project-details/{project_id}/{designer_id}', 'ProjectController@designerSubmitDetails')->name('project.design-submit-show');
    Route::delete('project/delete/{id}', 'ProjectController@projectDelete')->name('project.delete');

   // Upload Product
    Route::get('product-list', 'ProductController@productList')->name('products.list');

});

Route::group(['middleware' => ['custom_auth','is_unbanned']], function () {
    Route::get('customize', [WebsiteController::class,'customization'])->name('customize');
    Route::get('closed-jobs',  [WebsiteController::class, 'closedJobs'])->name('closed-jobs');
    Route::get('/custom-request', [WebsiteController::class, 'customRequest'])->name('custom-request');
    Route::get('/custom-job/search', [WebsiteController::class, 'CustomJobSearch'])->name('custom-job.search');
    Route::get('customize-details/{id}', [ProjectController::class, 'customizationDetail'])->name('customize-details');
    Route::get('project/submitted-file-view-all/{id}', [ProjectController::class, 'submittedFileViewAll'])->name('submitted-file-view-all');
    Route::get('project/submitted-file-confirm/{id}', [ProjectController::class, 'submittedFileConfirm'])->name('project.submitted-file.confirm');
    Route::get('job-submission/{id}', [ProjectController::class, 'submission'])->name('job-submission');
    Route::post('job-submission/{id}', [ProjectController::class, 'submit'])->name('job.submit');

    Route::group(['prefix' => 'designer', 'as' => 'designer.'], function () {
        Route::get('/dashboard', [DesignerController::class, 'dashboard'])->name('dashboard');
        Route::get('/about', [DesignerController::class, 'about'])->name('about');
        Route::get('/orders', [DesignerController::class, 'orders'])->name('orders');
        Route::get('/order-delivery/{id}', [DesignerController::class, 'orderDelivery'])->name('order-delivery');
        Route::post('/order-submit/{id}', [DesignerController::class, 'orderSubmit'])->name('order.submit');

        Route::get('/rejected-orders', [DesignerController::class, 'rejectedOrders'])->name('rejected-orders');
        Route::get('/order/sample-upload-file/{id}', [DesignerController::class, 'rejectedOrderFile'])->name('order.sample.upload-file');

        Route::get('/order-history', [DesignerController::class, 'orderHistory'])->name('order-history');
        Route::get('/order/submitted-file/{id}', [DesignerController::class, 'submittedOrderFile'])->name('order.submitted-file');
        Route::get('/submitted-works/{id}', [DesignerController::class, 'submittedWorks'])->name('submittedWorks');
        Route::get('/manage-profile', [DesignerController::class, 'manageProfile'])->name('manage.profile');
        Route::put('/profile-update', [DesignerController::class, 'updateProfile'])->name('profile.update');
        Route::get('/change-password', [DesignerController::class, 'changePassword'])->name('change.password');
        Route::put('/update-password', [DesignerController::class, 'updatePassword'])->name('updatePassword');

        Route::get('/product-upload',  [ProductController::class, 'uploadProduct'])->name('upload');
        Route::post('/product-store', [ProductController::class, 'storeProduct'])->name('products.store');

        Route::get('/product-list',  [DesignerController::class, 'productList'])->name('product-list');
        Route::get('/product-edit/{id}',  [DesignerController::class, 'productEdit'])->name('product.edit');
        Route::put('/product-update/{id}',  [DesignerController::class, 'productUpdate'])->name('products.update');

    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/about', [UserController::class, 'about'])->name('about');
        Route::get('/orders', [UserController::class, 'orders'])->name('orders');
        Route::get('/order/submitted-file/{id}', [UserController::class, 'submittedOrderFile'])->name('order.submitted-file');
        Route::put('/order/project-approve/{id}', [UserController::class, 'projectApprove'])->name('order.project.approve');
       // Route::put('/order/submission-reject/{id}', [UserController::class, 'submissionReject'])->name('order.submission.reject');
        Route::get('/order-history', [UserController::class, 'orderHistory'])->name('order-history');
        Route::get('/submitted-works/{id}', [UserController::class, 'submittedWorks'])->name('submittedWorks');
        Route::get('/manage-profile', [UserController::class, 'manageProfile'])->name('manage.profile');
        Route::put('/profile-update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
        Route::put('/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
    });
    Route::post('/project-order', [PaymentController::class, 'projectOrder'])->name('project.order');

});

Route::post('order/success', [PaymentController::class,'orderSuccess'])->name('order.success');
Route::match(['get', 'post'], 'order/fail', [PaymentController::class, 'orderFail'])->name('order.fail');
Route::match(['get', 'post'], 'order/cancel', [PaymentController::class, 'orderCancel'])->name('order.cancel');



Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
