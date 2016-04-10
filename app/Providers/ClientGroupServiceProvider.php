<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Hocs\ClientGroups\ClientGroup;
use App\Hocs\ClientGroups\ClientGroupRepository;
use App\Hocs\ClientGroups\DbClientGroupRepository;
use App\Transformers\ClientGroupTransformer;

class ClientGroupServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ClientGroupRepository::class, function($app) {
        	return new DbClientGroupRepository(new ClientGroup, new ClientGroupTransformer);
        });
    }
}
