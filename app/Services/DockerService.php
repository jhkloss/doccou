<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class DockerService
{
    const DOCKER_SOCKET = '/var/run/docker.sock';
    const DOCKER_API_VERSION = 'v1.40';

    const IMAGE_PREFIX = 'doccou';
    const CONTAINER_PREFIX = 'container';

    /**
     * @var int
     */
    private $currentTask;

    /**
     * @var Client
     */
    private $client;

    /**
     * DockerService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'curl' => [
                CURLOPT_UNIX_SOCKET_PATH => self::DOCKER_SOCKET
            ]
        ]);
    }

    /**
     * @param string $endPoint
     * @param array $query
     * @return string
     */
    private function getAPIURI(string $endPoint, array $query = [])
    {
        $uri = 'http:/' . self::DOCKER_API_VERSION . '/' . $endPoint;

        if(!empty($query))
        {
            $uri = $this->addParams($uri, $query);
        }

        return $uri;
    }

    /**
     * @param $url
     * @param $params
     * @return string
     */
    private function addParams($url, $params)
    {
        return $url . '?' . http_build_query($params);
    }

    /**
     * @param ResponseInterface $response
     * @return bool|string
     */
    private function getResponseBody(ResponseInterface $response)
    {
            return (string) $response->getBody();
    }

    /**
     * @param ResponseInterface $response
     * @return bool|mixed
     */
    private function getResponseBodyJSON(ResponseInterface $response)
    {
            $jsonString = $this->getResponseBody($response);
            $result = json_decode($jsonString);

            if(is_object($result) || is_array($result))
            {
                return $result;
            }
        return false;
    }

    /**
     * @param ResponseInterface $response
     * @return int
     */
    private function getResponseCode(ResponseInterface $response)
    {
        return $response->getStatusCode();
    }

    /**
     * @param $uniqueID
     * @return string
     */
    private function getImageTag($uniqueID)
    {
        return self::IMAGE_PREFIX . ':' . $uniqueID;
    }

    /**
     * @return string
     */
    private function getContainerName()
    {
        return self::CONTAINER_PREFIX . '_' . uniqid();
    }

    /**
     * TODO Impelement
     */
    public function listContainers()
    {

    }

    /**
     * @param string $dockerArchive
     * @return array|mixed
     */
    public function createImage(string $dockerArchive)
    {
        $tag = $this->getImageTag(uniqid());

        $query = [
            't' => $tag,
            'forcerm' => true,
            'q' => true
        ];

        $uri = $this->getAPIURI('build', $query);

        // Get tar archive as stream
        $body = fopen($dockerArchive, 'r');

        $request = new Request('POST', $uri, [], $body);

        $response = $this->client->send($request);

        // Cleanup
        fclose($body);
        unlink($dockerArchive);

        if($this->getResponseCode($response) === 200)
        {
            $result['id'] = $this->getResponseBodyJSON($response)->stream;
            $result['tag'] = $tag;

            return $result;
        }

        return false;
    }

    /**
     * @param $imageID
     * @return mixed
     */
    public function createContainer($imageID)
    {
        $name = $this->getContainerName();

        $query = [
            'name' => $name,
        ];

        $uri = $this->getAPIURI('containers/create', $query);

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $bodyContent = [
            'Image' => $imageID,
        ];

        $body = json_encode($bodyContent);

        $request = new Request('POST', $uri, $headers, $body);

        $response = $this->client->send($request);

        $result['response'] = $this->getResponseBodyJSON($response);
        $result['name'] = $name;

        return $result;
    }

    /**
     * @param $imageID
     * @return bool|mixed
     */
    public function getImageInfo($imageID)
    {
        $uri = $this->getAPIURI('images/' . $imageID . '/json');
        $request = new Request('GET', $uri);
        $response = $this->client->send($request);
        return $this->getResponseBodyJSON($response);
    }

    public function getContainerInfo($containerName)
    {
        $uri = $this->getAPIURI('containers/' . $containerName . '/json');
        $request = new Request('GET', $uri);
        $response = $this->client->send($request);
        return $this->getResponseBodyJSON($response);
    }

    public function deleteContainer(string $handle)
    {
        $uri = $this->getAPIURI('containers/' . $handle);

        $query = [
            'force' => true,
        ];

        $request = new Request('DELETE', $uri, $query);
        $response = $this->client->send($request);
        return $this->getResponseBodyJSON($response);
    }

    public function startContainer()
    {

    }

    public function stopContainer()
    {

    }
}
