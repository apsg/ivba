<?php
namespace Gacek\IExcel;

use Illuminate\Support\ServiceProvider;

class IExcelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/iexcel.php' => config_path('iexcel.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/iexcel.php', 'iexcel'
        );
    }
}
