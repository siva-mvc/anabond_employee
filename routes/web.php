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

Route::get('/', function () {
    return Redirect::to('/employee-management');
})->middleware('auth');

Auth::routes();

$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\SocialController@getSocialHandle']);



//Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard', function(){
	return Redirect::to('/employee-management');
})->middleware('auth');;
// Route::get('/system-management/{option}', 'SystemMgmtController@index');
Route::get('/profile', 'ProfileController@index');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::resource('employee-management', 'EmployeeManagementController');
Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');

Route::resource('system-management/department', 'DepartmentController');
Route::post('system-management/department/search', 'DepartmentController@search')->name('department.search');

Route::resource('system-management/designation', 'DesignationController');
Route::post('system-management/designation/search', 'DesignationController@search')->name('designation.search');

Route::resource('system-management/team', 'TeamController');
Route::post('system-management/team/search', 'TeamController@search')->name('team.search');

Route::resource('system-management/factor', 'PerformanceFactorController');
Route::post('system-management/factor/search', 'PerformanceFactorController@search')->name('factor.search');




Route::resource('system-management/country', 'CountryController');
Route::post('system-management/country/search', 'CountryController@search')->name('country.search');

Route::resource('system-management/state', 'StateController');
Route::post('system-management/state/search', 'StateController@search')->name('state.search');

Route::resource('system-management/city', 'CityController');
Route::post('system-management/city/search', 'CityController@search')->name('city.search');

Route::get('system-management/report', 'ReportController@index');
Route::post('system-management/report/search', 'ReportController@search')->name('report.search');
Route::post('system-management/report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('system-management/report/pdf', 'ReportController@exportPDF')->name('report.pdf');

//Configure factore
Route::get('employee-factors-management/{employee_id}/{year}', 'EmployeeFactorController@employee_factors_management')->name('employee_factor.factors_management');

Route::get('set-permission/{user_id}', 'UserManagementController@grandPerminsssion')->name('user.set_permission');;

Route::post('employee-factors-management/{employee_id}/{year}', 'EmployeeFactorController@save_employee_factors_management')->name('employee_factor.factors_save_management');


Route::get('employee-perfromance-sheet/{emp_id}/{year}', 'EmployeeFactorController@employee_perfromance_sheet')->name('employee_factor.perfromance_sheet');



Route::get('employee-perfromance-sheet-pdf-list/{dept_id}', 'EmployeeFactorController@exportList')->name('employee_factor.export_list');

Route::post('employee-perfromance-sheet/{emp_id}/{year}', 'EmployeeFactorController@perfromance_sheet_save')->name('employee_factor.perfromance_sheet_save');


Route::get('employee-perfromance-sheet-pdf', 'EmployeeFactorController@exportPDF')->name('sheet.pdf');


Route::get('employee-factors-update-credit/{dept_id}/{year}', 'EmployeeFactorController@employee_factors_update_credit')->name('employee_factor.factor_achivement_credit');

Route::post('employee-factors-update-credit/{dept_id}/{year}', 'EmployeeFactorController@employee_factors_update_achived_credit')->name('employee_factor.factor_achivement_credit_save');


Route:: get('employee-factor/configure/{employee_id}', 'EmployeeFactorController@update_employee_performance')->name('employee_factor.update_employee_performance');

Route::get('avatars/{name}', 'EmployeeManagementController@load');

// End

// Route::get('employee-factor-achivement', 'EmployeeFactorController@employee_factor_achivement')->name('employee_factor.factor_achivement');

// Route::get('employee-factor-achivement-month', 'EmployeeFactorController@employee_factor_achivement_month')->name('employee_factor.factor_achivement_month');

// Route::get('employee-factor-achivement-year', 'EmployeeFactorController@employee_factor_achivement_year')->name('employee_factor.factor_achivement_year');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
