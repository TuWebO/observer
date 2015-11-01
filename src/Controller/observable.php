<?php

namespace Drupal\observer\Controller;


abstract class Observable {
  private $observers = array();
  private $changed = FALSE;

  public function addObserver(Observer $o) {
    array_push($this->observers, $o);
  }

  public function deleteObserver(Observer $o) {
    $i = array_search($o, $this->observers);
    if ($i !== FALSE) {
      unset($this->observers[$i]);
    }
  }

  public function notifyObservers(/*\stdClass*/ $obj = NULL) {
    if ($this->changed) {
      foreach ($this->observers as $observer) {
        $observer->update($this, $obj);
      }
      $this->clearChanged();
    }
  }

  protected function setChanged() {
    $this->changed = TRUE;
  }

  protected function clearChanged() {
    $this->changed = FALSE;
  }

  protected function hasChanged() {
    return $this->changed;
  }
}