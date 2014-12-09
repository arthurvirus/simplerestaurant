<?php
/**
 * @file
 * Contains \Drupal\simplerestaurant\Controller\SimplerestaurantController.
 */
 
namespace Drupal\simplerestaurant\Controller;
 
/**
 * DemoController.
 */
class SimplerestaurantController {
  /**
   * Generates an example page.
   */
  public function demo() {
    return array(
      '#markup' => t('Hello World!'),
    );
  }      
}