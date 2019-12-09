<?php


namespace Drupal\scale\Api;

/**
 * Class ScaleClient
 *
 * @package Drupal\scale\Api
 */
class ScaleClient extends Api {

  /**
   * Client constructor.
   */
  public function __construct() {
    $baseUrl = 'https://jsonplaceholder.typicode.com/';
    parent::__construct($baseUrl);
  }

  /**
   * Get an array of posts from the Endpoint
   *
   * @return array
   */
  public function getPosts(): array {
    $this->setEndpointUrl('posts');

    $response = $this->getResponse();

    $content = $response->getBody()->getContents();

    return json_decode($content);
  }

  /**
   * Get a single post object by its ID
   *
   * @param int $id
   *
   * @return object
   */
  public function getPost(int $id): object {
    $this->setEndpointUrl("posts/{$id}");

    $response = $this->getResponse();

    $content = $response->getBody()->getContents();

    return json_decode($content);
  }

  /**
   * Get a single user object by its ID
   *
   * @param int $id
   *
   * @return object
   */
  public function getUser(int $id): object {
    $this->setEndpointUrl("users/{$id}");

    $response = $this->getResponse();

    $content = $response->getBody()->getContents();

    return json_decode($content);
  }
}
