<?php
  require_once 'services/dateService.php';

  class PaymentScheduleModel {
    private $payments = [];
    private $key = 0;
    private $number = 0;
    private $dateLast;
    private $dateNow;
    private $balance;
    private $percent;
    private $amountPayment;
    private $period;
    private $rate;
    private $debt;

    public function __construct($amount, $period, $date, $rate) {
      $this->period = $period;
      $this->rate = $rate;
      $this->dateNow = $date;
      $this->balance = round($amount, 2);
      $rateMonth = $rate/(100*12);
      $this->amountPayment = round((
        $amount*(($rateMonth*pow((1 + $rateMonth), $period))/
        (pow((1 + $rateMonth), $period) - 1))
      ), 2);
    }

    public function monthlyPayments() {
      for ($i = 0; $i < $this->period; $i++) {
        $this->key++;
        $this->number++;
        $this->dateLast = $this->dateNow;
        $this->dateNow = dateException(date('Y-m-d', strtotime('+1 month', strtotime($this->dateLast))));
        if (date('L',strtotime($this->dateLast)) != date('L',strtotime($this->dateNow))) {
          $dayInYear1 = date('L', strtotime($this->dateLast)) == 1 ? 366 : 365;
          $differenceDay1 = date_diff(date_create($this->dateLast), date_create(''.explode("-", $this->dateLast)[0].'-12-31'))->format('%a');
          $percent1 = round(((($this->balance*($this->rate/100))/$dayInYear1)*$differenceDay1), 2);
          $dayInYear2 = date('L',strtotime($this->dateNow)) == 1 ? 366: 365;
          $differenceDay2 = date_diff(date_create(''.explode("-", $this->dateNow)[0].'-01-01'), date_create($this->dateNow))->format('%a');
          $percent2 = round(((($this->balance*($this->rate/100))/$dayInYear2)*($differenceDay2 + 1)), 2);
          $this->percent = round(($percent1 + $percent2), 2);
        } else {
          $dayInYear = date('L', strtotime($this->dateNow)) == 1 ? 366 : 365;
          $differenceDay = date_diff(date_create($this->dateLast), date_create($this->dateNow))->format('%a');
          $this->percent = round(((($this->balance*($this->rate/100))/$dayInYear)*$differenceDay), 2);
        }
        if ($i == ($this->period - 1)) {
          $this->amountPayment = round(($this->balance + $this->percent), 2);
          $this->debt = $this->balance;
        } else {
          $this->debt = round(($this->amountPayment - $this->percent), 2);
          $this->balance = round(($this->balance - $this->debt), 2);
        }
        $payment = [
          "key" => $this->key,
          "number" => $this->number,
          "date" => date("d.m.Y", strtotime($this->dateNow)),
          "amountPayment" => number_format($this->amountPayment, 2, ',', ' '),
          "percent" => number_format($this->percent, 2, ',', ' '),
          "debt" => number_format($this->debt, 2, ',', ' ')
        ];
        array_push($this->payments, $payment);
      }
      return json_encode($this->payments);
    }
  } 
?>