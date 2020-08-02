<?php

namespace App\Providers;

use App\Models\Charity;
use App\Models\ContactUs;
use App\Models\Message;
use App\Models\User;
use App\models\usersInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
    public function boot(){
/*
            $newMessage = ContactUs::where('isRead', '1')->get();
            view()->share('newMessage', $newMessage);
*/
            view()->composer('*', function ($view) {
                if (Auth::check()){
                    $userData = usersInformation::where('user_id',auth()->user()->id)->first();
                    view()->share('userData', $userData);

                    $myChartity = Charity::where('user_id',auth()->user()->id)->get();
                    view()->share('myChartity',$myChartity);
                }

            });

    }
}
