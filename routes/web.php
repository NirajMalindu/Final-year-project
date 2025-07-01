<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\GuideHomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\BookingManagementController;
use App\Http\Controllers\PaymentManagementController;
use App\Http\Controllers\ReviewManagementController;
use App\Http\Controllers\NotificationManagementController;
use App\Http\Controllers\ReportManagementController;
use App\Http\Controllers\GuideProfileController;
use App\Http\Controllers\TravelerHomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuideReviewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserItineraryController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\GuideController; 
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GuideBookingController;
use App\Http\Controllers\GalleryManagementController;

















Route::get('/', function () {
    
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/guide/profile/edit', [GuideProfileController::class, 'edit'])->name('guide.profile.edit');
    Route::put('/guide/profile', [GuideProfileController::class, 'update'])->name('guide.profile.update');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard', [AdminHomeController::class, 'index']) ->
middleware(['auth','admin']);

Route::get('guide/dashboard', [GuideHomeController::class, 'index']) ->
middleware(['auth','guide']);





//Admin part All Routers


    Route::get('/admin/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/user-management', [AdminHomeController::class, 'userManagement'])->name('admin.user.management');


    //user-management routes

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');

        // Traveler actions
        Route::post('/admin/traveler/suspend/{id}', [UserManagementController::class, 'suspendTraveler'])->name('admin.traveler.suspend');
        Route::delete('/admin/traveler/delete/{id}', [UserManagementController::class, 'deleteTraveler'])->name('admin.traveler.delete');

        // Guide actions
        Route::post('/admin/guide/approve/{id}', [UserManagementController::class, 'approveGuide'])->name('admin.guide.approve');
        Route::post('/admin/guide/reject/{id}', [UserManagementController::class, 'rejectGuide'])->name('admin.guide.reject');
        Route::put('/admin/guide/update/{id}', [UserManagementController::class, 'updateGuide'])->name('admin.guide.update');
        Route::delete('/admin/guides/{id}', [UserManagementController::class, 'deleteGuide'])->name('admin.guide.delete');
        Route::get('/admin/user/search', [UserManagementController::class, 'userManagement'])->name('admin.user.search');

    });



    
    //Places (Attraction and Destination) Routes

    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        // Route to show destinations and attractions
        Route::get('/places', [PlaceController::class, 'index'])->name('places');

        // Routes for Destinations
        Route::post('/destination/store', [PlaceController::class, 'storeDestination'])->name('storeDestination');
        Route::put('/destination/{id}/update', [PlaceController::class, 'updateDestination'])->name('updateDestination');
        Route::get('/destination/{id}/delete', [PlaceController::class, 'destroyDestination'])->name('destroyDestination');

        // Routes for Attractions
        Route::post('/attraction/store', [PlaceController::class, 'storeAttraction'])->name('storeAttraction');
        Route::put('/attraction/{id}/update', [PlaceController::class, 'updateAttraction'])->name('updateAttraction');
        Route::get('/attraction/{id}/delete', [PlaceController::class, 'destroyAttraction'])->name('destroyAttraction');
    });



    //Activity Routes

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities');
        Route::post('/activities', [ActivityController::class, 'store'])->name('admin.activities.store');
        Route::post('/activities/update/{id}', [ActivityController::class, 'update'])->name('admin.activities.update');
        Route::delete('/activities/delete/{id}', [ActivityController::class, 'destroy'])->name('admin.activities.delete');
    });


    //Itinerary Routes

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/itineraries', [ItineraryController::class, 'index'])->name('admin.itineraries.index');
        Route::post('/itineraries/{id}/update', [ItineraryController::class, 'update'])->name('admin.itineraries.update');
        Route::get('/itineraries/{id}/delete', [ItineraryController::class, 'destroy'])->name('admin.itineraries.delete');
    });



    //Booking Routes

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/bookings', [BookingManagementController::class, 'index'])->name('admin.bookings.index');
        Route::post('/bookings/update/{id}', [BookingManagementController::class, 'update'])->name('admin.bookings.update');
        Route::get('/bookings/delete/{id}', [BookingManagementController::class, 'delete'])->name('admin.bookings.delete');
        Route::get('/bookings/confirm/{id}', [BookingManagementController::class, 'confirm'])->name('admin.bookings.confirm');
        Route::get('/bookings/cancel/{id}', [BookingManagementController::class, 'cancel'])->name('admin.bookings.cancel');
    });



    //Payment Routes

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/payments', [PaymentManagementController::class, 'index'])->name('admin.payments.index');
        Route::post('/payments/update/{id}', [PaymentManagementController::class, 'update'])->name('admin.payments.update');
        Route::post('/payments/delete/{id}', [PaymentManagementController::class, 'destroy'])->name('admin.payments.delete');
    });


    //Review Routes

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/reviews', [ReviewManagementController::class, 'index'])->name('admin.reviews.index');
        Route::post('/reviews/{id}/approve', [ReviewManagementController::class, 'approve'])->name('admin.reviews.approve');
        Route::post('/reviews/{id}/reject', [ReviewManagementController::class, 'reject'])->name('admin.reviews.reject');
        Route::delete('/reviews/{id}', [ReviewManagementController::class, 'destroy'])->name('admin.reviews.delete');
    });


    //Notification Routes

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/notifications', [NotificationManagementController::class, 'index'])->name('admin.notifications');
        Route::post('/notifications', [NotificationManagementController::class, 'store'])->name('admin.notifications.store');
        Route::get('/notifications/delete/{id}', [NotificationManagementController::class, 'destroy'])->name('admin.notifications.delete');
    });


    //Report Routes


    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/reports', [ReportManagementController::class, 'index'])->name('admin.reports.index');
        Route::post('/reports/generate', [ReportManagementController::class, 'generate'])->name('admin.reports.generate');
        Route::get('/reports/download/{id}', [ReportManagementController::class, 'download'])->name('admin.reports.download');
        Route::delete('/reports/delete/{id}', [ReportManagementController::class, 'destroy'])->name('admin.reports.destroy');
    });

    //gallery routes
    Route::get('/admin/gallery', [GalleryManagementController::class, 'index'])->name('admin.gallery.index');
    Route::post('/admin/gallery/upload', [GalleryManagementController::class, 'upload']);
    Route::delete('/admin/gallery/delete/{id}', [GalleryManagementController::class, 'destroy']);

    




