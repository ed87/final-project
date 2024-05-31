<?php

use Illuminate\Support\Facades\Route;

// Applicant Controllers
use App\Http\Controllers\ApplicantJobController;
use App\Http\Controllers\ApplicantApplyToJobController;
use App\Http\Controllers\ApplicantJobApplicationController;
use App\Http\Controllers\ApplicantAccountController;
use App\Http\Controllers\ApplicantHomeController;

// Company Controller
use App\Http\Controllers\CompanyHomeController;
use App\Http\Controllers\CompanyAccountController;
use App\Http\Controllers\CompanyUserAccountController;
use App\Http\Controllers\CompanyJobController;
use App\Http\Controllers\CompanyInternshipController;
use App\Http\Controllers\CompanyJobApplicationController;
use App\Http\Controllers\CompanyInternshipApplicationController;


// Admin or University Controller
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminInternshipController;
use App\Http\Controllers\AdminApplyToInternshipController;
use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\AdminInternshipApplicationController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminUserAccountController;

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
})->name('welcome');

// Home Controllers for all User types.
Route::get('applicant/home', [ApplicantHomeController::class, 'index'])
    ->name('applicant.home');
Route::get('admin/home', [AdminHomeController::class, 'index'])
    ->name('admin.home');
Route::get('company/home', [CompanyHomeController::class, 'index'])
    ->name('company.home');


// Registration routes of all user types
Route::get('/applicant/register', function () {
    return view('auth.applicant.register');
})->name('applicant.register');

Route::get('/company/register', function () {
    return view('auth.company.register');
})->name('company.register');


// APPLICANT ROUTES
// ...................................................................................................................

// Applicant jobs
Route::get('applicant/jobs', [ApplicantJobController::class, 'index'])
    ->name('applicant.job.index');
// Route::post('applicant/jobs', [ApplicantJobController::class, 'store'])
// ->name('applicant.job.store');
// Route::get('applicant/jobs/{job}/edit', [ApplicantJobController::class, 'edit'])
// ->name('applicant.job.edit');
Route::get('applicant/jobs/{job}', [ApplicantJobController::class, 'show'])
    ->name('applicant.job.show');
// Route::put('applicant/jobs/{job}', [ApplicantJobController::class, 'update'])
// ->name('applicant.job.update');
// Route::delete('applicant/jobs/{job}', [ApplicantJobController::class, 'destroy'])
//     ->name('applicant.job.destroy');

Route::get('applicant/jobs/{job}/apply', [ApplicantApplyToJobController::class, 'index'])
    ->name('applicant.job.apply');

// Applicant Account
Route::get('applicant/account', [ApplicantAccountController::class, 'index'])
    ->name('applicant.account.index');
Route::put('applicant/account/{user}', [ApplicantAccountController::class, 'update'])
    ->name('applicant.account.update');

// Applicant job applications
Route::get('applicant/job-applications', [ApplicantJobApplicationController::class, 'index'])
    ->name('applicant.job-application.index');
Route::post('applicant/job-applications', [ApplicantJobApplicationController::class, 'store'])
    ->name('applicant.job-application.store');
Route::delete('applicant/job-applications/{id}', [ApplicantJobApplicationController::class, 'destroy'])
    ->name('applicant.job-application.destroy');


// COMPANY ROUTES
// ...................................................................................................................
Route::get('company/jobs', [CompanyJobController::class, 'index'])
    ->name('company.job.index');
Route::get('company/jobs/create', [CompanyJobController::class, 'create'])
    ->name('company.job.create');
Route::post('company/jobs', [CompanyJobController::class, 'store'])
    ->name('company.job.store');
Route::get('company/jobs/{job}/edit', [CompanyJobController::class, 'edit'])
    ->name('company.job.edit');
Route::get('company/jobs/{job}', [CompanyJobController::class, 'show'])
    ->name('company.job.show');
Route::put('company/jobs/{job}', [CompanyJobController::class, 'update'])
    ->name('company.job.update');
Route::delete('company/jobs/{job}', [CompanyJobController::class, 'destroy'])
    ->name('company.job.destroy');

Route::get('applicant/{user}/downloadcv/{file}', [ApplicantJobController::class, 'downloadCv'])
    ->name('applicant.job.downloadcv');

