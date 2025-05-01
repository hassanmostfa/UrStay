<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AdminSupervisorsController;
use App\Http\Controllers\API\AdminUnitsController;
use App\Http\Controllers\API\OwnerController;
use App\Http\Controllers\API\SupervisorController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\CitiesController;
use App\Http\Controllers\API\DistrictsController;
use App\Http\Controllers\API\GovernoratesController;
use App\Http\Controllers\API\LocationsController;
use App\Http\Controllers\API\OwnerPermissionController;
use App\Http\Controllers\API\UnitsController;
use App\Http\Controllers\API\UnitsForOwnerController;
use App\Http\Controllers\API\ZonesController;
use App\Http\Controllers\API\FaqsController;
use App\Http\Controllers\API\PoliciesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Middleware\CheckIfAdminManager;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


use App\Http\Controllers\API\user\BookingsController;
use App\Http\Controllers\API\user\ProfileController;
use App\Http\Controllers\API\user\FavoritesController;
use App\Http\Controllers\API\user\ChatController;
use App\Http\Controllers\API\user\UserNegotiationsController;
use App\Http\Controllers\API\user\OwnersNotificationsController;
use App\Http\Controllers\API\user\RatingsController;
use App\Http\Controllers\API\user\AdditionalInfoController;
use App\Http\Controllers\API\user\UserWalletController;
use App\Http\Controllers\API\user\UserBankAccountController;
use App\Http\Controllers\API\user\UserCouponsController;
use App\Http\Controllers\API\user\UserForgetPasswordController;

use App\Http\Controllers\API\owner\OwnerChatController;
use App\Http\Controllers\API\owner\NegotiationsController;
use App\Http\Controllers\API\owner\OwnerBookingsController;
use App\Http\Controllers\API\owner\CompletedUnitsController;
use App\Http\Controllers\API\owner\SupervisorChatController;
use App\Http\Controllers\API\owner\StatisticsController;
use App\Http\Controllers\API\owner\WalletController;
use App\Http\Controllers\API\owner\TransactionsController;
use App\Http\Controllers\API\owner\UsersNotificationsController;
use App\Http\Controllers\API\owner\AdminsNotificationsController;
use App\Http\Controllers\API\owner\BankAccountsController;
use App\Http\Controllers\API\owner\CouponsController;
use App\Http\Controllers\API\owner\PricingMechanismsController;
use App\Http\Controllers\API\owner\ForgetPasswordController;

use App\Http\Controllers\API\supervisor\OwnerChatController as SupervisorOwnerChatController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/unauth', function() {
    return response()->json([
        'status' => false,
        'msg' => 'Please login',
        'data' => null,
        'notes' => ['Invalid access']
    ], 401);
})->name('not.auth');

/*==================================================================================*/
//================================= Auth Routes ====================================
/*==================================================================================*/

Route::post('/auth/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/auth/verify-otp', [AuthController::class, 'verifyOtp']);
/*==================================================================================*/


/*==================================================================================*/
//================================= User Routes ====================================
/*==================================================================================*/
Route::controller(UserController::class)->group(function () {
    Route::post('/user/register','userRegister')->name('user.register');
    Route::post('/user/login','userLogin')->name('user.login');
    Route::post('/user/logout','userLogout')->name('user.logout')->middleware('auth:sanctum');
    Route::get('/units' , 'getAllUnits');
    Route::get('/completedUnit/{id}' , 'getCompletedUnitDetails');
    Route::get('/completedUnits' , 'getAllCompletedUnits'); // Get All Completed Units
});

Route::controller(BookingsController::class)->group( function () {
    Route::post('/user/calculate-price', 'calculatePrice'); // Calculate Days total price
    Route::get('/user/reserved-dates/{id}', 'getReservedDates'); // Get Reserved Dates for Specific Unit
    Route::put('/user/booking/payment/status/{booking_id}', 'updatePaymentStatusOrPaymentMethod'); // Update Payment Status Or Payment Method
});

Route::controller(RatingsController::class)->group( function () {
    Route::get('/unit/ratings/{id}', 'getUnitRatings'); // Get Unit Ratings
});

Route::controller(BookingsController::class)->middleware('auth:sanctum')->group( function () {
    Route::post('/user/book/unit/{id}', 'bookUnit'); // Book a unit
    Route::get('/user/bookings', 'getAllBookings'); // Get All Bookings
    Route::get('/user/bills', 'getAllBookingsBills'); // Get All Bookings Bills
});

