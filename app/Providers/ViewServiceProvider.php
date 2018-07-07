<?php

namespace App\Providers;

use App\Channel;
use App\Group;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $channels = Channel::get();
            foreach($channels as $channel){
                $channel->groups = Group::where('channel_id', '=', $channel->id)->get();
            }
            $languages = Language::get();

            $view->with(['channels'=> $channels, 'languages'=> $languages]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}