<?php
namespace Mbates\ChargifyBundle\Controller;

interface AbstractControllerInterface
{
	public function __construct(\Guzzle\Http\ClientInterface $client, $apiKey);

    public function getClient();
}