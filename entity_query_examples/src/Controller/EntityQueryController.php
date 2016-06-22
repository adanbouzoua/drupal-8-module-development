<?php

namespace Drupal\entity_query_examples\Controller;

use Drupal\Core\Controller\ControllerBase;

class EntityQueryController extends ControllerBase {
    
  public function userList() {
    $query = $this->entityTypeManager()->getStorage('user')->getQuery();
    $query->condition('name', 'r%', 'LIKE'); 
    $results = $query->execute();
    ksm($results);
    
    $header = [
      $this->t('Username'),
      $this->t('Email'),
    ];
    $rows = [];
    
    $users = $this->entityTypeManager()->getStorage('user')->loadMultiple($results);

    foreach ($users as $user) {
      $rows[] = [
        $user->getDisplayName(),
        $user->getEmail()
      ];
    } 
    
    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }
}