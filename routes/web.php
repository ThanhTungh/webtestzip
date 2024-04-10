<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\MarketingCoordinator\CoordinatorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

/* Admin */
Route::get('/admin/login', [AdminController::class, 'login_view'])->name('admin_login'); // login
Route::post('/admin/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit'); // login submit

Route::get('/admin/register-submit', [AdminController::class, 'register_submit'])->name('admin_register_submit'); // Register 

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout'); // Logout 

Route::get('/admin/home', [AdminController::class, 'home'])->name('admin_home')->middleware('admin:admin'); // Homepage view

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard')->middleware('admin:admin'); // Dashboard view

Route::get('/admin/list-accounts', [AdminController::class, 'list_accounts'])->name('admin_list_accounts')->middleware('admin:admin'); // List Account view

Route::get('/admin/add-account', [AdminController::class, 'add_account'])->name('admin_add_account')->middleware('admin:admin'); // Add an account view
Route::post('/admin/add-account-submit', [AdminController::class, 'add_account_submit'])->name('admin_add_account_submit')->middleware('admin:admin'); // Add an account submit

Route::get('/admin/edit-account/manager/{id}', [AdminController::class, 'edit_account_manager'])->name('admin_edit_account_manager')->middleware('admin:admin'); // Edit a manager account view
Route::post('/admin/edit-account/manager/{id}/update', [AdminController::class, 'edit_account_manager_submit'])->name('admin_edit_account_manager_submit')->middleware('admin:admin'); // Edit a manager account submit
Route::get('/admin/delete-account/manager/{id}', [AdminController::class, 'delete_account_manager_submit'])->name('admin_delete_account_manager_submit')->middleware('admin:admin'); // Delete a manager account

Route::get('/admin/edit-account/coordinator/{id}', [AdminController::class, 'edit_account_coordinator'])->name('admin_edit_account_coordinator')->middleware('admin:admin'); // Edit a coordinator account view
Route::post('/admin/edit-account/coordinator/{id}/update', [AdminController::class, 'edit_account_coordinator_submit'])->name('admin_edit_account_coordinator_submit')->middleware('admin:admin'); // Edit a coordinator account submit
Route::get('/admin/delete-account/coordinator/{id}', [AdminController::class, 'delete_account_coordinator_submit'])->name('admin_delete_account_coordinator_submit')->middleware('admin:admin'); // Delete a coordinator account

Route::get('/admin/edit-account/student/{id}', [AdminController::class, 'edit_account_student'])->name('admin_edit_account_student')->middleware('admin:admin'); // Edit a student account view
Route::post('/admin/edit-account/student/{id}/update', [AdminController::class, 'edit_account_student_submit'])->name('admin_edit_account_student_submit')->middleware('admin:admin'); // Edit a student account submit

Route::get('/admin/delete-account/student/{id}', [AdminController::class, 'delete_account_student_submit'])->name('admin_delete_account_student_submit')->middleware('admin:admin'); // Delete a student account

Route::get('/admin/list-faculties', [AdminController::class, 'list_faculties'])->name('admin_faculties')->middleware('admin:admin'); // List faculties view

Route::get('/admin/add-faculty', [AdminController::class, 'add_faculty'])->name('admin_add_faculty')->middleware('admin:admin'); // Add a faculty view
Route::post('/admin/add-faculty-submit', [AdminController::class, 'add_faculty_submit'])->name('admin_add_faculty_submit')->middleware('admin:admin'); // Add a faculty view

Route::get('/admin/edit-faculty/{id}', [AdminController::class, 'edit_faculty'])->name('admin_edit_faculty')->middleware('admin:admin'); // Edit a faculty view
Route::post('/admin/edit-faculty/{id}/update', [AdminController::class, 'edit_faculty_submit'])->name('admin_edit_faculty_submit')->middleware('admin:admin'); // Edit a faculty submit

Route::get('/admin/delete-faculty/{id}', [AdminController::class, 'delete_faculty_submit'])->name('admin_delete_faculty_submit')->middleware('admin:admin'); // Delete a faculty 

