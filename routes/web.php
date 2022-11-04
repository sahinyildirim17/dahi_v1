<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\Frontend\HomepageController::class, 'index'])->name('homepage');

Route::middleware(['auth','verified'])->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/secure_my_account', [\App\Http\Controllers\Frontend\ProfileController::class, 'show_secure_page'])->name('profile.secure');
    Route::post('profile/confirm_failed_login', [\App\Http\Controllers\Frontend\ProfileController::class, 'confirm_failed_login'])->name('profile.secure.confirmFailedLogin');
    Route::get('/admin', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('panel.index');
});

//todo Tüm içeriklerde resource controller kullanılacak şekilde düzenlendi.
//todo İhtiyaç halinde rc'lara ekstra rotalar alt satır olarak eklenecek.

    Route::resource('admin/posts', \App\Http\Controllers\Backend\PostController::class)->middleware(['role_or_permission:super-admin|posts_view']);
    Route::post('/admin/posts/ckeditor_upload', [\App\Http\Controllers\Backend\PostController::class, 'ckeditor_upload'])->name('panel.posts.ckeditor_upload');
    Route::resource('admin/committees', \App\Http\Controllers\Backend\CommitteeController::class)->middleware(['role_or_permission:super-admin|committees_view']);

    Route::get('mailtest',function (){
         $user = \App\Models\User::find(1)->first();
         $committee = \App\Models\Backend\Committee::find(13)->with('members')->get();
         \Illuminate\Support\Facades\Mail::to('admin@admin.com')->send(new \App\Mail\SendDemoMail($user,$committee));
    });

    Route::get('smstest',function (){
        send_sms('05415892420','Bu TFFHGD Niğde uygulamasından gönderilen bir deneme mesajıdır.');
    });

    Route::get('sms_report',function (){
        $sms_id = 1222594175;
        $response = get_sms_report($sms_id);
        \Illuminate\Support\Facades\Log::info('SMS Rapor Bilgileri: '.$response);
    });