Route::controller(ProfileController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/profile', 'getUserData'); // Get User Data
    Route::put('/user/profile/update', 'updateUserData'); // Update User Data
    Route::post('/user/profile/reset-password', 'resetUserPassword'); // Reset User Password
});

Route::controller(FavoritesController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/favorites', 'index'); // Get All Favorites
    Route::post('/user/favorites/store/{id}', 'store'); // Add Favorite
    Route::delete('/user/favorites/destroy/{id}', 'destroy'); // Delete Favorite
});

Route::controller(ChatController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/owners', 'getOwners'); // Get All Owners that treat with this customer
    Route::get('/user/chat/{owner_id}', 'startOrResumeChat'); // Start or Resume Chat
    Route::get('/user/messages/{chat_room_id}', 'showMessages'); // Show Messages
    Route::post('/user/chat/sendMessage', 'sendMessage'); // Send Message
});

// Negotiations Routes
Route::controller(UserNegotiationsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/negotiations', 'getAllNegotiations'); // Get All Negotiations For current User
    Route::get('/user/negotiations/{booking_id}', 'index'); // Get All Negotiations Messages for current Booking
    Route::post('/user/negotiations/message', 'store'); // Create New Negotiation Message
    Route::put('/user/negotiations/extend/{booking_id}', 'update'); // Extend Negotiation
    Route::put('/user/negotiations/accept/{booking_id}', 'acceptNegotiation'); // Accept Negotiation (Owner Price)
    Route::put('/user/negotiations/cancel/{booking_id}', 'cancelNegotiation'); // Cancel Negotiation (Booking)
});

// Owners Notifications Routes
Route::controller(OwnersNotificationsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/notifications', 'index'); // Get All Notifications
    Route::post('/user/notification', 'store'); // Send Notification
    Route::put('/user/notifications/mark-all-as-read', 'markAllAsRead'); // Mark All Notifications As Read
});

// Ratings Routes
Route::controller(RatingsController::class)->middleware('auth:sanctum')->group( function () {
    Route::post('/user/rating', 'create'); // Create New Rating
});

// Additional Info Routes
Route::controller(AdditionalInfoController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/additional-info', 'index'); // Get User Additional Info
    Route::post('/user/additional-info', 'store'); // Store User Additional Info
    Route::put('/user/additional-info', 'update'); // Update User Additional Info
    Route::delete('/user/additional-info', 'destroy'); // Delete User Additional Info
});

// Wallet Routes
Route::controller(UserWalletController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/wallet', 'index'); // Get Owner Wallet Data
    Route::post('/user/wallet/add/{ownerId}', 'addMoney'); // Add Money to Wallet
    Route::post('/user/wallet/withdraw/{ownerId}', 'withdrawMoney'); // Withdraw Money from Wallet
});

// User Bank Accounts Routes
Route::controller(UserBankAccountController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/user/bank-accounts', 'index'); // Get All Bank Accounts
    Route::post('/user/bank-account', 'store'); // Create New Bank Account
    Route::put('/user/bank-account/{bank_account_id}', 'update'); // Update Bank Account
});

// User Coupons Routes
Route::controller(UserCouponsController::class)->middleware('auth:sanctum')->group( function () {
    Route::post('/user/apply-coupon', 'applyCoupon'); // Apply Coupon
});

// User Forget Password Routes
Route::controller(UserForgetPasswordController::class)->group( function () {
    Route::post('/user/reset-password/otp', 'resetPasswordOtp'); // Send OTP to the user's phone
    Route::post('/user/reset-password/verify-otp', 'verifyResetPasswordOtp'); // Verify the OTP sent to the user's phone
    Route::put('/user/reset-password', 'resetPassword'); // Reset Password
});

/*==================================================================================*/


/*==================================================================================*/
//================================= Admin Routes ====================================
/*==================================================================================*/
Route::post('admin/login', [AdminController::class, 'login']);

