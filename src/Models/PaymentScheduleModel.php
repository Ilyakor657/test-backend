<?php
  class PaymentScheduleModel {
    private $amount;
    private $period;
    private $dateOpen;
    private $rate;

    public function __construct($info) {
      $this->amount = $info->amount;
      $this->period = $info->period;
      $this->dateOpen = $info->dateOpen;
      $this->rate = $info->rate;
    }

    public function getAmount() {
      return $this->amount;
    }

    public function getPeriod() {
      return $this->period;
    }

    public function getDateOpen() {
      return $this->dateOpen;
    }

    public function getRate() {
      return $this->rate;
    }   
  }
?>