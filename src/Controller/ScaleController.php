<?php

namespace Drupal\scale\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\scale\Api\ScaleClient;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ScaleController
 *
 * @package Drupal\Scale\Controller
 */
class ScaleController extends ControllerBase {

  /**
   * @var ScaleClient
   */
  protected $client;

  /**
   * ScaleController constructor.
   *
   * @param \Drupal\scale\Api\ScaleClient $client
   */
  public function __construct(ScaleClient $client) {
    $this->client = $client;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return \Drupal\Core\Controller\ControllerBase|static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('scale.api')
    );
  }

  /**
   * Render a list of posts
   *
   * @return array
   */
  public function postsList() {
    $results = $this->client->getPosts();

    $posts = array_map(function ($post) {
      return [
        'id' => $post->id,
        'title' => $post->title,
        'user' => $this->client->getUser($post->userId)
      ];
    }, $results);

    return [
      '#theme' => 'posts_list',
      '#posts' => $posts,
      '#title' => 'Posts List',
      '#cache' => [
        'max-age' => 3600
      ]
    ];
  }

  /**
   * Render a single post
   *
   * @param $id
   * @return array
   */
  public function postContent($id) {
    $post = $this->client->getPost($id);

    return [
      '#theme' => 'single_post',
      '#post' => $post,
      '#title' => $post->title
    ];
  }
}
