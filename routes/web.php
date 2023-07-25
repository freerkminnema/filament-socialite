<?php

use DutchCodingCompany\FilamentSocialite\Http\Controllers\SocialiteLoginController;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::name('filament.')
    ->group(function () {
        foreach (Filament::getPanels() as $panel) {
            Route::domain($panel->getDomain())
                ->middleware($panel->getMiddleware())
                ->name("{$panel->getId()}.socialite.")
                ->group(function () {
                    Route::get('/oauth/{provider}', [
                        SocialiteLoginController::class,
                        'redirectToProvider',
                    ])->name('oauth.redirect');

                    Route::get('/oauth/callback/{provider}', [
                        SocialiteLoginController::class,
                        'processCallback',
                    ])->name('oauth.callback');
                });
        }
    });
