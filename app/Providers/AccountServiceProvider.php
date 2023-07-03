<?php

namespace App\Providers;

use App\Models\Account;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
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
        View::composer('content._partials._modals.modal-add-new-project', function ($view) {
            $accounts = Account::all()->where('is_admin', 0);
            if(auth()->user()){
                $view->with('accounts', $accounts);
            }else{
                $view->with('accounts', []);
            }
        });
    }
}
