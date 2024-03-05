<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Customer;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\NotFound;
use App\Livewire\Backend\AllPrakasanis;
use App\Livewire\Backend\AllProducts;
use App\Livewire\Backend\AllSubjects;
use App\Livewire\Backend\AllWriters;
use App\Livewire\Backend\ControllContent;
use App\Livewire\Backend\Coupon;
use App\Livewire\Backend\Index;
use App\Livewire\Backend\Blog as BackendBlog;
use App\Livewire\Backend\Invoice;
use App\Livewire\Backend\MiniBanner;
use App\Livewire\Backend\OrderList;
use App\Livewire\Backend\PaddingProduct;
use App\Livewire\Backend\Prakasani;
use App\Livewire\Backend\PratihanicOrder as BackendPratihanicOrder;
use App\Livewire\Backend\Product;
use App\Livewire\Backend\Profile;
use App\Livewire\Backend\SaleRecord;
use App\Livewire\Backend\ShippingFee;
use App\Livewire\Backend\Slider;
use App\Livewire\Backend\Subject;
use App\Livewire\Backend\UserCreate;
use App\Livewire\Backend\ViewCustomer;
use App\Livewire\Backend\ViewUser;
use App\Livewire\Backend\Viewvendors;
use App\Livewire\Backend\WebsiteInformation;
use App\Livewire\Backend\Writer;
use App\Livewire\Frontend\AllPrakasaniBooks;
use App\Livewire\Frontend\AllSubjectBooks;
use App\Livewire\Frontend\AllWriterBooks;
use App\Livewire\Frontend\Blog;
use App\Livewire\Frontend\Cart;
use App\Livewire\Frontend\Checkout;
use App\Livewire\Frontend\Main;
use App\Livewire\Frontend\PratihanicOrder;
use App\Livewire\Frontend\Search;
use App\Livewire\Frontend\SingleBlog;
use App\Livewire\Frontend\SingleProduct;
use App\Livewire\Frontend\UserLogin;
use App\Livewire\Frontend\UserProfile\AllCancelOrder;
use App\Livewire\Frontend\UserProfile\AllDeliveredOrder;
use App\Livewire\Frontend\UserProfile\AllOrders;
use App\Livewire\Frontend\UserProfile\AllOrdersShow;
use App\Livewire\Frontend\UserProfile\AllPendingOrder;
use App\Livewire\Frontend\UserProfile\CustomerProfile;
use App\Livewire\Frontend\UserProfile\ProfileMain;
use App\Livewire\Frontend\UserRegistation;
use Illuminate\Support\Facades\Route;

//Controllers

// admin-login logout
Route::get('/admin', [Admin::class, 'adminloginshow'])->name('adminloginshow');
Route::post('/loginPost', [Admin::class, 'adminloginsPOST'])->name('adminloginsPOST');
Route::post('/logout', [Admin::class, 'adminlogout'])->name('adminlogout');

//customer login logout register
Route::post('/loginpost', [Customer::class, 'customerloginpost'])->name('customerloginpost');
Route::post('/customerlogout', [Customer::class, 'customerLogout'])->name('customerLogout');
Route::post('/register', [Customer::class, 'customerregistationpost'])->name('customerregistationpost');

//homepage
Route::post('/', [Frontend::class, 'main'])->name('main');

//not-found
Route::get('/nofound', [NotFound::class, 'notfound'])->name('notfound');


//Livewire all can view
Route::get('/', Main::class)->name('index');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/login', UserLogin::class)->name('customerlogin');
Route::get('/register', UserRegistation::class)->name('customerregistation');
Route::get('/book/{id}', SingleProduct::class)->name('singleproduct');
Route::get('/book/category/{id}', AllSubjectBooks::class)->name('category_product');
Route::get('/book/publisher/{id}', AllPrakasaniBooks::class)->name('prakasani_product');
Route::get('/book/author/{id}', AllWriterBooks::class)->name('writer_product');
Route::get('/corporate', PratihanicOrder::class)->name('corporate');
Route::get('/blogs', Blog::class)->name('blog');
Route::get('/blogs/item/{id}', SingleBlog::class)->name('singleblog');
Route::get('/search', Search::class)->name('search');


// customer with livewire
Route::group(['middleware'=> 'superUser'], function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/customer/dashboard', ProfileMain::class)->name('dashboard');
    Route::get('/customer/order/show/{id}', AllOrdersShow::class)->name('all_order_show');
    Route::get('/customer/orders', AllOrders::class)->name('all_order');
    Route::get('/customer/pending-orders', AllPendingOrder::class)->name('all_pending_order');
    Route::get('/customer/delivered-orders', AllDeliveredOrder::class)->name('all_delivered_order');
    Route::get('/customer/cancel-orders', AllCancelOrder::class)->name('all_cancel_order');
    Route::get('/customer/profile', CustomerProfile::class)->name('customer_profile');
});



// Admin with livewire
Route::group(['middlewareGroups'=> 'admin'], function () {

    //all-dashbord-user
    Route::group(['middleware'=> 'admin'], function () {
        Route::get('/admin/dashboard', Index::class)->name('admin_dashbord');
        Route::get('/admin/dashboard/subject', Subject::class)->name('subjects');
        Route::get('/admin/dashboard/prakasani', Prakasani::class)->name('prakasanis');
        Route::get('/admin/dashboard/writer', Writer::class)->name('writers');
        Route::get('/admin/dashboard/product', Product::class)->name('product');
        Route::get('/admin/dashboard/user-profile', Profile::class)->name('profile');
    });

    //SuperAdmin
    Route::group(['middleware'=> 'superAdmin'], function () {
        Route::get('/admin/dashboard/slider', Slider::class)->name('slider');
        Route::get('/admin/dashboard/mini-banner', MiniBanner::class)->name('mini_banner');
        Route::get('/admin/dashboard/website-information', WebsiteInformation::class)->name('websiteInformation');
        Route::get('/admin/dashboard/add-user', UserCreate::class)->name('usercreate');
        Route::get('/admin/dashboard/view-user', ViewUser::class)->name('viewusers');
        Route::get('/admin/dashboard/all-products', AllProducts::class)->name('all_product');
        Route::get('/admin/dashboard/all-subjects', AllSubjects::class)->name('all_subjects');
        Route::get('/admin/dashboard/all-prakasanis', AllPrakasanis::class)->name('all_prakasanis');
        Route::get('/admin/dashboard/all-writers', AllWriters::class)->name('all_writers');
        Route::get('/admin/dashboard/all-vendors', Viewvendors::class)->name('viewvendors');
        Route::get('/admin/dashboard/all-customers', ViewCustomer::class)->name('viewCustomers');
        Route::get('/admin/dashboard/controll-site-content', ControllContent::class)->name('controllcontent');
        Route::get('/admin/dashboard/coupon', Coupon::class)->name('coupon');
        Route::get('/admin/dashboard/shipping-fee', ShippingFee::class)->name('shippingFee');
        Route::get('/admin/dashboard/corporate', BackendPratihanicOrder::class)->name('corporateBackend');
        Route::get('/admin/dashboard/blogs', BackendBlog::class)->name('blogbackend');
    });

    //admin And User
    Route::group(['middleware'=> 'adminAndUser'], function () {
        Route::get('/admin/dashboard/padding-product', PaddingProduct::class)->name('padding_product');
        Route::get('/admin/dashboard/all-orders', OrderList::class)->name('order_list');
        Route::get('/admin/dashboard/sales-record', SaleRecord::class)->name('sales_record');
        Route::get('/admin/dashboard/invoice/{id}', Invoice::class)->name('invoice');
    });
});
