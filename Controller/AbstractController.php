<?php
namespace Mbates\ChargifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mbates\ChargifyBundle\Controller\AbstractControllerInterface;

abstract class AbstractController implements AbstractControllerInterface
{
    /**
     * @var \Guzzle\Http\ClientInterface $client
     */
    private $client;

    public function __construct(\Guzzle\Http\ClientInterface $client, $apiKey)
    {
        $client->getConfig()->setPath('request.options/auth', array($apiKey, 'x', 'Basic'));

        $this->client = $client;
    }

    protected function request($uri, $body, $method = 'GET')
    {
        $data = null;

        switch ($method) {
            case 'POST':
                $request = $this->client->post($uri.'.json');
                $request->setBody($body);
                break;

            case 'PUT':
                $request = $this->client->put($uri.'.json');
                $request->setBody(json_encode($body));
                break;

            case 'DELETE':
                $request = $this->client->delete($uri);
                break;

            default: // GET
                $request = $this->client->get($uri);
        }

        $response = $request->send();

        if ($response->isSuccessful()) {
            // TODO: Test if the response is JSON.
            $data = $response->json();
        }

        return $data;
    }

    public function getClient()
    {
        return $this->client;
    }

}