<?php


namespace Drupal\scale\Api;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Api
 *
 * @package Drupal\scale\Api
 */
class Api {

  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * @var string
   */
  protected $baseUrl;

  /**
   * @var string
   */
  protected $endpointUrl;

  /**
   * @var ResponseInterface
   */
  protected $response;

  /**
   * Api constructor.
   *
   * @param string $baseUrl
   */
  public function __construct(string $baseUrl) {
    $this->client = \Drupal::httpClient();
    $this->baseUrl = $baseUrl;
  }

  /**
   * @return string
   */
  public final function getBaseUrl(): string {
    return $this->baseUrl;
  }

  /**
   * @return string
   */
  public final function getEndpointUrl(): string {
    return $this->endpointUrl;
  }

  /**
   * @param string $endpointUrl
   *
   * @return Api
   */
  public final function setEndpointUrl(string $endpointUrl): Api {
    $this->endpointUrl = $endpointUrl;
    return $this;
  }

  /**
   * @return ResponseInterface
   */
  public final function getResponse(): ResponseInterface {
    $url = "{$this->baseUrl}{$this->getEndpointUrl()}";

    $this->response = $this->client->get($url);

    return $this->response;
  }

  /**
   * @return string
   */
  public final function getResults(): string {
    return $this->getResponse()->getBody()->getContents();
  }

}
