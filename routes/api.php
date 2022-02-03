<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Internal\LoginController AS InternalLogin;

use App\Http\Controllers\Internal\Members\AccountRoleController AS InternalAccountRole;
use App\Http\Controllers\Internal\Members\MemberAccountController AS InternalMemberAccount;

use App\Http\Controllers\Internal\Booklets\BookletController AS InternalBooklet;

use App\Http\Controllers\Internal\Destinations\DestinationController AS InternalDestination;

use App\Http\Controllers\Internal\Projects\ProjectController AS InternalProject;
use App\Http\Controllers\Internal\Projects\ActivityController AS InternalActivity;
use App\Http\Controllers\Internal\Projects\FeeController AS InternalFee;


use App\Http\Controllers\Internal\Infosessions\ProgramController AS InternalInfosessionProgram;
use App\Http\Controllers\Internal\Infosessions\FormController AS InternalInfosessionForm;
use App\Http\Controllers\Internal\Infosessions\QuestionController AS InternalInfosessionQuestion;
use App\Http\Controllers\Internal\Infosessions\SpeakerController AS InternalInfosessionSpeaker;
use App\Http\Controllers\Internal\Infosessions\SertificateController AS InternalInfosessionSertificate;

use App\Http\Controllers\Internal\Profile\ProfileController AS InternalProfile;

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

// login
Route::post('/AIESEC/login/validasi', [InternalLogin::class,'validasiLogin'])->name('internalvalidasilogin');

// members
    // role & department
Route::post('/AIESEC/members/account-role/department/create', [InternalAccountRole::class,'createdepartment'])->name('internalcreatedepartment');
Route::get('/AIESEC/members/account-role/department/read', [InternalAccountRole::class,'readdepartment'])->name('internalreaddepartment');
Route::delete('/AIESEC/members/account-role/department/delete', [InternalAccountRole::class,'deletedepartment'])->name('internaldeletedepartment');
Route::get('/AIESEC/members/account-role/department/edit', [InternalAccountRole::class,'editdepartment'])->name('internaleditdepartment');
Route::post('/AIESEC/members/account-role/department/update', [InternalAccountRole::class,'updatedepartment'])->name('internalupdatedepartment');
Route::get('/AIESEC/members/account-role/department/recovery/read', [InternalAccountRole::class,'readrecoverydepartment'])->name('internalreadrecoverydepartment');
Route::delete('/AIESEC/members/account-role/department/recovery/delete', [InternalAccountRole::class,'deleterecoverydepartment'])->name('internaldeleterecoverydepartment');
Route::get('/AIESEC/members/account-role/department/recovery/restore', [InternalAccountRole::class,'restorerecoverydepartment'])->name('internalrestorerecoverydepartment');

Route::post('/AIESEC/members/account-role/role/create', [InternalAccountRole::class,'createrole'])->name('internalcreaterole');
Route::get('/AIESEC/members/account-role/role/read', [InternalAccountRole::class,'readrole'])->name('internalreadrole');
Route::delete('/AIESEC/members/account-role/role/delete', [InternalAccountRole::class,'deleterole'])->name('internaldeleterole');
Route::get('/AIESEC/members/account-role/role/edit', [InternalAccountRole::class,'editrole'])->name('internaleditrole');
Route::post('/AIESEC/members/account-role/role/update', [InternalAccountRole::class,'updaterole'])->name('internalupdaterole');
Route::get('/AIESEC/members/account-role/role/recovery/read', [InternalAccountRole::class,'readrecoveryrole'])->name('internalreadrecoveryrole');
Route::delete('/AIESEC/members/account-role/role/recovery/delete', [InternalAccountRole::class,'deleterecoveryrole'])->name('internaldeleterecoveryrole');
Route::get('/AIESEC/members/account-role/role/recovery/restore', [InternalAccountRole::class,'restorerecoveryrole'])->name('internalrestorerecoveryrole');

    // member account