Route::middleware('auth:sanctum,admin')->group(function () {
    Route::post('admin/logout', [AdminController::class, 'logout']);

    Route::prefix('admin/zones')->group(function () {
        Route::get('/', [ZonesController::class, 'getZones']); // Get all zones
        Route::post('/', [ZonesController::class, 'addZone']); // Add a new zone
        Route::delete('/{id}', [ZonesController::class, 'deleteZone']); // Delete a zone
    });

    Route::prefix('admin/governorates')->group(function () {
        Route::get('/', [GovernoratesController::class, 'getGovernorates']); // Get all governorates
        Route::post('/', [GovernoratesController::class, 'addGovernorate']); // Add a new governorate
        Route::delete('/{id}', [GovernoratesController::class, 'deleteGovernorate']); // Delete a governorate
        Route::get('/zone/{zoneId}/governorates', [CitiesController::class, 'getGovernoratesByZone']); // Get governorates by zone ID
    });

    Route::prefix('admin/cities')->group(function () {
        Route::get('/', [CitiesController::class, 'getCities']); // Get all cities
        Route::post('/', [CitiesController::class, 'addCity']); // Add a new city
        Route::delete('/{id}', [CitiesController::class, 'deleteCity']); // Delete a city by ID
        Route::get('/governorate/{governorateId}/cities', [DistrictsController::class, 'getCitiesByGovernorate']); // Get cities by governorate
    });

    Route::prefix('admin/districts')->group(function () {
        Route::get('/', [DistrictsController::class, 'getDistricts']); // Get all districts
        Route::post('/', [DistrictsController::class, 'addDistrict']); // Add a new district
        Route::delete('/{id}', [DistrictsController::class, 'deleteDistrict']); // Delete a district
    });


    Route::prefix('admin/supervisors')->group(function () {
        Route::get('/', [AdminSupervisorsController::class, 'getSupervisors']); // Get all supervisors
        Route::put('/{id}/approve', [AdminSupervisorsController::class, 'approveSupervisor']); // Approve a supervisor
        Route::put('/{id}/reject', [AdminSupervisorsController::class, 'rejectSupervisor']); // Reject a supervisor
    });

    // managers
    Route::delete('admin/managers/delete/{id}', [AdminController::class, 'deleteAdmin']);
    Route::post('admin/managers/assign-unit/{unitId}/{adminId}', [AdminController::class, 'assignUnitToAdmin']);
    Route::post('admin/receive-unit/{unitId}', [AdminController::class, 'receiveUnit']);
    Route::get('admin/managers/', [AdminController::class, 'viewAdmins']);
    Route::post('admin/managers/', [AdminController::class, 'storeAdmin']);
    Route::prefix('admin/units')->group(function () {
        Route::get('/', [AdminController::class, 'getUnits']); // Get all units
        Route::get('/search', [AdminController::class, 'getUnitsSearchPaginate']); // Get units with search and pagination
    });

    Route::prefix('admin/categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'getCategories']); // Get all categories
        Route::post('/', [CategoriesController::class, 'addCategory']); // Add a new category
        Route::delete('/{id}', [CategoriesController::class, 'deleteCategory']); // Delete a category

        Route::get('/{categoryId}/subcategories', [CategoriesController::class, 'getSubCategories']); // Get subcategories for a category
        Route::post('/subcategories', [CategoriesController::class, 'addSubCategory']); // Add a new subcategory
        Route::delete('/subcategories/{id}', [CategoriesController::class, 'deleteSubCategory']); // Delete a subcategory

        Route::get('/sub-of-subcategories', [CategoriesController::class, 'getSubOfSubCategories']); // Get all sub of subcategories
        Route::post('/sub-of-subcategories', [CategoriesController::class, 'addSubOfSubCategory']); // Add a new sub of subcategory
        Route::delete('/sub-of-subcategories/{id}', [CategoriesController::class, 'deleteSubOfSubCategory']); // Delete a sub of subcategory
    });

    // Apply authentication middleware for all admin routes
    Route::prefix('admin')->group(function () {

        // Public admin routes
        Route::get('/units', [AdminUnitsController::class, 'allUnits']);
        Route::get('/my-units', [AdminUnitsController::class, 'myUnits']);
        Route::get('/admin-units/{id}', [AdminUnitsController::class, 'adminUnits']);
        Route::get('/unit/{id}', [AdminUnitsController::class, 'unitDetails']);

        // Routes that require CheckIfAdminManager middleware
        Route::middleware(CheckIfAdminManager::class)->group(function () {
            // Unit management
            Route::put('/unit/{id}', [AdminUnitsController::class, 'updateUnit']);
            Route::delete('/unit/{id}', [AdminUnitsController::class, 'deleteUnit']);

            // Unit request approval/rejection
            Route::put('/approve-unit/{id}', [AdminUnitsController::class, 'approveUnit']);
            Route::put('/reject-unit/{id}', [AdminUnitsController::class, 'rejectUnit']);

        });
        // Special unit filters
        Route::get('/rejected-units', [AdminUnitsController::class, 'rejectedUnits']);
        Route::get('/updated-units', [AdminUnitsController::class, 'updatedUnits']);
        Route::get('/approved-units', [AdminUnitsController::class, 'getApprovedUnits']);

        // Show unit details for users
        Route::get('/user/unit/{id}', [AdminUnitsController::class, 'showUnitDetailsForUser']);
        Route::get('/new-units-requests', [AdminUnitsController::class, 'newUnitsRequests']);
    });


});