Route::get('/admin/faculty/{id}/list-ideas', [AdminController::class, 'list_ideas'])->name('admin_ideas')->middleware('admin:admin'); // List ideas view


Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin_profile')->middleware('admin:admin'); // Profile view





/* Marketing Manager */


/* Marketing Coordinator */
Route::get('/coordinator/login', [CoordinatorController::class, 'login_view'])->name('coordinator_login'); // login
Route::post('/coordinator/login-submit', [CoordinatorController::class, 'login_submit'])->name('coordinator_login_submit'); // login submit

Route::get('/coordinator/logout', [CoordinatorController::class, 'logout'])->name('coordinator_logout'); // Logout 

Route::get('/coordinator/home', [CoordinatorController::class, 'home'])->name('coordinator_home')->middleware('coordinator:coordinator'); // Homepage view

Route::get('/coordinator/profile', [CoordinatorController::class, 'profile'])->name('coordinator_profile')->middleware('coordinator:coordinator'); // Profile view

Route::get('/coordinator/list-faculties', [CoordinatorController::class, 'list_faculties'])->name('coordinator_faculties')->middleware('coordinator:coordinator'); // List faculties view

Route::get('/coordinator/faculty/{id}/list-ideas', [CoordinatorController::class, 'list_ideas'])->name('coordinator_list_ideas')->middleware('coordinator:coordinator'); // List ideas view

Route::get('/coordinator/download/{file}', [CoordinatorController::class, 'download_file'])->name('coordinator_download_file')->middleware('coordinator:coordinator'); // Download file

Route::post('/coordinator/comment-submit/idea/{id}', [CoordinatorController::class, 'comment_submit'])->name('coordinator_comment_submit')->middleware('coordinator:coordinator'); // comment submit

Route::get('/coordinator/idea/{id}/active-status', [CoordinatorController::class, 'choose_typical_idea'])->name('coordinator_choose_typical_idea')->middleware('coordinator:coordinator'); // Choose typical idea submit

Route::get('/coordinator/idea/{id}/deactive-status', [CoordinatorController::class, 'remove_typical_idea'])->name('coordinator_remove_typical_idea')->middleware('coordinator:coordinator'); // Remove typical idea submit

Route::get('/coordinator/list-outstanding-ideas', [CoordinatorController::class, 'list_outstanding_ideas'])->name('coordinator_list_outstanding_ideas')->middleware('coordinator:coordinator'); // List outstanding ideas



/* Student */
Route::get('/student/login', [StudentController::class, 'login_view'])->name('student_login'); // login
Route::post('/student/login-submit', [StudentController::class, 'login_submit'])->name('student_login_submit'); // login submit

Route::get('/student/logout', [StudentController::class, 'logout'])->name('student_logout'); // Logout 

Route::get('/student/home', [StudentController::class, 'home'])->name('student_home')->middleware('student:student'); // Homepage view
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student_dashboard')->middleware('student:student'); // Dashboard view

Route::get('/student/list-faculties', [StudentController::class, 'list_faculties'])->name('student_faculties')->middleware('student:student'); // List faculties view

Route::get('/student/faculty/{id}', [StudentController::class, 'current_faculty'])->name('student_current_faculty')->middleware('student:student'); // Current faculty view
Route::post('/student/faculty/{id}/submit-idea', [StudentController::class, 'submit_idea'])->name('student_submit_idea')->middleware('student:student'); // Submit idea

Route::get('/student/faculty/{id}/edit', [StudentController::class, 'edit_submit_idea_view'])->name('student_edit_submit_idea_view')->middleware('student:student'); // View Edit Submit idea
Route::get('/student/download/{file}', [StudentController::class, 'download_file'])->name('student_download_file')->middleware('student:student'); // Download file
Route::post('/student/idea/{id}/edit-submit', [StudentController::class, 'edit_submit_idea'])->name('student_edit_submit_idea'); // edit submit idea
