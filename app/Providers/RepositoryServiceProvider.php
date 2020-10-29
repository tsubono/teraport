<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Service\ServiceRepositoryInterface::class,
            \App\Repositories\Service\ServiceRepository::class
        );

        $this->app->bind(
            \App\Repositories\Transaction\TransactionRepositoryInterface::class,
            \App\Repositories\Transaction\TransactionRepository::class
        );

        $this->app->bind(
            \App\Repositories\DirectMessage\DirectMessageRepositoryInterface::class,
            \App\Repositories\DirectMessage\DirectMessageRepository::class
        );

        $this->app->bind(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
