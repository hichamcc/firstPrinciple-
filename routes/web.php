<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ResentInvitationController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserAvatarController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('avatars/{user}', [UserAvatarController::class, 'show'])->name('avatars.show');

Route::get('invitations/{invitation:code}', [InvitationController::class, 'show'])->name('teams.invitations.show');

Route::middleware(['auth'])->prefix('app')->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy')->middleware('throttle:password-settings');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update')->middleware('throttle:password-settings');
    Route::get('settings/two-factor', [Settings\TwoFactorAuthenticationController::class, 'edit'])->name('settings.two-factor.edit')->middleware('password.confirm');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
    Route::put('settings/team', [Settings\TeamController::class, 'update'])->name('settings.team.update');

    Route::get('invitations/{invitation:code}', [MembershipController::class, 'create'])->name('teams.memberships.create');
    Route::post('invitations/{invitation:code}', [MembershipController::class, 'store'])->name('teams.memberships.store');

    Route::middleware(['verified'])->group(function () {
        Route::get('/', AppController::class)->name('app');

        Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');
        Route::post('teams', [TeamController::class, 'store'])->name('teams.store');
        Route::get('teams/{team}', [TeamController::class, 'show'])->name('teams.show')->can('view', 'team');
        Route::get('teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit')->can('view', 'team');
        Route::put('teams/{team}', [TeamController::class, 'update'])->name('teams.update')->can('update', 'team');

        Route::get('teams/{team}/invitations', [InvitationController::class, 'index'])->name('teams.invitations.index')->can('update', 'team');
        Route::post('teams/{team}/invitations', [InvitationController::class, 'store'])->name('teams.invitations.store')->can('update', 'team');

        Route::get('teams/{team}/users/{user}', [MembershipController::class, 'edit'])->name('teams.memberships.edit')->can('update', 'team');
        Route::put('teams/{team}/users/{user}', [MembershipController::class, 'update'])->name('teams.memberships.update')->can('update', 'team');
        Route::delete('teams/{team}/users/{user}', [MembershipController::class, 'destroy'])->name('teams.memberships.destroy')->can('update', 'team');

        Route::post('invitations/{invitation}/resend', ResentInvitationController::class)->name('invitations.resend')->can('update', 'invitation');
        Route::delete('invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy')->can('delete', 'invitation');

        Route::middleware('can:admin')->group(function () {
            Route::redirect('admin', 'admin/users');
            Route::get('admin/users', [Admin\UserController::class, 'index'])->name('admin.users.index');
            Route::get('admin/users/{user}/edit', [Admin\UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('admin/users/{user}', [Admin\UserController::class, 'update'])->name('admin.users.update');
            Route::delete('admin/users/{user}', [Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

            Route::get('admin/teams', [Admin\TeamController::class, 'index'])->name('admin.teams.index');
            Route::delete('admin/teams/{team}', [Admin\TeamController::class, 'destroy'])->name('admin.teams.destroy');

            Route::post('impersonation', [Admin\ImpersonationController::class, 'store'])->name('admin.impersonation.store');

            // CMS routes
            Route::get('admin/settings', [Admin\SiteSettingController::class, 'edit'])->name('admin.settings.edit');
            Route::put('admin/settings', [Admin\SiteSettingController::class, 'update'])->name('admin.settings.update');

            Route::get('admin/services', [Admin\ServiceController::class, 'index'])->name('admin.services.index');
            Route::get('admin/services/create', [Admin\ServiceController::class, 'create'])->name('admin.services.create');
            Route::post('admin/services', [Admin\ServiceController::class, 'store'])->name('admin.services.store');
            Route::get('admin/services/{service}/edit', [Admin\ServiceController::class, 'edit'])->name('admin.services.edit');
            Route::put('admin/services/{service}', [Admin\ServiceController::class, 'update'])->name('admin.services.update');
            Route::delete('admin/services/{service}', [Admin\ServiceController::class, 'destroy'])->name('admin.services.destroy');
            Route::patch('admin/services/{service}/reorder', [Admin\ServiceController::class, 'reorder'])->name('admin.services.reorder');

            Route::get('admin/projects', [Admin\ProjectController::class, 'index'])->name('admin.projects.index');
            Route::get('admin/projects/create', [Admin\ProjectController::class, 'create'])->name('admin.projects.create');
            Route::post('admin/projects', [Admin\ProjectController::class, 'store'])->name('admin.projects.store');
            Route::get('admin/projects/{project}/edit', [Admin\ProjectController::class, 'edit'])->name('admin.projects.edit');
            Route::put('admin/projects/{project}', [Admin\ProjectController::class, 'update'])->name('admin.projects.update');
            Route::delete('admin/projects/{project}', [Admin\ProjectController::class, 'destroy'])->name('admin.projects.destroy');
            Route::patch('admin/projects/{project}/reorder', [Admin\ProjectController::class, 'reorder'])->name('admin.projects.reorder');

            Route::get('admin/team', [Admin\TeamMemberController::class, 'index'])->name('admin.team.index');
            Route::get('admin/team/create', [Admin\TeamMemberController::class, 'create'])->name('admin.team.create');
            Route::post('admin/team', [Admin\TeamMemberController::class, 'store'])->name('admin.team.store');
            Route::get('admin/team/{team}/edit', [Admin\TeamMemberController::class, 'edit'])->name('admin.team.edit');
            Route::put('admin/team/{team}', [Admin\TeamMemberController::class, 'update'])->name('admin.team.update');
            Route::delete('admin/team/{team}', [Admin\TeamMemberController::class, 'destroy'])->name('admin.team.destroy');
            Route::patch('admin/team/{team}/reorder', [Admin\TeamMemberController::class, 'reorder'])->name('admin.team.reorder');

            Route::get('admin/why', [Admin\WhyCardController::class, 'index'])->name('admin.why.index');
            Route::get('admin/why/create', [Admin\WhyCardController::class, 'create'])->name('admin.why.create');
            Route::post('admin/why', [Admin\WhyCardController::class, 'store'])->name('admin.why.store');
            Route::get('admin/why/{why}/edit', [Admin\WhyCardController::class, 'edit'])->name('admin.why.edit');
            Route::put('admin/why/{why}', [Admin\WhyCardController::class, 'update'])->name('admin.why.update');
            Route::delete('admin/why/{why}', [Admin\WhyCardController::class, 'destroy'])->name('admin.why.destroy');
            Route::patch('admin/why/{why}/reorder', [Admin\WhyCardController::class, 'reorder'])->name('admin.why.reorder');

            Route::get('admin/contact', [Admin\ContactSubmissionController::class, 'index'])->name('admin.contact.index');
            Route::get('admin/contact/{contact}', [Admin\ContactSubmissionController::class, 'show'])->name('admin.contact.show');
            Route::delete('admin/contact/{contact}', [Admin\ContactSubmissionController::class, 'destroy'])->name('admin.contact.destroy');
        });

        Route::delete('impersonation', [Admin\ImpersonationController::class, 'destroy'])->name('impersonation.destroy');
    });
});
