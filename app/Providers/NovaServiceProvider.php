<?php

namespace App\Providers;

use App\Nova\Breed;
use App\Nova\Form;
use App\Nova\Pet;
use App\Nova\Province;
use App\Nova\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(function ($request) {
            return [
                // MenuSection::make('Dashboard')->path('/dashboards/main')->icon('chart-bar'),
                MenuSection::make('Publicaciones', [
                    MenuItem::resource(Pet::class)->name('Mascotas'),
                    MenuItem::resource(Breed::class)->name('Razas'),
                    MenuItem::resource(Form::class)->name('Formulario'),
                ]),

                MenuSection::make('Configuración', [
                    MenuItem::resource(Province::class)->name('Provincias'),
                    MenuItem::resource(User::class)->name('Usuarios'),
                ])
            ];
        });

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
