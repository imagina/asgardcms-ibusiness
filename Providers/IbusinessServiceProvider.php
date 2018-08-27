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
            $event->load('userbusinesses', array_dot(trans('ibusiness::userbusinesses')));
            $event->load('orderapprovers', array_dot(trans('ibusiness::orderapprovers')));
            $event->load('businessproducts', array_dot(trans('ibusiness::businessproducts')));
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
            'Modules\Ibusiness\Repositories\userbusinessRepository',
            function () {
                $repository = new \Modules\Ibusiness\Repositories\Eloquent\EloquentuserbusinessRepository(new \Modules\Ibusiness\Entities\userbusiness());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibusiness\Repositories\Cache\CacheuserbusinessDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibusiness\Repositories\orderApproversRepository',
            function () {
                $repository = new \Modules\Ibusiness\Repositories\Eloquent\EloquentorderApproversRepository(new \Modules\Ibusiness\Entities\orderApprovers());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibusiness\Repositories\Cache\CacheorderApproversDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Ibusiness\Repositories\businessproductRepository',
            function () {
                $repository = new \Modules\Ibusiness\Repositories\Eloquent\EloquentbusinessproductRepository(new \Modules\Ibusiness\Entities\businessproduct());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ibusiness\Repositories\Cache\CachebusinessproductDecorator($repository);
            }
        );
// add bindings







    }
}