// Route::middleware('auth:sanctum')->group( function () {

// });
/*==================================================================================*/


/*==================================================================================*/
//================================= Owner Routes ====================================
/*==================================================================================*/
Route::prefix('owner')->group(function () {
    // Registration routes
    Route::post('register', [OwnerController::class, 'register']);

    // Login routes
    Route::post('login', [OwnerController::class, 'loginAction']);

    // Logout route (Protected with auth:owner middleware)
    Route::post('logout', [OwnerController::class, 'logout'])->middleware('auth:sanctum');

    // Fetch dependent data routes (Governorates, Cities, Districts)
    Route::get('governorates/{zoneId}', [OwnerController::class, 'getGovernorates']);
    Route::get('cities/{governorateId}', [OwnerController::class, 'getCities']);
    Route::get('districts/{cityId}', [OwnerController::class, 'getDistricts']);

    // Fetch category related routes
    Route::get('subcategories/{categoryId}', [OwnerController::class, 'getSubcategories']);
    Route::get('sub-subcategories/{subcategoryId}', [OwnerController::class, 'getSubSubcategories']);
});

// Reset password route
Route::put('owner/reset/password', [OwnerController::class, 'resetPassword']); // Reset Owner Password


Route::controller(OwnerController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner','ownerData'); // Get Authenticated Owner
    Route::put('/owner/profile/update','updateProfile'); // Update Owner Profile
    Route::get('/owner/completedUnits','getAllCompletedUnits'); // Get All Completed Units
    Route::post('/owner/password/reset','resetOwnerPassword'); // Reset Owner Password
});

Route::controller(CategoriesController::class)->group( function () {
    // Get All Categories
    Route::get('/categories','getCategories');
});

// Geographical Locations Routes
Route::controller(LocationsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/zones','getAllZones');// Get All Zones
    Route::get('/owner/governorates/{zoneId}','getGovernoratesByZoneId');// Get Governorates By Zone Id
    Route::get('/owner/cities','getCities'); // Get Cities By Governorate Id
    Route::get('/owner/districts/{cityId}','getDistrictsByCityId'); // Get Districts By City Id
});

// Units Routes For Owner
Route::middleware('auth:sanctum')->prefix('owner')->group( function () {
    // Get Add Unit Page Data (Categories, Zones, Governorates, Cities, Districts)
    Route::get('/units/get-unit-data', [UnitsForOwnerController::class, 'getAddUnitPageData']);

    // Add a new Unit
    Route::post('/units', [UnitsForOwnerController::class, 'addUnit']);

    // Get Owner's Units
    Route::get('/units', [UnitsForOwnerController::class, 'getOwnerUnits']);

    // Show Unit Details
    Route::get('/units/{id}', [UnitsForOwnerController::class, 'showUnitDetails']);

    // Update a Unit
    Route::put('/units/{id}', [UnitsForOwnerController::class, 'updateUnit']);

    // Delete a Unit
    Route::delete('/units/{id}', [UnitsForOwnerController::class, 'deleteUnit']);

    Route::get('/updated-units', [UnitsForOwnerController::class, 'updatedUnits']);
    // Show Rejected Units
    Route::get('/rejected-units', [UnitsForOwnerController::class, 'rejectedUnits']);

    // Update Cancelation Type
    Route::put('/units/cancelation-type/{id}', [UnitsForOwnerController::class, 'updateCancelationType']);

    // Update Booking Type
    Route::put('/units/booking-type/{id}', [UnitsForOwnerController::class, 'updateBookingType']);

    
    
    Route::controller(CompletedUnitsController::class)->group(function () {
        Route::post('/completedUnits/{id}', 'saveCompletedUnits'); // Save a completed unit
        Route::get('/completed-units','showCompletedUnits'); // Show all completed units for admin
        Route::put('/completedUnits/update/{id}','updateCompletedUnitsData'); // Update a specific completed unit
        Route::put('/completedUnits/follows-pricing-mechanism/{id}','updateFollowsPricingMechanism'); // Update Follows Pricing Mechanism
        Route::put('/completedUnits/publishment-status/{id}','updatePublishmentStatusOrPublishmentDate'); // Update Publishment Status Or Publishment Date
});

        Route::controller(OwnerPermissionController::class)->group(function () {
            Route::get('/supervisors', 'getSupervisors'); // Get All Supervisors
            Route::get('/permissions', 'showAssignForm'); // Get Permissions with Supervisors
            Route::post('/permissions/assign', 'assignPermissions');   // Assign Permissions to Supervisors
            Route::delete('/permissions/{id}', 'deletePermission'); // Delete a Permission
        });

});