Route::get('university/{university}/downloadinternshipletter/{file}', [AdminInternshipController::class, 'downloadInternshipLetter'])
    ->name('admin.internship.downloadinternshipletter');

Route::get('company/internships', [CompanyInternshipController::class, 'index'])
    ->name('company.internship.index');
Route::get('company/internships/create', [CompanyInternshipController::class, 'create'])
    ->name('company.internship.create');
Route::post('company/internships', [CompanyInternshipController::class, 'store'])
    ->name('company.internship.store');
Route::get('company/internships/{internship}/edit', [CompanyInternshipController::class, 'edit'])
    ->name('company.internship.edit');
Route::get('company/internships/{internship}', [CompanyInternshipController::class, 'show'])
    ->name('company.internship.show');
Route::put('company/internships/{internship}', [CompanyInternshipController::class, 'update'])
    ->name('company.internship.update');
Route::delete('company/internships/{internship}', [CompanyInternshipController::class, 'destroy'])
    ->name('company.internship.destroy');

Route::get('company/account', [CompanyAccountController::class, 'index'])
    ->name('company.account.index');
Route::post('company/account', [CompanyAccountController::class, 'store'])
    ->name('company.account.store');
Route::put('company/account/{company}', [CompanyAccountController::class, 'update'])
    ->name('company.account.update');

Route::get('company/user-account', [CompanyUserAccountController::class, 'index'])
    ->name('company.user-account.index');
Route::put('company/user-account/{user}', [CompanyUserAccountController::class, 'update'])
    ->name('company.user-account.update');

// job applications
Route::get('company/job-applications', [CompanyJobApplicationController::class, 'index'])
    ->name('company.job-application.index');
Route::put('company/job-applications/{id}', [CompanyJobApplicationController::class, 'update'])
    ->name('company.job-application.update');
// Internship applications
Route::get('company/internship-applications', [CompanyInternshipApplicationController::class, 'index'])
    ->name('company.internship-application.index');
Route::put('company/internship-applications/{id}', [CompanyInternshipApplicationController::class, 'update'])
    ->name('company.internship-application.update');

// UNIVERSITY ROUTES
// ...................................................................................................................

// Admin companies
Route::get('admin/company', [AdminCompanyController::class, 'index'])
    ->name('admin.company.index');
Route::get('admin/company/create', [AdminCompanyController::class, 'create'])
    ->name('admin.company.create');
Route::post('admin/company', [AdminCompanyController::class, 'store'])
    ->name('admin.company.store');
Route::get('admin/company/{company}/edit', [AdminCompanyController::class, 'edit'])
    ->name('admin.company.edit');
Route::get('admin/company/{company}', [AdminCompanyController::class, 'show'])
    ->name('admin.company.show');
Route::put('admin/company/{company}', [AdminCompanyController::class, 'update'])
    ->name('admin.company.update');
Route::delete('admin/company/{company}', [AdminCompanyController::class, 'destroy'])
    ->name('admin.company.destroy');

// Admin Internship application
Route::get('admin/internship-application', [AdminInternshipApplicationController::class, 'index'])
    ->name('admin.internship-application.index');
Route::post('admin/internship-application', [AdminInternshipApplicationController::class, 'store'])
    ->name('admin.internship-application.store');
Route::delete('admin/internship-applications/{id}', [AdminInternshipApplicationController::class, 'destroy'])
    ->name('admin.internship-application.destroy');

Route::get('admin/internships', [AdminInternshipController::class, 'index'])
    ->name('admin.internships.index');
Route::get('admin/internships/{internship}', [adminInternshipController::class, 'show'])
    ->name('admin.internship.show');


Route::get('admin/internships/{internship}/apply', [AdminApplyToInternshipController::class, 'index'])
    ->name('admin.internship.apply');

// Admin university account
Route::get('admin/account', [AdminAccountController::class, 'index'])
    ->name('admin.account.index');
Route::post('admin/account', [AdminAccountController::class, 'store'])
    ->name('admin.account.store');
Route::put('admin/account/{university}', [AdminAccountController::class, 'update'])
    ->name('admin.account.update');

// Admin user account
Route::get('admin/user-account', [AdminUserAccountController::class, 'index'])
    ->name('admin.user-account.index');
Route::put('admin/user-account/{user}', [AdminUserAccountController::class, 'update'])
    ->name('admin.user-account.update');
