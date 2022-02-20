<?php

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

use Illuminate\Support\Facades\Route;
use Whoops\Run;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function () 
{
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');
    
    

    Route::get('/academique-parteners', 'PartenerController@indexIndistruel')->name('parteners.index2');
    Route::get('/industrial-parteners', 'PartenerController@indexAcademique')->name('parteners.index1');
    Route::get('/parteners-create', 'PartenerController@create')->name('parteners.create');
    Route::post('/parteners-store', 'PartenerController@store')->name('parteners.store');
    Route::get('/parteners-edit/{id}', 'PartenerController@edit')->name('parteners.edit');
    Route::get('/parteners-show/{id}', 'PartenerController@show')->name('parteners.show');
    Route::put('/parteners-update/{id}', 'PartenerController@update')->name('parteners.update');
    Route::post('/parteners-delete/{id}', 'PartenerController@destroy')->name('parteners.destroy');

  
    Route::get('/partenershipActivity-create', 'PartenershipActivityController@create')->name('partenershipActivity.create');
    Route::post('/partenershipActivity-store', 'PartenershipActivityController@store')->name('partenershipActivity.store');
    Route::get('/partenershipActivity-edit/{id}', 'PartenershipActivityController@edit')->name('partenershipActivity.edit');
    Route::put('/partenershipActivity-update/{id}', 'PartenershipActivityController@update')->name('partenershipActivity.update');
    Route::get('/partenershipActivity-show/{id}', 'PartenershipActivityController@show')->name('partenershipActivity.show');
    
    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');
    
    Route::resource('filieres', 'FiliereController');
    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('student', 'StudentController');

    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');

});

Route::group(['middleware' => ['auth','role:Teacher']], function () 
{
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
});

Route::group(['middleware' => ['auth','role:Parent']], function () 
{
    Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show');
});

Route::group(['middleware' => ['auth','role:Student']], function () {

});
