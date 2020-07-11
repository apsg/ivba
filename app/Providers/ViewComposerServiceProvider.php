<?php
namespace App\Providers;

use App\Proof;
use App\ViewComposers\FrontLayoutViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        $domains = [
            'inauka',
            'projekt30',
        ];

        foreach ($domains as $domain) {
            View::composer($domain . '.partials.show_proof', function ($view) {
                $proof = Proof::first();

                return $view->with(compact('proof'));
            });

            View::composer($domain . '.layouts.front2', FrontLayoutViewComposer::class);
        }

        View::composer('layouts.front2', FrontLayoutViewComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
