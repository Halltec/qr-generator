<?php

use App\Http\Controllers\QrcodeController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::get('qrcode', [QrcodeController::class, 'index'])->name('qrcode.index');
    Route::get('qrcode/create', [QrcodeController::class, 'create'])->name('qrcode.create');
    Route::post('qrcode', [QrcodeController::class, 'store'])->name('qrcode.store');
    Route::get('qrcode/{qrcode}/edit', [QrcodeController::class, 'edit'])->name('qrcode.edit');
    Route::get('qrcode/{qrcode}', [QrcodeController::class, 'show'])->name('qrcode.show');
    Route::patch('qrcode/{qrcode}', [QrcodeController::class, 'update'])->name('qrcode.update');
    Route::delete('qrcode/{qrcode}', [QrcodeController::class, 'destroy'])->name('qrcode.destroy');
    Route::get('qrcode/{qrcode}/download', [QrcodeController::class, 'download'])->name('qrcode.download');

});
