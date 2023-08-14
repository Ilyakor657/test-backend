<?php
  class IndividualModel {
    private $clientId;
    //private $id;
    private $subject;
    private $surname;
    private $name;
    private $patronymic;
    private $dateBirth;
    private $inn;
    private $passport;

    public function __construct($client, $passport) {
      $this->subject = $client->subject;
      $this->surname = $client->surnameIndividual;
      $this->name = $client->nameIndividual;
      $this->patronymic = $client->patronymicIndividual;
      $this->dateBirth = $client->dateBirth;
      $this->inn = $client->innIndividual;
      $this->passport = $passport;
    }

    public function getClientId() {
      return $this->clientId;
    }

    public function setClientId($id) {
      $this->clientId = $id;
    }

    public function getSubject() {
      return $this->subject;
    }

    public function getSurname() {
      return $this->surname;
    }

    public function getName() {
      return $this->name;
    }

    public function getPatronymic() {
      return $this->patronymic;
    }

    public function getDateBirth() {
      return $this->dateBirth;
    }

    public function getInn() {
      return $this->inn;
    }

    public function getPassport() {
      return $this->passport;
    } 
  } 

  class Passport {
    private $serial;
    private $number;
    private $dateIssue;

    public function __construct($passport) {
      $this->serial = $passport->serial;
      $this->number = $passport->number;
      $this->dateIssue = $passport->dateIssue;
    }

    public function getSerial() {
      return $this->serial;
    }

    public function getNumber() {
      return $this->number;
    }

    public function getDateIssue() {
      return $this->dateIssue;
    }
  }
?>