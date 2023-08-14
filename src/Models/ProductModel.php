<?php
  class ProductModel {
    private $type;
    private $amount; 
    private $rate;
    private $dateOpen;
    private $dateClose;

    public function __construct($product) {
      $this->type = $product->type;
      $this->amount = $product->amount;
      $this->rate = $product->rate;
      $this->dateOpen = $product->dateOpen;
      $this->dateClose = $product->dateClose;
    }

    public function getType() {
      return $this->type;
    }

    public function getAmount() {
      return $this->amount;
    }

    public function getRate() {
      return $this->rate;
    }

    public function getDateOpen() {
      return $this->dateOpen;
    }

    public function getDateClose() {
      return $this->dateClose;
    }
  } 
?>