//Traveler All Complete Routes

        Route::get('/', [TravelerHomeController::class, 'index']);
        Route::get('/dashboard',[TravelerHomeController::class,'showHome'])->middleware('auth')->name('dashboard');

        //Search Activities Routes
        Route::get('/activities', [TravelerHomeController::class, 'index'])->name('activities.index');
        Route::get('/activities/search', [TravelerHomeController::class,'search'])->name('activities.search');
        


        //Itinerary Routes
        Route::get('/itinerary/create/{activityId}', [ItineraryController::class, 'create'])->name('itinerary.create');
        Route::post('/itinerary/store', [ItineraryController::class, 'store'])->middleware('auth')->name('itinerary.store');


        //about Routes
         Route::get('/about', [AboutController::class, 'index'])->name('about');

         //contact page routes
         Route::get('/contact', [ContactController::class, 'index'])->name('contact');
         Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');


         //gallery page route
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

        //tour list page route
        Route::get('/itinerariesshow', [UserItineraryController::class, 'showUserItineraries'])->name('itinerariesshow');
        Route::get('/itinerary/create', [UserItineraryController::class, 'showItinerarypage'])->name('itineraries.create');
        Route::put('/user/itineraries/{id}', [UserItineraryController::class, 'update'])->name('user.itineraries.update');
        Route::delete('/user/itineraries/{id}', [UserItineraryController::class, 'destroy'])->name('user.itineraries.destroy');


        //route to payment page(booking)
        Route::get('/itinerary/{id}/pay', [BookingController::class, 'showPaymentPage'])->name('bookings.pay');
        Route::post('/itinerary/{id}/pay', [BookingController::class, 'processPayment'])->name('bookings.process');

        //route booking history 
        Route::get('/bookinghistory', [BookingHistoryController::class, 'bookings'])->name('booking.history');
        Route::put('/booking/cancel/{id}', [BookingHistoryController::class, 'cancel'])->name('booking.cancel');
        Route::put('/booking/change-date/{id}', [BookingHistoryController::class, 'changeDate'])->name('booking.changeDate');


        // Show guide details + reviews
        Route::get('/guides/{id}', [GuideController::class, 'show'])->name('guide.show');
       

        // Reviews
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');



        
//Guide All Complete Routes



    Route::middleware(['auth'])->group(function () {
        Route::get('/guide/dashboard', [GuideHomeController::class, 'guideDashboard'])->name('guide.dashboard');
    });
    
    
    Route::get('/guidecontact', [GuideHomeController::class, 'guidecontact'])->name('guidecontact');
    Route::get('/guideabout', [GuideHomeController::class, 'guideabout'])->name('guideabout');

    //review page route
    Route::get('/guide/reviews', [GuideReviewController::class, 'index'])->name('guide.reviews');

    //Guide booking page
    Route::get('/guide/bookings', [GuideBookingController::class, 'index'])->name('guide.bookings');

