<?php namespace Algorit\Synchronizer\Request\Dispatchers;

use Algorit\Synchronizer\Request\Methods\MethodInterface;

class Receiver extends Dispatcher {

	/**
	 * The request methods.
	 *
	 * @var array
	 */
	protected $methods = array('put', 'get', 'post', 'delete', 'patch');
	
	/**
	 * Create a new instance.
	 *
	 * @param  \Algorit\Synchronizer\Request\Methods\MethodInterface  $request
	 * @return instance
	 */
	public function __construct(MethodInterface $request)
	{
		$this->request = $request;
	}

	public function getName()
	{

	}

	public function getRequestUrl()
	{
		
	}

	public function dispatch($requestMethod, $data = array(), $options = array())
	{
		
	}

}