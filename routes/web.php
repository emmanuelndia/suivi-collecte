<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonneCollecteController;
use App\Http\Controllers\AdminController;

/* Route::get('/', function () {
    return view('welcome');
});
 */
/* Route::get('/test-middleware', function () {
    return 'Middleware admin fonctionne';
    })->middleware('admin');

    Route::get('/test-resolve', function () {
        dd(app()->make('admin')); // Vérifie ce que Laravel résout pour l'alias 'admin'
        });

        Route::get('/test-admin-class', function () {
            return app()->make(\App\Http\Middleware\AdminMiddleware::class)->handle(request(), fn($request) => response('OK'));
            });

            Route::get('/test-kernel', function () {
                $kernel = app(\Illuminate\Foundation\Http\Kernel::class);
                dd($kernel->getRouteMiddleware());
                });
*/




// Gestion de l'authentification
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');

// Après authentification
Route::middleware('auth')->group(function () {

    // Index pour utilisateur normal
    Route::get('index', [UserController::class, 'index'])->name('user.index');

    // Affichage du formulaire d'enregistrement du collecté
    Route::prefix('user')->group(function () {
        Route::get('/mes-collectes', [UserController::class, 'mescollectes'])->name('user.mes-collectes');
        Route::post('/store', [PersonneCollecteController::class, 'storeFromForm'])->name('collecte.store');
        Route::put('/update/{id}', [PersonneCollecteController::class, 'update'])->name('collecte.update');
        Route::delete('/{id}', [PersonneCollecteController::class, 'destroy'])->name('collecte.destroy');
    });
    Route::get('/mes-collectes/search', [UserController::class, 'search'])->name('user.collectes.search');


    // Route de déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tous-les-collectes', [AdminController::class, 'allCollected'])->name('admin.allcollected');
    Route::get('/admin/collectes/search', [AdminController::class, 'search'])->name('admin.collectes.search');

    Route::get('/admin/utilisateurs', [AdminController::class, 'usersList'])->name('admin.tous-les-utilisateurs');
    Route::post('/admin/utilisateurs/store', [AdminController::class, 'storeUser'])->name('utilisateurs.store');
    Route::put('/admin/utilisateurs/update/{id}', [AdminController::class, 'updateUser'])->name('utilisateurs.update');
    Route::delete('/admin/utilisateurs/destroy/{id}', [AdminController::class, 'destroyUser'])->name('utilisateurs.destroy');
    Route::get('/admin/utilisateurs/search', [AdminController::class, 'searchUsers'])->name('admin.users.search');

/*     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
 */

});

