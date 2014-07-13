<?php

namespace Drupal\menu_bench;

class MenuBenchController {
  function display() {
    if (\Drupal::hasService('menu_link.tree')) {
      return \Drupal::service('menu_link.tree')->renderMenu('menu_bench');
    }
    else {
      $tree_service = \Drupal::menuTree();
      $parameters = $tree_service->getCurrentRouteMenuTreeParameters('menu_bench');
      $tree = $tree_service->load('menu_bench', $parameters);
      $manipulators = array(
        array('callable' => 'menu.default_tree_manipulators:checkAccess'),
        array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
      );
      $tree = $tree_service->transform($tree, $manipulators);
      return $tree_service->build($tree);
    }
  }
  function decoy() {
    return 'Nothing to see here.';
  }
}
