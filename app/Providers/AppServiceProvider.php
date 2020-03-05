<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\RepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class,
            \App\Repositories\User\SubjectEloquentRepository::class,
            \App\Repositories\User\FacultyEloquentRepository::class,
            \App\Repositories\Role\RoleEloquentRepository::class,
            \App\Repositories\Point\PointEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
    }
}
