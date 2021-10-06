<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\Site_Home;
use App\Http\Controllers\sitecontrol\auth\ForgotPasswordController;
use App\Http\Controllers\sitecontrol\auth\LoginController;
use App\Http\Controllers\sitecontrol\auth\LogoutController;
use App\Http\Controllers\sitecontrol\auth\SignupController;
use App\Http\Controllers\sitecontrol\managedashboard\Dashboard;
use App\Http\Controllers\sitecontrol\manageaboutus\Controls as ManageAboutUs;
use App\Http\Controllers\sitecontrol\managepilots\Controls as ManagePilots;
use App\Http\Controllers\sitecontrol\manageflightshistory\Controls as ManageFlightsHistory;
use App\Http\Controllers\sitecontrol\managemyaccount\Controls as ManageMyAccountController;
use App\Http\Controllers\sitecontrol\managesitesettings\Controls as ManageSiteSettings;
use App\Http\Controllers\sitecontrol\Managerolespermissions\Controls as ManageRolesPermissions;



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


Route::group(  ['middleware' => [ 'web'] ]   , function () {
    Route::match(['get'], '/', [
        Site_Home::class,
        'index',
    ]);	
});



Route::group(['middleware' => ['guest', 'web'], 'prefix' => 'sitecontrol', 'namespace' => \Config::get('constants.SITECONTROL_FOLDER')], function () {

    #LOGIN
    Route::match(['get', 'post'], '/', [
        LoginController::class, 'getLogin'
    ])->name('domainuser.login');
    
    

    Route::match(['get', 'post'], '/login', [
        LoginController::class, 'getLogin'
    ])->name('domainuser.login');
    #LOGIN



    #FORGOT PASSWORD
    Route::match(['get', 'post'], '/forgotpassword', [
        ForgotPasswordController::class, 'getForgotPassword'
    ])->name('domainuser.forgotpassword');
    #FORGOT PASSWORD
 


    #CHANGE PASSWORD
    Route::match(['get', 'post'], '/changepassword', [
        LoginController::class, 'getChangePassword'
    ])->name("domainuser.changepassword");
    #CHANGE PASSWORD


    #CREATE ACCOUNT
    Route::match(['get', 'post'], '/create', [
        SignupController::class, 
        'create'
    ])->name('domainuser.create');
    #CREATE ACCOUNT

});

//'prefix' => 'sitecontrol',
// 'namespace' => \Config::get('constants.SITECONTROL_FOLDER')
Route::group(['middleware' => ['web', 'verifyrolepermissions']], function () {

    #DASHBOARD
    Route::match(['get', 'post'], '/dashboard', [
        Dashboard::class,
        "view",
    ])->name('dashboard.view');
    #DASHBOARD



    #ABOUT US
    Route::match(['get', 'post'], '/about-us', [
        ManageAboutUs::class,
        "view",
    ])->name('about-us.view');
    #ABOUT US


    #PILOT VIEW
    Route::match(['get'], '/pilot/view/{pilot_id?}', [
        ManageMyAccountController::class,
        "view",
    ])->name('pilot.view.view');
    #PILOT VIEW
    

});



