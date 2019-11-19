<?php

namespace App\Providers;

use App\Observers\ProjectObserver;
use App\Project;
use App\Task;
use App\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Project::observe(ProjectObserver::class);
        // Task::observe(TaskObserver::class);
        Schema::defaultStringLength(191); //NEW: Increase StringLength
    }
}
