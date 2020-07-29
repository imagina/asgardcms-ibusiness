<?php

namespace Modules\Ibusiness\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Ibusiness\Events\Handlers\RegisterIbusinessSidebar;

class IbusinessServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIbusinessSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('businesses', array_dot(trans('ibusiness::businesses')));
            $event->load('types', array_dot(trans('ibusiness::types')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('ibusiness', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {


        $this->app->bind(
            'Modules\Ibusiness\Repositories\BusinessRepository',
            function () {
                $repository = new \Modules\Ibusiness\Repositories\Eloquent\EloquentBusinessRepository(new \Modules\Ibusiness\Entities\Business());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibusiness\Repositories\Cache\CacheBusinessDecorator($repository);
            }
        );

        $this->app->bind(
            'Modules\Ibusiness\Repositories\TypeRepository',
            function () {
                $repository = new \Modules\Ibusiness\Repositories\Eloquent\EloquentTypeRepository(new \Modules\Ibusiness\Entities\Type());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibusiness\Repositories\Cache\CacheTypeDecorator($repository);
            }
        );
// add bindings











    }
}