// Sitecontrol Auth Route
Route::group(['middleware' => ['domain.user', 'verifyrolepermissions'], 'namespace' => 'sitecontrol', 'prefix' => 'sitecontrol'], function () {

    Route::get('/clear', function () {
        $exitCode = '';
        $exitCode .= Artisan::call('config:clear');
        $exitCode .= Artisan::call('cache:clear');
        $exitCode .= Artisan::call('config:cache');
        $exitCode .= Artisan::call('view:clear');
        return redirect()->back();
    });

    #LOGOUT
    Route::get('/logout', [
        LogoutController::class,
        'getLogout',
    ])->name('get.Logout');
    #LOGOUT

 

    #MANAGE ROLE PERMISSIONS
    Route::group(array( 'prefix' => 'managerolespermissions', 'namespace' => 'managerolespermissions' ), function () {

        Route::match(['get', 'post'], '/view', [
            ManageRolesPermissions::class,
            'view',
        ])->name('managerolespermissions.view');
        

             
        Route::match(['get', 'post'], '/add', [
            ManageRolesPermissions::class,
            'add',
        ])->name("managerolespermissions.add");;


        
        
        Route::match(['get'], '/edit/{id}', [
            ManageRolesPermissions::class,
            'edit',
        ]);



        Route::match(['get', 'post'], '/save', [
            ManageRolesPermissions::class,
            'save',
        ])->name("managerolespermissions.save")->middleware("verifypost:managerolespermissions.view");



        Route::match( ['get', 'post'], '/options', [
            ManageRolesPermissions::class,
            'options',
        ])->middleware(['middleware' => 'verifypost:managerolespermissions.view']);


       
        
        
    });
    #MANAGE ROLE PERMISSIONS





    #MANAGE SITE SETTINGS
    Route::group(['namespace' => 'managesitesettings', 'prefix' => 'managesitesettings'], function () {

        Route::match( ['get', 'post'], '/options', [
            ManageSiteSettings::class,
            'options',
        ])->middleware(['middleware' => 'verifypost:managesitesettings.view'])
        ->name('managesitesettings.options');




        Route::match(['get', 'post'], '/view', [
            ManageSiteSettings::class,
            'view',
        ])->name('managesitesettings.view');
        

    
        Route::match(['get', 'post'], '/save', [
            ManageSiteSettings::class,
            'save',
        ])->middleware("verifypost:managesitesettings.view")
        ->name('managesitesettings.save');





        Route::match(['get', 'post'], '/ranks/view', [
            ManageSiteSettings::class,
            'ranks_view',
        ])->name('managesitesettings.ranks.view');
           

        Route::match(['get', 'post'], '/ranks/add', [
            ManageSiteSettings::class,
            'ranks_add',
        ])->name("managesitesettings.ranks.add");;


        Route::match(['get', 'post'], '/ranks/edit/{rank_id?}', [
            ManageSiteSettings::class,
            'ranks_edit',
        ])->name("managesitesettings.ranks.edit");


        Route::match(['get', 'post'], '/ranks/save', [
            ManageSiteSettings::class,
            'save',
        ])->name("managesitesettings.ranks.save")->middleware("verifypost:managesitesettings.ranks.view");








        Route::match(['get', 'post'], '/aircraft/view', [
            ManageSiteSettings::class,
            'aircraft_view',
        ])->name('managesitesettings.aircraft.view');
           
        Route::match(['get', 'post'], '/aircraft/add', [
            ManageSiteSettings::class,
            'aircraft_add',
        ])->name("managesitesettings.aircraft.add");;

        Route::match(['get', 'post'], '/aircraft/edit/{aircraft_id?}', [
            ManageSiteSettings::class,
            'aircraft_edit',
        ])->name("managesitesettings.aircraft.edit");

        Route::match(['get', 'post'], '/aircraft/save', [
            ManageSiteSettings::class,
            'save',
        ])->name("managesitesettings.aircraft.save")->middleware("verifypost:managesitesettings.aircraft.view");


    });
    #MANAGE SITE SETTINGS





    #MANAGE MY ACCOUNT
     Route::group(['namespace' => 'managemyaccount', 'prefix' => 'managemyaccount'], function () {

        // Route::match(['get', 'post'], '/view/{pilot_id?}', [
        //     ManageMyAccountController::class,
        //     'view',
        // ])->name('managemyaccount.view');

     

        Route::match(['get', 'post'], '/edit/{pilot_id?}', [
            ManageMyAccountController::class,
            'edit',
        ])->name("managemyaccount.edit");


        Route::match(['get', 'post'], '/save', [
            ManageMyAccountController::class,
            'save',
        ])->name("managemyaccount.save")->middleware("verifypost:managemyaccount.view");
    });
    #MANAGE MY ACCOUNT





    #MANAGE PILOTS
    Route::group(['namespace' => 'managepilots', 'prefix' => 'managepilots'], function () {

        Route::match(['get'], '/', [
            ManagePilots::class,
            'view',
        ])->name('managepilots.view');;

        Route::match(['get', 'post'], '/view/{view_filter?}', [
            ManagePilots::class,
            'view',
        ])->name('managepilots.view');
        
        Route::match(['get', 'post'], '/save', [
            ManagePilots::class,
            'save',
        ])->middleware(['middleware' => 'verifypost:managepilots.view'])
        ->name('managepilots.save');;


        Route::match( ['get', 'post'], '/options', [
            ManagePilots::class,
            'options',
        ])->middleware(['middleware' => 'verifypost:managepilots.view'])
        ->name('managepilots.options');;


        Route::match(['get'], '/edit/{id}', [
            ManagePilots::class,
            'edit',
        ])->name('managepilots.edit');;



        
        Route::match(['get', 'post'], '/add', [
            ManagePilots::class,
            'add',
        ])->name('managepilots.add');


        /*
        Route::match(['get', 'post'], '/detail/{id}', [
            FAQSController::class,
            'details',
        ]);
        */
    });
    #MANAGE PILOTS





     #MANAGE FLIGHTS HISTORY
     Route::group(['namespace' => 'manageflightshistory', 'prefix' => 'manageflightshistory'], function () {

        Route::match(['get'], '/', [
            ManageFlightsHistory::class,
            'view',
        ])->name("manageflightshistory.view");

        Route::match(['get', 'post'], '/view/{view_filter?}', [
            ManageFlightsHistory::class,
            'view',
        ])->name('manageflightshistory.view');;
        
        Route::match(['get', 'post'], '/save', [
            ManageFlightsHistory::class,
            'save',
        ])->middleware(['middleware' => 'verifypost:manageflightshistory.view'])
        ->name("manageflightshistory.save");


        Route::match( ['get', 'post'], '/options', [
            ManageFlightsHistory::class,
            'options',
        ])->middleware(['middleware' => 'verifypost:manageflightshistory.view'])
        ->name("manageflightshistory.options");


        Route::match(['get'], '/edit/{id}', [
            ManageFlightsHistory::class,
            'edit',
        ])->name("manageflightshistory.edit");
        
        Route::match(['get', 'post'], '/add', [
            ManageFlightsHistory::class,
            'add',
        ])->name("manageflightshistory.add");
    });
    #MANAGE FLIGHTS HISTORY

});
