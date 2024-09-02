<?php

use App\Http\Controllers\NotifyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PsikController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TopicController;

use App\Models\User;

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('formReset/{token}', [NotifyController::class, 'formReset'])->name('formReset');
Route::post('submitPassword', [NotifyController::class, 'submitPassword'])->name('submitPassword');

Route::get('mailApproved/{idpro}', [NotifyController::class, 'mailApproved'])->name('mailApproved');
Route::get('mailDenied/{idpro}', [NotifyController::class, 'mailDenied'])->name('mailDenied');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/user', App\Http\Controllers\UserController::class);


Route::get('/topic/show/{id}', [TopicController::class, 'show'])->name('topic.show');

//Route untuk user memiliki role 1
Route::group(['middleware' => 'level:1'], function () {
    Route::get('/psik/dashboard', [PsikController::class, 'dashboard'])->name('psik.dashboard');
    Route::get('/psik/indexStudent', [PsikController::class, 'indexStudent'])->name('psik.indexStudent');
    Route::get('/psik/indexEmploye', [PsikController::class, 'indexEmploye'])->name('psik.indexEmploye');
    Route::get('/psik/indexLecture', [PsikController::class, 'indexLecture'])->name('psik.indexLecture');
    Route::get('/psik/createLec', [PsikController::class, 'createLec'])->name('psik.createLec');
    Route::post('/psik/storeLec', [PsikController::class, 'storeLec'])->name('psik.storeLec');
    Route::get('/psik/approved/{id}', [PsikController::class, 'approved'])->name('psik.approved');
    Route::get('/psik/makePassword/{id}', [PsikController::class, 'makePassword'])->name('psik.makePassword');
    Route::post('/psik/sendMail/{id}', [PsikController::class, 'sendMail'])->name('psik.sendMail');

    Route::resource('/psik', App\Http\Controllers\PsikController::class);
});

//route Jurusan
Route::group(['middleware' => 'level:2'], function () {
    Route::get('/departement/dashboard', [DepartementController::class, 'dashboard'])->name('departement.dashboard');
    Route::get('/departement/indextopic', [DepartementController::class, 'indextopic'])->name('departement.indextopic');
    Route::put('/departement/uploadSurat/{id}', [DepartementController::class, 'uploadSurat'])->name('departement.uploadSurat');
});


//router akademik
Route::group(['middleware' => 'level:3'], function () {
    Route::get('/academic', [AcademicController::class, 'index'])->name('academic.index');
    Route::get('/academic/indexSempro', [AcademicController::class, 'indexSempro'])->name('academic.indexSempro');
    Route::get('/academic/indexSemhas', [AcademicController::class, 'indexSemhas'])->name('academic.indexSemhas');
    Route::get('/academic/dashboard', [AcademicController::class, 'dashboard'])->name('academic.dashboard');
    Route::get('/academic/verifProposal/{idpro}', [AcademicController::class, 'verifProposal'])->name('academic.verifProposal');
    Route::get('/academic/tolakProposal/{idpro}', [AcademicController::class, 'tolakProposal'])->name('academic.tolakProposal');
    Route::put('/academic/approveSeminar/{id}', [AcademicController::class, 'approveSeminar'])->name('academic.approveSeminar');
    Route::delete('/academic/rejectSempro/{id}', [AcademicController::class, 'rejectSempro'])->name('academic.rejectSempro');
    Route::delete('/academic/rejectSemhas/{id}', [AcademicController::class, 'rejectSemhas'])->name('academic.rejectSemhas');
});


