<?php

namespace Drupal\observer\Controller;


interface Observer {
  public function update(Observable $o, $data = NULL);
}

interface DisplayElement {
  public function display();
}