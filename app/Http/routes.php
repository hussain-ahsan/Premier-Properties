<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*The routes any user can access*/
Route::group(['middleware' => 'web'], function () {

    Route::get('404', function () {
        return View::make("errors/404");
    });

    Route::get('/', function () {
        return view("home/home");
    });

    Route::get('/about-us', function () {
        return view("aboutUs/aboutUs");
    });


    Route::get('/case-studies', function () {
        return view("caseStudies/caseStudies");
    });

    Route::get('/contact-us', function () {
        return view("contactUs/contactUs");
    });

    Route::post('/contactUs', [
        'as' => 'contactUs',
        'uses' => 'ContactUsController@contactUs'
    ]);

    Route::get('/portfolio', [
        'as' => 'portfolio',
        'uses' => 'PropertiesController@portfolio'
    ]);

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*The route an admin can access only*/
Route::group(['middleware' => 'web'], function () {
    /*Login related*/
    Route::auth();
    Route::get('/home', 'HomeController@index');

    Route::get('/login', [
        'as' => 'login',
        'uses' => 'LoginController@index'
    ]);

    Route::post('/login', [
        'as' => 'login',
        'uses' => 'LoginController@login'
    ]);

    Route::get('/register', function () {
        return redirect("/404");
    });

    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'LoginController@logout'
    ]);

    Route::get('/download', [
        'as' => 'download',
        'uses' => 'UserReportsController@downloadUserReport'
    ]);


    Route::group(['middleware' => 'RolesAndPermission'], function () {

        Route::get('/getProperty', [
            'permission' => env("permission_for_properties"),
            'as' => 'logout',
            'uses' => 'PropertiesController@getProperty'
        ]);

        Route::get('/properties', [
            'permission' => env("permission_for_properties"),
            'as' => 'properties',
            'uses' => 'PropertiesController@index'
        ]);

        Route::post('/saveProperty', [
            'permission' => env("permission_for_properties"),
            'as' => 'saveProperty',
            'uses' => 'PropertiesController@saveProperty'
        ]);

        Route::post('/updateProperty', [
            'permission' => env("permission_for_properties"),
            'as' => 'updateProperty',
            'uses' => 'PropertiesController@updateProperty'
        ]);


        Route::get('/companies', [
            'permission' => env("permission_for_company"),
            'as' => 'company',
            'uses' => 'CompanyController@index'
        ]);

        Route::post('/saveCompany', [
            'permission' => env("permission_for_company"),
            'as' => 'saveCompany',
            'uses' => 'CompanyController@saveCompany'
        ]);

        Route::post('/updateCompany', [
            'permission' => env("permission_for_company"),
            'as' => 'updateCompany',
            'uses' => 'CompanyController@updateCompany'
        ]);

        Route::get('/users', [
            'permission' => env("permission_for_users"),
            'as' => 'users',
            'uses' => 'UserController@showUsers'
        ]);

        Route::post('/addNewUser', [
            'permission' => env("permission_for_users"),
            'as' => 'addNewUser',
            'uses' => 'UserController@saveUser'
        ]);

        Route::post('/updateUser', [
            'permission' => env("permission_for_users"),
            'as' => 'updateUser',
            'uses' => 'UserController@updateUser'
        ]);

        Route::get('/property-detail/{id}', [
            'permission' => env("permission_for_properties"),
            'as' => 'singleProperty',
            'uses' => 'PropertiesController@singleProperty'
        ]);

        Route::post('/addNewPropertyReport', [
            'permission' => env("permission_for_properties"),
            'as' => 'addNewPropertyReport',
            'uses' => 'PropertyReportsController@savePropertyReport'
        ]);

        Route::post('/updatePropertyReport', [
            'permission' => env("permission_for_properties"),
            'as' => 'updatePropertyReport',
            'uses' => 'PropertyReportsController@updatePropertyReport'
        ]);

        Route::get('/getUserReports', [
            'permission' => env("permission_for_properties"),
            'as' => 'getUserReports',
            'uses' => 'UserReportsController@getPropertyReport'
        ]);

        Route::post('/removeNotifications', [
            'permission' => env("permission_for_properties"),
            'as' => 'removeNotifications',
            'uses' => 'PropertyReportsController@removeReportNotifications'
        ]);

        Route::post('/resetUserPassword', [
            'permission' => env("permission_for_users"),
            'as' => 'resetUserPassword',
            'uses' => 'UserController@resetPassword'
        ]);

    });

});
