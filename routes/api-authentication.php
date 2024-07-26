<?php

use App\Http\Controllers\ApiAuthentication\EmailVerificationNotificationController;
use App\Http\Controllers\ApiAuthentication\LoginController;
use App\Http\Controllers\ApiAuthentication\LogoutController;
use App\Http\Controllers\ApiAuthentication\NewPasswordController;
use App\Http\Controllers\ApiAuthentication\PasswordResetLinkController;
use App\Http\Controllers\ApiAuthentication\RegisterController;
use App\Http\Controllers\ApiAuthentication\VerifyEmailController;
use App\Http\Controllers\ApiAuthentication\RefreshController;
use App\Http\Controllers\ApiAuthentication\SetPasswordController;
use App\Http\Controllers\ApiAuthentication\UserController;
use App\Http\Controllers\ApiAuthentication\UsersController;
use App\Http\Controllers\ApiAuthentication\UpdateUserController;
use App\Http\Controllers\ApiAuthentication\ChangePasswordController;
use App\Http\Controllers\ApiAuthentication\ListTokensController;
use App\Http\Controllers\ApiAuthentication\RevokeOrganizationTokensController;
use App\Http\Controllers\ApiAuthentication\DeleteOrganizationTokensController;
use App\Http\Controllers\ApiAuthentication\RevokeTokenController;
use App\Http\Controllers\ApiAuthentication\DeleteTokenController;
use App\Http\Controllers\ApiAuthentication\UpdateAccountStatusController;
use App\Http\Controllers\ApiAuthentication\ScopesController;
use App\Http\Controllers\ApiAuthentication\RoleController;
use App\Http\Controllers\ApiAuthentication\RevokeUserController;
use App\Http\Controllers\ApiAuthentication\DeleteUserController;
use App\Http\Controllers\ApiAuthentication\SetSettingController;
use App\Http\Controllers\ApiAuthentication\GetSettingController;
use App\Http\Controllers\ApiAuthentication\ListSettingController;
use App\Http\Controllers\ApiAuthentication\ListNotificationsController;
use App\Http\Controllers\ApiAuthentication\UpdateNotificationsController;
use App\Http\Controllers\ApiAuthentication\ListAuditoriasController;
use App\Http\Controllers\ApiAuthentication\ListAccessLogsController;

use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('api-authentication.register');

Route::post('/login', LoginController::class)->name('api-authentication.login');

Route::post('/forgot-password', PasswordResetLinkController::class)
    ->name('api-authentication.password.email');

Route::post('/set-password', SetPasswordController::class)
    ->name('api-authentication.password.set.password');

Route::post('/reset-password', NewPasswordController::class)
    ->name('api-authentication.password.update');

Route::put('/change-password', ChangePasswordController::class)
    ->middleware(['auth:api', 'throttle:6,1', 'scopes:basic-user'])
    ->name('api-authentication.change.password');

Route::get('/logout', LogoutController::class)
    ->middleware('auth:api')
    ->name('api-authentication.logout');

Route::post('/verification-notification', EmailVerificationNotificationController::class)
    ->middleware(['auth:api', 'throttle:6,1'])
    ->name('api-authentication.verification.send');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('api-authentication.verification.verify');

Route::post('/refresh',RefreshController::class)
    ->name('api-authentication.refresh');

Route::post('/update-account-status', UpdateAccountStatusController::class)
    ->middleware(['auth:api', 'scopes:basic-user,common-admin'])
    ->name('api-authentication.update.account.status');

Route::post('/get-scopes', ScopesController::class)
    ->middleware(['auth:api', 'scopes:basic-user,common-admin'])
    ->name('api-authentication.get.scopes.list');

Route::post('/get-role', RoleController::class)
    ->middleware(['auth:api', 'scopes:basic-user,common-admin'])
    ->name('api-authentication.get.user.role');

Route::post('/user', UserController::class)
    ->middleware(['auth:api', 'scopes:basic-user'])
    ->name('api-authentication.current.user.profile');

Route::post('/users', UsersController::class)
    ->middleware(['auth:api', 'scopes:basic-user,common-admin'])
    ->name('api-authentication.list.users');

Route::post('/revoke-user', RevokeUserController::class)
    ->middleware(['auth:api', 'scopes:basic-user,common-admin'])
    ->name('api-authentication.revoke.user');

Route::post('/delete-user', DeleteUserController::class)
    ->middleware(['auth:api', 'scopes:basic-user,common-admin'])
    ->name('api-authentication.delete.user');

Route::put('/user', UpdateUserController::class)
    ->middleware(['auth:api', 'scopes:basic-user'])
    ->name('api-authentication.current.user.update');

Route::get('/tokens', ListTokensController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.list.tokens');

Route::post('/revoke-organization-tokens', RevokeOrganizationTokensController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.revoke.organization.tokens');

Route::post('/delete-organization-tokens', DeleteOrganizationTokensController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.delete.organization.tokens');

Route::post('/revoke-token', RevokeTokenController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.revoke.tokens');

Route::post('/delete-token', DeleteTokenController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.delete.tokens');

Route::post('/get-setting', GetSettingController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.get.setting.value');

Route::put('/set-setting', SetSettingController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.set.setting.value');

Route::get('/list-setting', ListSettingController::class)
    ->middleware(['auth:api', 'scopes:basic-user,system-admin'])
    ->name('api-authentication.list.setting.value');

Route::post('/list-notifications', ListNotificationsController::class)
    ->middleware(['auth:api', 'scopes:basic-user'])
    ->name('api-authentication.list.notifications');

Route::post('/update-notifications', UpdateNotificationsController::class)
    ->middleware(['auth:api', 'scopes:basic-user'])
    ->name('api-authentication.update.notifications');

Route::get('/list-audits', ListAuditoriasController::class)
    ->middleware(['auth:api', 'scopes:basic-user'])
    ->name('api-authentication.list.audits.value');

Route::get('/list-access', ListAccessLogsController::class)
    ->middleware(['auth:api', 'scopes:basic-user'])
    ->name('api-authentication.list.access.value');