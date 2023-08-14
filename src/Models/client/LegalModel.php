<?php
  class LegalModel {
    private $clientId;
    private $subject;
    private $chief;
    private $org;
    
    public function __construct($subject, $chief, $org) {
      $this->subject = $subject;
      $this->chief = $chief;
      $this->org = $org;
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

    public function getChief() {
      return $this->chief;
    }

    public function getOrg() {
      return $this->org;
    }
  } 

  class Chief {
    private $surname;
    private $name;
    private $patronymic;
    private $inn;

    public function __construct($chief) {
      $this->surname = $chief->surnameLegal;
      $this->name = $chief->nameLegal;
      $this->patronymic = $chief->patronymicLegal;
      $this->inn = $chief->innLegal;
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

    public function getInn() {
      return $this->inn;
    }
  }

  class Org {
    private $nameOrg;
    private $ogrn;
    private $innOrg;
    private $kpp;
    private $address;

    public function __construct($org, $address) {
      $this->nameOrg = $org->nameOrg;
      $this->ogrn = $org->ogrn;
      $this->innOrg = $org->innOrg;
      $this->kpp = $org->kpp;
      $this->address = $address;
    }

    public function getNameOrg() {
      return $this->nameOrg;
    }

    public function getOgrn() {
      return $this->ogrn;
    }

    public function getInnOrg() {
      return $this->innOrg;
    }

    public function getKpp() {
      return $this->kpp;
    }

    public function getAddress() {
      return $this->address;
    }
  }

  class Address {
    private $region;
    private $city;
    private $street;
    private $house;

    public function __construct($address) {
      $this->region = $address->region;
      $this->city = $address->city;
      $this->street = $address->street;
      $this->house = $address->house;
    }

    public function getRegion() {
      return $this->region;
    }

    public function getCity() {
      return $this->city;
    }

    public function getStreet() {
      return $this->street;
    }

    public function getHouse() {
      return $this->region;
    }
  }
?>