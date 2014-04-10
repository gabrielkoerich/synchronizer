<?php namespace Algorit\Synchronizer;

use Psr\Log\LoggerInterface;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

use Monolog\Handler\StreamHandler;
// use Symfony\Bridge\Monolog\Handler\ConsoleHandler;
// use Symfony\Component\Console\Output\ConsoleOutput;
// use Symfony\Bridge\Monolog\Formatter\ConsoleFormatter;
use Algorit\Synchronizer\Request\Config;

use Algorit\Synchronizer\Storage\Sync;
use Algorit\Synchronizer\Storage\SyncEloquentRepository;

class SynchronizerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('algorit/synchronizer');

		$this->app['algorit.synchronizer'] = $this->app->share(function($app)
		{
			$sync = new SyncEloquentRepository(new Sync);

			$builder = new Builder(new Sender, new Receiver, $sync);

			return new Loader(new Container, $builder, new Config(new Filesystem));
		});

		$this->bootLogger();
	}

	public function bootLogger()
	{
		$logger = $this->app['log'];
			
		if( ! $logger)
		{
			return false;
		}

		$handler = new StreamHandler('php://output');

		$monolog = $logger->getMonolog();
		$monolog->pushHandler($handler);

		$this->app['algorit.synchronizer']->setLogger($logger);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(){}

	// public function console($logger)
	// {	
	// 	$monolog = $logger->getMonolog();

	// 	$handler = new ConsoleHandler(new ConsoleOutput);
	// 	$handler->setFormatter(new ConsoleFormatter);
	// 	$monolog->pushHandler($handler);
	// }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('synchronizer');
	}

}