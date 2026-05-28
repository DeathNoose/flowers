<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PromocodeController;
use Illuminate\Support\Facades\Storage;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{flower:slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{flower}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Заказы
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');



// Админ-панель (только для администраторов)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
    Route::post('/users/{user}/remove-admin', [UserController::class, 'removeAdmin'])->name('users.remove-admin');

      // Управление категориями
    Route::resource('categories', CategoryController::class);
    
    // Управление товарами
    Route::resource('products', ProductController::class);
});

// Контакты
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::post('/contacts/send', [ContactController::class, 'send'])->name('contacts.send');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Доставка
Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery');


// Аутентификация (гости)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Выход (только для авторизованных)
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// Профиль пользователя (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
});

// Админ-панель (только для администраторов)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
    Route::post('/users/{user}/remove-admin', [UserController::class, 'removeAdmin'])->name('users.remove-admin');

     // Управление отзывами 
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::post('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{review}/disapprove', [AdminReviewController::class, 'disapprove'])->name('reviews.disapprove');
    Route::post('/reviews/{review}/response', [AdminReviewController::class, 'response'])->name('reviews.response');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

    });



// Маршруты для оплаты
Route::get('/payment/{order}/pay', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('/payment/{order}/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/yookassa/webhook', [PaymentController::class, 'webhook'])->name('yookassa.webhook');

// Маршруты для оплаты
Route::get('/payment/{order}/callback', [OrderController::class, 'paymentCallback'])->name('payment.callback');




Route::get('/test-yookassa', function() {
    $result = [];
    
    // Проверяем наличие классов
    $result['YooKassa\Client'] = class_exists('YooKassa\Client') ? '✅ Найден' : '❌ Не найден';
    $result['YooKassa\Validator\Validator'] = class_exists('YooKassa\Validator\Validator') ? '✅ Найден' : '❌ Не найден';
    
    // Проверяем папки
    $result['SDK path exists'] = file_exists(base_path('vendor/yoomoney/yookassa-sdk-php/lib/YooKassa/Client.php')) ? '✅' : '❌';
    $result['Validator path exists'] = file_exists(base_path('vendor/yoomoney/yookassa-sdk-validator/lib/YooKassa/Validator/Validator.php')) ? '✅' : '❌';
    
    return response()->json($result);
});



// Маршруты для промокодов (для пользователей)
Route::post('/cart/apply-promocode', [CartController::class, 'applyPromocode'])->name('cart.apply-promocode');
Route::delete('/cart/remove-promocode', [CartController::class, 'removePromocode'])->name('cart.remove-promocode');

// Админ-маршруты для промокодов
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('promocodes', PromocodeController::class);
    Route::post('/promocodes/{promocode}/toggle-status', [PromocodeController::class, 'toggleStatus'])->name('promocodes.toggle-status');
});

Route::delete('/admin/products/image/{id}', [App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('admin.products.delete-image');



Route::get('/image/{path}', function ($path) {
    if (Storage::disk('public')->exists($path)) {
        return response(Storage::disk('public')->get($path))
            ->header('Content-Type', 'image/jpeg');
    }
    return abort(404);
})->where('path', '.*');