// Owner Chat Routes
Route::controller(OwnerChatController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/users', 'getUsers'); // Get All Users that treat with this owner from bookings table
    Route::get('/owner/chat/{userId}', 'startOrResumeChat'); // Start a new chat or continue an existing one
    Route::get('/owner/messages/{chatRoomId}', 'showMessages'); // Display the messages view for an existing chat session
    Route::post('/owner/sendMessage', 'sendMessage'); // Store a new message in the chat session
});

// Negotiations Routes
Route::controller(NegotiationsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/negotiations', 'getAllNegotiations'); // Get All Negotiations
    Route::get('/owner/negotiations/{id}', 'index'); // Get All Negotiations for current Booking
    Route::post('/owner/negotiations/message', 'store'); // Create New Negotiation Message
    Route::put('/owner/negotiations/extend/{id}', 'update'); // Extend Negotiation
    Route::put('/owner/negotiations/accept/{id}', 'acceptNegotiation'); // Accept Negotiation
    Route::put('/owner/negotiations/cancel/{id}', 'cancelNegotiation'); // Cancel Negotiation
});

// Owner Bookings Routes
Route::controller(OwnerBookingsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/bookings', 'index'); // Get All Bookings
    Route::put('/owner/booking/accept/{booking_id}', 'acceptBookingRequest'); // Accept Booking
    Route::get('/owner/units/bookings/{unit_id}', 'getMyUnitsReservedDates'); // Get Reserved Dates for Specific Unit
    Route::post('/owner/disable/unit/{id}', 'disableUnit'); // Disable Unit
    Route::put('/owner/booking/payment/status/{booking_id}', 'updatePaymentStatusOrPaymentMethod'); // Update Payment Status Or Payment Method
    Route::put('/owner/booking/dates/{booking_id}', 'updateBookingDates'); // Update Booking Start & End Date
    Route::delete('/owner/delete/booking/{booking_id}', 'deleteBooking'); // Delete Booking
});

// Supervisor Chat Routes
Route::controller(SupervisorChatController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/supervisors', 'getSupervisors'); // Get All Supervisors
    Route::get('/owner/supervisor/chat/{supervisorId}', 'startOrResumeChat'); // Start a new chat or continue an existing one    
    Route::get('/owner/supervisor/messages/{chatRoomId}', 'showMessages'); // Display the messages view for an existing chat session
    Route::post('/owner/supervisor/sendMessage', 'sendMessage'); // Store a new message in the chat session
});

// Statistics Routes
Route::controller(StatisticsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/bookings/number', 'getOwnerBookingsCount'); // Get All Bookings Count
    Route::get('/owner/bookings/{unit_id}', 'getUnitBookingsCount'); // Get Bookings Count for Specific Unit
    Route::get('/owner/revenue', 'calculateTotalRevenue'); // Calculate Total Revenue
    Route::get('/owner/unit/revenue/{unit_id}', 'getUnitRevenue'); // Get Revenue for Specific Unit
});

// Wallet Routes
Route::controller(WalletController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/wallet', 'index'); // Get Owner Wallet Data
    Route::post('/owner/wallet/add/{ownerId}', 'addMoney'); // Add Money to Wallet
    Route::post('/owner/wallet/withdraw/{ownerId}', 'withdrawMoney'); // Withdraw Money from Wallet
});

