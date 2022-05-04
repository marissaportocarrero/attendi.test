<?php

use App\Http\Controllers\ConnectController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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

Route::get('/', 'ConnectController@getLogin');

// Routes Auth
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin')->name('login');
Route::get('/register', 'ConnectController@getRegister')->name('register');
Route::post('/register', 'ConnectController@postRegister')->name('register');
Route::get('/recover', 'ConnectController@getRecover')->name('recover');
Route::post('/recover', 'ConnectController@postRecover')->name('recover');
Route::get('/reset', 'ConnectController@getReset')->name('reset');
Route::post('/reset', 'ConnectController@postReset')->name('reset');
Route::get('/logout', 'ConnectController@getLogout')->name('logout');

Route::get('/attendance/fecha', 'PDFController@index')->name('attendance.index');
Route::post('/attendance/store', 'PDFController@store')->name('attendance.store');

// Route::get('/admin/reports', 'Admin\ReportController@getHome')->name('admin.reporte');
// Exportacion
Route::get('/attendance/pdf', 'PDFController@getAttendanceTardanza')->name('reporte.tardanza');
Route::get('/attendance/excel', 'ExcelController@getAttendaceExcel')->name('excel.reporte');

// Reporte

// General
Route::get("/attendance/reportegeneral", "ReporteController@reportegeneral")->name("general.index");

Route::get("/attendance/reportgeneral/store", "ReporteController@resgeneral")->name("general.store");
Route::get("/attendance/reportgeneral/getEmpresa", "ReporteController@getEmpresa")->name("empresa.all");

// exportacion pdf

Route::get("/attendance/reportgeneral/pdf", "ReporteController@pdfresgeneral")->name('general.pdf');
Route::get("/attendance/reportgeneral/pdf/sub", "ReporteController@pdfsub")->name('general.subpdf');

// exportacion excel
Route::get('/attendance/reportgeneral/xls', 'ReporteController@xlsresgeneral')->name('general.excel');
Route::get('/attendance/reportgeneral/xls/sub', 'ReporteController@xlsresgeneral')->name('general.excelsub');

// Empleados
Route::get('/employees/all', 'EmployeesController@all')->name('employee.all');

Route::get('/employee/create', 'EmployeesController@create')->name('employee.create');
Route::post('/employee/store', 'EmployeesController@store')->name('employee.store');
Route::get('/employee/{employee}', 'EmployeesController@show')->name('employee.show');
// Route::put('/employee/{employee}', 'EmployeesController@update')->name('employee.update');
Route::put('/employee', 'EmployeesController@update')->name('employee.update');


// Reportes por empresas
Route::get('/reportenterprises', 'ReporteEnterprisesController@index')->name('enterprisereport.index');
Route::get('/reportenterprises/all', 'ReporteEnterprisesController@all')->name('enterprisereport.all');