//router dosen
Route::group(['middleware' => 'level:4'], function () {
    Route::get('/lecture/dashboard', [LectureController::class, 'dashboard'])->name('lecture.dashboard');
    //kaprodi
    Route::get('/lecture/indexKaprodi', [LectureController::class, 'indexKaprodi'])->name('lecture.indexKaprodi');
    Route::get('/lecture/showdosen', [LectureController::class, 'showdosen'])->name('lecture.showdosen');
    Route::get('/lecture/approved/{id}', [LectureController::class, 'approved'])->name('lecture.approved');
    Route::get('/lecture/editDosbing/{id}', [LectureController::class, 'editDosbing'])->name('lecture.editDosbing');
    Route::put('/lecture/updateDosbing/{id}', [LectureController::class, 'updateDosbing'])->name('lecture.updateDosbing');
    Route::put('/lecture/verifySeminar/{id}', [LectureController::class, 'verifySeminar'])->name('lecture.verifySeminar');
    //dosen
    Route::get('/lecture/indexGuidance', [LectureController::class, 'indexGuidance'])->name('lecture.indexGuidance');
    Route::get('/lecture/indexGuideSempro', [LectureController::class, 'indexGuideSempro'])->name('lecture.indexGuideSempro');
    Route::get('/lecture/indexGuideSemhas', [LectureController::class, 'indexGuideSemhas'])->name('lecture.indexGuideSemhas');
    Route::get('/lecture/guidance/{id}', [LectureController::class, 'guidance'])->name('lecture.guidance');
    Route::put('/lecture/aprov1/{id}', [LectureController::class, 'aprov1'])->name('lecture.aprov1');
    Route::put('/lecture/aprov2/{id}', [LectureController::class, 'aprov2'])->name('lecture.aprov2');
    Route::put('/lecture/aprov3/{id}', [LectureController::class, 'aprov3'])->name('lecture.aprov3');
    Route::put('/lecture/aprov4/{id}', [LectureController::class, 'aprov4'])->name('lecture.aprov4');
    Route::put('/lecture/verifSempro/{id}', [LectureController::class, 'verifSempro'])->name('lecture.verifSempro');
    Route::put('/lecture/verifSemhas/{id}', [LectureController::class, 'verifSemhas'])->name('lecture.verifSemhas');
    Route::post('/lecture/aproveLogbook/{id}', [LectureController::class, 'aproveLogbook'])->name('lecture.aproveLogbook');
    Route::delete('/lecture/destroyLogbook/{id}', [LectureController::class, 'destroyLogbook'])->name('lecture.destroyLogbook');
});

//router mhs
Route::group(['middleware' => 'level:5'], function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/index/{id}', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/editprofil/{id}', [StudentController::class, 'editprofil'])->name('student.editprofil');
    Route::put('/student/updateprofil/{id}', [StudentController::class, 'updateprofil'])->name('student.updateprofil');
    Route::get('/student/createtopic', [StudentController::class, 'createtopic'])->name('student.createtopic');
    Route::post('/student/storetopic', [StudentController::class, 'storetopic'])->name('student.storetopic');
    Route::get('/student/show/{id}', [StudentController::class, 'show'])->name('student.show');
    Route::put('/student/addProgres1/{id}', [StudentController::class, 'addProgres1'])->name('student.addProgres1');
    Route::put('/student/addProgres2/{id}', [StudentController::class, 'addProgres2'])->name('student.addProgres2');
    Route::put('/student/addProgres3/{id}', [StudentController::class, 'addProgres3'])->name('student.addProgres3');
    Route::put('/student/addProgres4/{id}', [StudentController::class, 'addProgres4'])->name('student.addProgres4');
    Route::get('/student/createSempro/{id}', [StudentController::class, 'createSempro'])->name('student.createSempro');
    Route::post('/student/storeSempro/{id}', [StudentController::class, 'storeSempro'])->name('student.storeSempro');
    Route::get('/student/createSemhas/{id}', [StudentController::class, 'createSemhas'])->name('student.createSemhas');
    Route::post('/student/storeSemhas/{id}', [StudentController::class, 'storeSemhas'])->name('student.storeSemhas');
    Route::get('/student/createLogbook/{id}', [StudentController::class, 'createLogbook'])->name('student.createLogbook');
    Route::put('/student/storeLogbook/{id}', [StudentController::class, 'storeLogbook'])->name('student.storeLogbook');
});
