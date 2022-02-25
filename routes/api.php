<?php

use Illuminate\Support\Facades\Route;

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

Route::post('register', 'UserController@register')->name('users.register');
Route::get('language', 'LanguageController@index')->name('language.index');
Route::get('content-word/global', 'ContentWordController@global')->name('content-word.global');

Route::group(['middleware' => 'auth:api'], function () {
    // User
    Route::apiResource('user', 'UserController');
    Route::get('users/profile', 'UserController@profile')->name('users.profile');
    Route::post('users/list', 'UserController@list')->name('users.list');
    Route::post('users/update-role', 'UserController@updateRole')->name('users.update-role');
    Route::post('users/update-permission', 'UserController@updatePermission')->name('users.update-permission');

    // Role
    Route::apiResource('role', 'RoleController');
    Route::post('roles/list', 'RoleController@list')->name('roles.list');
    Route::post('roles/toggle', 'RoleController@toggle')->name('roles.toggle');

    // Language
    Route::apiResource('language', 'LanguageController')->except('index');

    // Permission
    Route::apiResource('permission', 'PermissionController');
    Route::post('permissions/list', 'PermissionController@list')->name('permissions.list');

    // Content word
    Route::apiResource('content-word', 'ContentWordController');
    Route::post('content-words/list', 'ContentWordController@list')->name('content-words.list');

    // Organization
    Route::apiResource('organization', 'OrganizationController');
    Route::post('organizations/list', 'OrganizationController@list')->name('organizations.list');

    // Organization service
    Route::apiResource('organization-service', 'OrganizationServiceController')->except(['show']);
    Route::post('organization-services/toggle', 'OrganizationServiceController@toggle')
        ->name('organization-services.toggle');
    Route::post('organization-services/toggle-all', 'OrganizationServiceController@toggleAll')
        ->name('organization-services.toggle-all');

    // Organization doctor
    Route::apiResource('organization-doctor', 'OrganizationDoctorController')->except('show');
    Route::post('organization-doctors/toggle',
        'OrganizationDoctorController@toggle')->name('organization-doctors.toggle');

    // Doctor
    Route::apiResource('doctor', 'DoctorController');
    Route::post('doctors/list', 'DoctorController@list')->name('doctors.list');

    // Doctor specialty
    Route::apiResource('doctor-specialty', 'DoctorSpecialtyController')->except('show');
    Route::post('doctor-specialties/toggle', 'DoctorSpecialtyController@toggle')->name('doctor-specialties.toggle');

    // Picture
    Route::apiResource('picture', 'PictureController')->except('show');

    // Contact
    Route::get('contacts', 'ContactController@index')->name('contacts.index');
    Route::put('contacts', 'ContactController@update')->name('contacts.update');

    // Categories
    Route::apiResource('category', 'CategoryController');
    Route::post('categories/list', 'CategoryController@list')->name('categories.list');

    // Weekly schedule
    Route::apiResource('weekly-schedule', 'WeeklyScheduleController');
    Route::post('weekly-schedules/list', 'WeeklyScheduleController@list')->name('weekly-schedules.list');

    // Service
    Route::apiResource('service', 'ServiceController');
    Route::post('services/list', 'ServiceController@list')->name('services.list');

    // Specialty
    Route::apiResource('specialty', 'SpecialtyController');
    Route::post('specialties/list', 'SpecialtyController@list')->name('specialties.list');

    // Person
    Route::apiResource('person', 'PersonController')->except('index');
    Route::get('people/{jshshir}', 'PersonController@jshshir')->name('people.jshshir');

    // Organization type
    Route::apiResource('organization-type', 'OrganizationTypeController');
    Route::post('organization-types/list', 'OrganizationTypeController@list')->name('organization-types.list');

    // Specialty type
    Route::apiResource('specialty-type', 'SpecialtyTypeController');
    Route::post('specialty-types/list', 'SpecialtyTypeController@list')->name('specialty-types.list');

    // Service class
    Route::apiResource('service-class', 'ServiceClassController')->except('store');
    Route::post('service-classes/list', 'ServiceClassController@list')->name('service-classes.list');

    // Service section
    Route::apiResource('service-section', 'ServiceSectionController')->except('store');
    Route::post('service-sections/list', 'ServiceSectionController@list')->name('service-sections.list');

    // Service subsection
    Route::apiResource('service-subsection', 'ServiceSubsectionController')->except('store');
    Route::post('service-subsections/list', 'ServiceSubsectionController@list')->name('service-subsections.list');

    // University
    Route::apiResource('university', 'UniversityController');
    Route::post('universities/list', 'UniversityController@list')->name('universities.list');

    // Study degree
    Route::apiResource('study-degree', 'StudyDegreeController');
    Route::post('study-degrees/list', 'StudyDegreeController@list')->name('study-degrees.list');

    // Study type
    Route::apiResource('study-type', 'StudyTypeController');
    Route::post('study-types/list', 'StudyTypeController@list')->name('study-types.list');

    //Doctor study
    Route::apiResource('doctor-study', 'DoctorStudyController');

    //Organization equipment
    Route::apiResource('organization-equipment', 'OrganizationEquipmentController');

    //Work calendar
    Route::apiResource('work-calendar', 'WorkCalendarController');
    Route::post('work-calendars/list', 'WorkCalendarController@list')->name('work-calendar.list');

    //Organization service schedule
    Route::apiResource('organization-service-schedule', 'OrganizationServiceScheduleController');

});