Route::post('/AIESEC/members/member-account/create', [InternalMemberAccount::class,'createmember'])->name('internalcreatemember');
Route::get('/AIESEC/members/member-account/read', [InternalMemberAccount::class,'readmember'])->name('internalreadmember');
Route::delete('/AIESEC/members/member-account/delete', [InternalMemberAccount::class,'deletemember'])->name('internaldeletemember');
Route::get('/AIESEC/members/member-account/edit', [InternalMemberAccount::class,'editmember'])->name('internaleditmember');
Route::post('/AIESEC/members/member-account/update', [InternalMemberAccount::class,'updatemember'])->name('internalupdatemember');
Route::get('/AIESEC/members/member-account/publish', [InternalMemberAccount::class,'publishmember'])->name('internalpublishmember');
Route::get('/AIESEC/members/member-account/recovery/read', [InternalMemberAccount::class,'readrecoverymember'])->name('internalreadrecoverymember');
Route::delete('/AIESEC/members/member-account/recovery/delete', [InternalMemberAccount::class,'deleterecoverymember'])->name('internaldeleterecoverymember');
Route::get('/AIESEC/members/member-account/recovery/restore', [InternalMemberAccount::class,'restorerecoverymember'])->name('internalrestorerecoverymember');
Route::get('/AIESEC/members/member-account/generatepassword/send', [InternalMemberAccount::class,'generatepassword'])->name('internalgeneratepassword');

// Profile
    // profile
Route::get('/AIESEC/members/profile/read', [InternalProfile::class,'readmemberprofile'])->name('Internalreadprofile');
Route::post('/AIESEC/members/profile/update', [InternalProfile::class,'updateprofile'])->name('internalupdateprofile');
Route::post('/AIESEC/members/passwordprofile/update', [InternalProfile::class,'updatepasswordprofile'])->name('internalupdatepasswordprofile');
Route::post('/AIESEC/members/photoprofile/update', [InternalProfile::class,'updatephotoprofile'])->name('internalupdatephotoprofile');

// Destinations
Route::post('/AIESEC/destinations/create', [InternalDestination::class,'createdestination'])->name('internalcreatedestination');
Route::get('/AIESEC/destinations/read', [InternalDestination::class,'readdestination'])->name('internalreaddestination');
Route::delete('/AIESEC/destinations/delete', [InternalDestination::class,'deletedestination'])->name('internaldeletedestination');
Route::get('/AIESEC/destinations/edit', [InternalDestination::class,'editdestination'])->name('internaleditdestination');
Route::post('/AIESEC/destinations/update', [InternalDestination::class,'updatedestination'])->name('internalupdatedestination');
Route::get('/AIESEC/destinations/publish', [InternalDestination::class,'publishdestination'])->name('internalpublishdestination');
Route::get('/AIESEC/destinations/recovery/read', [InternalDestination::class,'readrecoverydestination'])->name('internalreadrecoverydestination');
Route::delete('/AIESEC/destinations/recovery/delete', [InternalDestination::class,'deleterecoverydestination'])->name('internaldeleterecoverydestination');
Route::get('/AIESEC/destinations/recovery/restore', [InternalDestination::class,'restorerecoverydestination'])->name('internalrestorerecoverydestination');

