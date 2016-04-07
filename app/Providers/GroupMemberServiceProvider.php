<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Hocs\GroupMembers\GroupMemberRepository;
use App\Hocs\GroupMembers\DbGroupMemberRepository;

class GroupMemberServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GroupMemberRepository::class, function($app) {
        	return new DbGroupMemberRepository;
        });
    }
}
