<?php namespace Webwork\Customersupport;

use Illuminate\Support\ServiceProvider;

class CustomersupportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            base_path('vendor/webwork/customersupport/src/config/config.php') => config_path('customersupport.php'),
            base_path('vendor/webwork/customersupport/src/migrations') => base_path('database/migrations'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            base_path('vendor/webwork/customersupport/src/config/config.php'), 'customersupport'
        );
    }
}
