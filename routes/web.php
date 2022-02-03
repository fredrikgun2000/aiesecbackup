<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\External\HomeController AS ExternalHome;

use App\Http\Controllers\Internal\LoginController AS InternalLogin;
use App\Http\Controllers\Internal\HomeController AS InternalHome;

use App\Http\Controllers\Internal\Members\MemberAccountController AS InternalMemberAccount;
use App\Http\Controllers\Internal\Members\AccountRoleController AS InternalAccountRole;

use App\Http\Controllers\Internal\Booklets\BookletController AS InternalBooklet;

use App\Http\Controllers\Internal\Destinations\DestinationController AS InternalDestination;

use App\Http\Controllers\Internal\Projects\ProjectController AS InternalProject;
use App\Http\Controllers\Internal\Projects\ActivityController AS InternalActivity;
use App\Http\Controllers\Internal\Projects\FeeController AS InternalFee;

use App\Http\Controllers\Internal\Infosessions\ProgramController AS InternalInfosessionProgram;
use App\Http\Controllers\Internal\Infosessions\FormController AS InternalInfosessionForm;
use App\Http\Controllers\Internal\Infosessions\SpeakerController AS InternalInfosessionSpeaker;
use App\Http\Controllers\Internal\Infosessions\SertificateController AS InternalInfosessionSertificate;

use App\Http\Controllers\Internal\Profile\ProfileController AS InternalProfile;


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

// =========================================================================
// general

Route::get('/', [ExternalHome::class,'indexHome'])->name('externalindexhome');


// =========================================================================
// private

// login
Route::get('/AIESEC/login', [InternalLogin::class,'indexLogin'])->name('internalindexlogin');

// home
Route::get('/AIESEC', [InternalHome::class,'indexHome'])->name('internalindexhome');
Route::get('/AIESEC/profile', [InternalProfile::class,'indexprofile'])->name('internalindexprofile');
Route::get('/AIESEC/profile/completeprofile', [InternalProfile::class,'indexcompleteprofile'])->name('internalindexcompleteprofile');

// members
Route::get('/AIESEC/members/account-role', [InternalAccountRole::class,'indexaccountrole'])->name('internalindexaccountrole');
Route::get('/AIESEC/members/account-role/department/recovery', [InternalAccountRole::class,'indexrecoverydepartment'])->name('internalindexrecoverydepartment');
Route::get('/AIESEC/members/account-role/role/recovery', [InternalAccountRole::class,'indexrecoveryrole'])->name('internalindexrecoveryrole');

Route::get('/AIESEC/members/member-account', [InternalMemberAccount::class,'indexmemberaccount'])->name('internalindexmemberaccount');
Route::get('/AIESEC/members/member-account/recovery', [InternalMemberAccount::class,'indexrecoverymember'])->name('internalindexrecoverymember');

// destinations
Route::get('/AIESEC/destinations', [InternalDestination::class,'indexdestination'])->name('internalindexdestination');
Route::get('/AIESEC/destinations/recovery', [InternalDestination::class,'indexrecoverydestination'])->name('internalindexrecoverydestination');

// projects
Route::get('/AIESEC/projects', [InternalProject::class,'indexproject'])->name('internalindexproject');
Route::get('/AIESEC/projects/detail/{id}', [InternalProject::class,'indexprojectdetail'])->name('internalindexprojectdetail');
Route::get('/AIESEC/projects/recovery', [InternalProject::class,'indexrecoveryproject'])->name('internalindexrecoveryproject');
Route::get('/AIESEC/projects/activities', [InternalActivity::class,'indexactivity'])->name('internalindexactivity');
Route::get('/AIESEC/projects/activities/recovery', [InternalActivity::class,'indexrecoveryactivity'])->name('internalindexrecoveryactivity');
Route::get('/AIESEC/projects/fees', [InternalFee::class,'indexfee'])->name('internalindexfee');
Route::get('/AIESEC/projects/fees/recovery', [InternalFee::class,'indexrecoveryfee'])->name('internalindexrecoveryfee');

// booklets
Route::get('/AIESEC/booklets', [InternalBooklet::class,'indexbooklet'])->name('internalindexbooklet');
Route::get('/AIESEC/booklets/recovery', [InternalBooklet::class,'indexrecoverybooklet'])->name('internalindexrecoverybooklet');


// infosessions
    // programs
Route::get('/AIESEC/infosessions/programs', [InternalInfosessionProgram::class,'indexprogram'])->name('internalindexinfosessionprogram');
Route::get('/AIESEC/infosessions/programs/detail/{id}', [InternalInfosessionProgram::class,'indexprogramdetail'])->name('internalindexprogramdetail');
Route::get('/AIESEC/infosessions/programs/recovery', [InternalInfosessionProgram::class,'indexrecoveryprogram'])->name('internalindexrecoveryinfosessionprogram');
Route::get('/AIESEC/infosessions/programs/recovery/detail/{id}', [InternalInfosessionProgram::class,'indexrecoverydetailprogram'])->name('internalindexrecoverydetailprogram');

// speakers
Route::get('/AIESEC/infosessions/speakers', [InternalInfosessionSpeaker::class,'indexspeaker'])->name('internalindexinfosessionspeaker');
Route::get('/AIESEC/infosessions/speakers/recovery', [InternalInfosessionSpeaker::class,'indexrecoveryspeaker'])->name('internalindexrecoveryinfosessionspeaker');

// forms
Route::get('/AIESEC/infosessions/forms', [InternalInfosessionForm::class,'indexform'])->name('internalindexinfosessionform');
Route::get('/AIESEC/infosessions/forms/detail/{id}', [InternalInfosessionForm::class,'indexformdetail'])->name('internalindexinfosessionformdetail');
Route::get('/AIESEC/infosessions/forms/recovery', [InternalInfosessionForm::class,'indexrecoveryform'])->name('internalindexrecoveryinfosessionform');