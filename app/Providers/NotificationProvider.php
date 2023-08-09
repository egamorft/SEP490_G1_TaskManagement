<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('panels.navbar', function ($view) {
            $unseen_notify = Notification::where('follower', Auth::id())->where('seen', 0)->orderBy('id', 'desc')->get();
            $notify = Notification::where('follower', Auth::id())->orderBy('id', 'desc')->take(5)->get();
            if($notify){
                $view->with('notify', $notify);
                $view->with('notiCount', count($unseen_notify));
            }else{
                $view->with('notiCount', 0);
                $view->with('notify', []);
            }
        });
    }
}
