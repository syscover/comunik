<?php namespace Syscover\Comunik;

use Illuminate\Support\ServiceProvider;

class ComunikServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// include route.php file
		include realpath(__DIR__ . '/../../routes.php');

		// register views
		$this->loadViewsFrom(realpath(__DIR__ . '/../../views'), 'comunik');

		// register translations
		$this->loadTranslationsFrom(realpath(__DIR__ . '/../../lang'), 'comunik');

		// register public files
		$this->publishes([
			realpath(__DIR__ . '/../../../public') => public_path('/packages/syscover/comunik')
		]);

        // register migrations
        $this->publishes([
            __DIR__.'/../../database/migrations/' => base_path('/database/migrations'),
			__DIR__.'/../../database/migrations/updates/' => base_path('/database/migrations/updates'),
        ], 'migrations');

        // register migrations
        $this->publishes([
            __DIR__.'/../../database/seeds/' => base_path('/database/seeds')
        ], 'seeds');
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