// Projects
Route::post('/AIESEC/projects/create', [InternalProject::class,'createproject'])->name('internalcreateproject');
Route::get('/AIESEC/projects/read', [InternalProject::class,'readproject'])->name('internalreadproject');
Route::get('/AIESEC/projects/search', [InternalProject::class,'searchproject'])->name('internalsearchproject');
Route::delete('/AIESEC/projects/delete', [InternalProject::class,'deleteproject'])->name('internaldeleteproject');
Route::get('/AIESEC/projects/edit', [InternalProject::class,'editproject'])->name('internaleditproject');
Route::post('/AIESEC/projects/update', [InternalProject::class,'updateproject'])->name('internalupdateproject');
Route::get('/AIESEC/projects/publish', [InternalProject::class,'publishproject'])->name('internalpublishproject');
Route::get('/AIESEC/projects/recovery/read', [InternalProject::class,'readrecoveryproject'])->name('internalreadrecoveryproject');
Route::delete('/AIESEC/projects/recovery/delete', [InternalProject::class,'deleterecoveryproject'])->name('internaldeleterecoveryproject');
Route::get('/AIESEC/projects/recovery/restore', [InternalProject::class,'restorerecoveryproject'])->name('internalrestorerecoveryproject');
Route::post('/AIESEC/projects/activities/create', [InternalActivity::class,'createactivity'])->name('internalcreateactivity');
Route::get('/AIESEC/projects/activities/read', [InternalActivity::class,'readactivity'])->name('internalreadactivity');
Route::delete('/AIESEC/projects/activities/delete', [InternalActivity::class,'deleteactivity'])->name('internaldeleteactivity');
Route::get('/AIESEC/projects/activities/edit', [InternalActivity::class,'editactivity'])->name('internaleditactivity');
Route::post('/AIESEC/projects/activities/update', [InternalActivity::class,'updateactivity'])->name('internalupdateactivity');
Route::get('/AIESEC/projects/activities/recovery/read', [InternalActivity::class,'readrecoveryactivity'])->name('internalreadrecoveryactivity');
Route::delete('/AIESEC/projects/activities/recovery/delete', [InternalActivity::class,'deleterecoveryactivity'])->name('internaldeleterecoveryactivity');
Route::get('/AIESEC/projects/activities/recovery/restore', [InternalActivity::class,'restorerecoveryactivity'])->name('internalrestorerecoveryactivity');
Route::post('/AIESEC/projects/fees/create', [InternalFee::class,'createfee'])->name('internalcreatefee');
Route::get('/AIESEC/projects/fees/read', [InternalFee::class,'readfee'])->name('internalreadfee');
Route::delete('/AIESEC/projects/fees/delete', [InternalFee::class,'deletefee'])->name('internaldeletefee');
Route::get('/AIESEC/projects/fees/edit', [InternalFee::class,'editfee'])->name('internaleditfee');
Route::post('/AIESEC/projects/fees/update', [InternalFee::class,'updatefee'])->name('internalupdatefee');
Route::get('/AIESEC/projects/fees/recovery/read', [InternalFee::class,'readrecoveryfee'])->name('internalreadrecoveryfee');
Route::delete('/AIESEC/projects/fees/recovery/delete', [InternalFee::class,'deleterecoveryfee'])->name('internaldeleterecoveryfee');
Route::get('/AIESEC/projects/fees/recovery/restore', [InternalFee::class,'restorerecoveryfee'])->name('internalrestorerecoveryfee');

// Booklets
Route::post('/AIESEC/booklets/create', [InternalBooklet::class,'createbooklet'])->name('internalcreatebooklet');
Route::get('/AIESEC/booklets/read', [InternalBooklet::class,'readbooklet'])->name('internalreadbooklet');
Route::delete('/AIESEC/booklets/delete', [InternalBooklet::class,'deletebooklet'])->name('internaldeletebooklet');
Route::get('/AIESEC/booklets/edit', [InternalBooklet::class,'editbooklet'])->name('internaleditbooklet');
Route::post('/AIESEC/booklets/update', [InternalBooklet::class,'updatebooklet'])->name('internalupdatebooklet');
Route::get('/AIESEC/booklets/publish', [InternalBooklet::class,'publishbooklet'])->name('internalpublishbooklet');
Route::get('/AIESEC/booklets/recovery/read', [InternalBooklet::class,'readrecoverybooklet'])->name('internalreadrecoverybooklet');
Route::delete('/AIESEC/booklets/recovery/delete', [InternalBooklet::class,'deleterecoverybooklet'])->name('internaldeleterecoverybooklet');
Route::get('/AIESEC/booklets/recovery/restore', [InternalBooklet::class,'restorerecoverybooklet'])->name('internalrestorerecoverybooklet');

// Forms
    // Infosession
