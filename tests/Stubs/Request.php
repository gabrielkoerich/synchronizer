<?php namespace Algorit\Synchronizer\Tests\Stubs;

use Algorit\Synchronizer\Request\Request as AbstractRequest;
use Algorit\Synchronizer\Request\RequestInterface;

class Request extends AbstractRequest implements RequestInterface {

	public function authenticate(){}

	public function executeRequest($auth = true){}

	public function receive($entityName, $lastSync){}

	public function send($entityName, Array $data, $lastSync = false){}

}