// Transactions Routes
Route::controller(TransactionsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/transactions', 'index'); // Get All Transactions
    Route::get('/owner/transactions', 'ownerTransactions');  // Get Owner Transactions
    Route::post('/owner/transaction', 'store'); // Create New Transaction
});

// Users Notifications Routes
Route::controller(UsersNotificationsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/notifications', 'index'); // Get All Notifications
    Route::post('/owner/notification', 'store'); // Create New Notification
    Route::put('/owner/notifications/mark-all-as-read', 'markAllAsRead'); // Mark All Notifications As Read
});

// Admins Notifications Routes
Route::controller(AdminsNotificationsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/admin/notifications', 'index'); // Get All Notifications
    Route::post('/owner/admin/notification', 'store'); // Create New Notification
    Route::put('/owner/admin/notifications/mark-all-as-read', 'markAllAsRead'); // Mark All Notifications As Read
});

// Owner Bank Accounts Routes
Route::controller(BankAccountsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/bank-accounts', 'index'); // Get All Bank Accounts
    Route::post('/owner/bank-account', 'store'); // Create New Bank Account
    Route::put('/owner/bank-account/{bank_account_id}', 'update'); // Update Bank Account
});

// Owner Coupons Routes
Route::controller(CouponsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/coupons', 'index'); // Get All Coupons
    Route::post('/owner/coupon', 'store'); // Create New Coupon
    Route::put('/owner/coupon/{coupon_id}', 'update'); // Update Coupon
    Route::delete('/owner/coupon/{coupon_id}', 'destroy'); // Delete Coupon
});

// Pricing Mechanisms Routes
Route::controller(PricingMechanismsController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/owner/pricing-mechanisms', 'index'); // Get All Pricing Mechanisms
    Route::get('/owner/unit/pricing-mechanisms/{unit_id}', 'getUnitPricingMechanisms'); // Get Pricing Mechanisms for Specific Unit
    Route::post('/owner/pricing-mechanism', 'store'); // Create New Pricing Mechanism
    Route::put('/owner/pricing-mechanism/{pricing_mechanism_id}', 'update'); // Update Pricing Mechanism
    Route::delete('/owner/pricing-mechanism/{pricing_mechanism_id}', 'destroy'); // Delete Pricing Mechanism
});

// User Forget Password Routes
Route::controller(ForgetPasswordController::class)->group( function () {
    Route::post('/owner/reset-password/otp', 'resetPasswordOtp'); // Send OTP to the user's phone
    Route::post('/owner/reset-password/verify-otp', 'verifyResetPasswordOtp'); // Verify the OTP sent to the user's phone
    Route::put('/owner/reset-password', 'resetPassword'); // Reset Password
});
/*==================================================================================*/


/*==================================================================================*/
//================================= Supervisor Routes ====================================
/*==================================================================================*/
Route::controller(SupervisorController::class)->group(function () {
    Route::post('/supervisor/register','register')->name('supervisor.register');
    Route::post('/supervisor/login','login')->name('supervisor.login');
    Route::post('/supervisor/logout','supervisorLogout')->name('supervisor.logout')->middleware('auth:sanctum');
});

// Owner Supervisor Chat Routes
Route::controller(SupervisorOwnerChatController::class)->middleware('auth:sanctum')->group( function () {
    Route::get('/supervisor/owners', 'getOwners'); // Get All Owners
    Route::get('/supervisor/owner/chat/{ownerId}', 'startOrResumeChat'); // Start a new chat or continue an existing one
    Route::get('/supervisor/owner/messages/{chatRoomId}', 'showMessages'); // Display the messages view for an existing chat session
    Route::post('/supervisor/owner/sendMessage', 'sendMessage'); // Store a new message in the chat session
});


/*==================================================================================*/
Route::post('create-notification', [NotificationsController::class, 'create'])->name('test.pushNotification');
Route::get('/admin/SSE-get-notifications/{admin_id}', [NotificationsController::class, 'adminSSE'])->name('admin.sse');
Route::get('/get-admin-notifications', [NotificationsController::class, 'getAdminNotifications']);


/*==================================================================================*/

/*==================================================================================*/
//================================= Shared Routes ====================================
/*==================================================================================*/
Route::controller(FaqsController::class)->group(function () {
    Route::get('/faqs', 'index'); // Get All Faqss
});
Route::controller(PoliciesController::class)->group(function () {
    Route::get('/policies', 'index'); // Get All Faqss
});
/*==================================================================================*/