Route::post('/AIESEC/infosessions/programs/create', [InternalInfosessionProgram::class,'createprogram'])->name('internalcreateprogram');
Route::get('/AIESEC/infosessions/programs/read', [InternalInfosessionProgram::class,'readprogram'])->name('internalreadprogram');
Route::delete('/AIESEC/infosessions/programs/delete', [InternalInfosessionProgram::class,'deleteprogram'])->name('internaldeleteprogram');
Route::post('/AIESEC/infosessions/programs/update', [InternalInfosessionProgram::class,'updateprogram'])->name('internalupdateprogram');
Route::get('/AIESEC/infosessions/programs/publish', [InternalInfosessionProgram::class,'publishprogram'])->name('internalpublishprogram');
Route::get('/AIESEC/infosessions/programs/recovery/read', [InternalInfosessionProgram::class,'readrecoveryprogram'])->name('internalreadrecoveryprogram');
Route::delete('/AIESEC/infosessions/programs/recovery/delete', [InternalInfosessionProgram::class,'deleterecoveryprogram'])->name('internaldeleterecoveryprogram');
Route::get('/AIESEC/infosessions/programs/recovery/restore', [InternalInfosessionProgram::class,'restorerecoveryprogram'])->name('internalrestorerecoveryprogram');

    // Speakers
Route::post('/AIESEC/infosessions/speakers/create', [InternalInfosessionSpeaker::class,'createspeaker'])->name('internalcreatespeaker');
Route::get('/AIESEC/infosessions/speakers/read', [InternalInfosessionSpeaker::class,'readspeaker'])->name('internalreadspeaker');
Route::delete('/AIESEC/infosessions/speakers/delete', [InternalInfosessionSpeaker::class,'deletespeaker'])->name('internaldeletespeaker');
Route::get('/AIESEC/infosessions/speakers/edit', [InternalInfosessionSpeaker::class,'editspeaker'])->name('internaleditspeaker');
Route::post('/AIESEC/infosessions/speakers/update', [InternalInfosessionSpeaker::class,'updatespeaker'])->name('internalupdatespeaker');
Route::get('/AIESEC/infosessions/speakers/publish', [InternalInfosessionSpeaker::class,'publishspeaker'])->name('internalpublishspeaker');
Route::get('/AIESEC/infosessions/speakers/recovery/read', [InternalInfosessionSpeaker::class,'readrecoveryspeaker'])->name('internalreadrecoveryspeaker');
Route::delete('/AIESEC/infosessions/speakers/recovery/delete', [InternalInfosessionSpeaker::class,'deleterecoveryspeaker'])->name('internaldeleterecoveryspeaker');
Route::get('/AIESEC/infosessions/speakers/recovery/restore', [InternalInfosessionSpeaker::class,'restorerecoveryspeaker'])->name('internalrestorerecoveryspeaker');

// Forms
Route::post('/AIESEC/infosessions/forms/create', [InternalInfosessionForm::class,'createform'])->name('internalcreateform');
Route::get('/AIESEC/infosessions/forms/read', [InternalInfosessionForm::class,'readform'])->name('internalreadform');
Route::delete('/AIESEC/infosessions/forms/delete', [InternalInfosessionForm::class,'deleteform'])->name('internaldeleteform');
Route::post('/AIESEC/infosessions/forms/update', [InternalInfosessionForm::class,'updateform'])->name('internalupdateform');
Route::get('/AIESEC/infosessions/forms/publish', [InternalInfosessionForm::class,'publishform'])->name('internalpublishform');
Route::get('/AIESEC/infosessions/forms/recovery/read', [InternalInfosessionForm::class,'readrecoveryform'])->name('internalreadrecoveryform');
Route::delete('/AIESEC/infosessions/forms/recovery/delete', [InternalInfosessionForm::class,'deleterecoveryform'])->name('internaldeleterecoveryform');
Route::get('/AIESEC/infosessions/forms/recovery/restore', [InternalInfosessionForm::class,'restorerecoveryform'])->name('internalrestorerecoveryform');

// Questions
Route::get('/AIESEC/infosessions/questions/read', [InternalInfosessionQuestion::class,'readquestion'])->name('internalreadquestion');
Route::post('/AIESEC/infosessions/questions/create', [InternalInfosessionQuestion::class,'createquestion'])->name('internalcreatequestion');
Route::post('/AIESEC/infosessions/questions/update', [InternalInfosessionQuestion::class,'updatequestion'])->name('internalupdatequestion');