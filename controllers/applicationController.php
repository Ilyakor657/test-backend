<?php
  
  class Application 
  {
    private $db;
    private $id;

    public function __construct()
		{
			$dbinfo = require 'db/dbInfo.php';
      $connectString = "host={$dbinfo['host']} port={$dbinfo['port']} dbname={$dbinfo['dbname']} user={$dbinfo['user']} password={$dbinfo['password']}";
      $this->db = pg_connect($connectString);
      if (!$this->db) {
        return http_response_code(400);
      }
		}

    private function checkClient($client)
		{
      $inn;
      if ($client->type == 'legal') {
        $inn = $client->org->innOrg;
      } else {
        $inn = $client->innIndividuals;
      }
      $result = pg_query($this->db, "SELECT id FROM $client->type WHERE inn=$inn");
      $this->id = pg_fetch_object($result);
		}

    private function createClient($client)
		{
      $queryString;
      if ($client->type == 'legal') {
        $addressString = "".$client->org->address->region.", г. ".$client->org->address->city.", ул. ".$client->org->address->street." ".$client->org->address->house."";
        $queryString = "INSERT INTO legal (surname, name, patronymic, inn_chief, name_org, ogrn, inn, kpp, address)
        VALUES ('".$client->chief->surnameLegal."', '".$client->chief->nameLegal."',
        '".$client->chief->patronymicLegal."', '".$client->chief->innLegal."',
        '".$client->org->nameOrg."', '".$client->org->ogrn."', '".$client->org->innOrg."',
        '".$client->org->kpp."', '".$addressString."') RETURNING id";
      } else {
        $queryString = "INSERT INTO individual (surname, name, patronymic, date_birth, inn, serial, number, date_issue)
        VALUES ('".$client->surnameIndividuals."', '".$client->nameIndividuals."',
        '".$client->patronymicIndividuals."', '".$client->dateBirth."', '".$client->innIndividuals."', 
        '".$client->passport->serial."', '".$client->passport->number."', '".$client->passport->dateIssue."') RETURNING id";
      }
      $result = pg_query($this->db, $queryString);
      if (!$result) {
        return http_response_code(400);
      } else {
        $this->id = pg_fetch_object($result);
      }
		}

    public function createApplication($req)
		{
      $this->checkClient($req->client);
      if ($this->id == false) {
        $this->createClient($req->client);
      }
      $queryString;
      if ($req->client->type == 'legal') {
        $queryString = "INSERT INTO applications (type, amount, rate, date_open, date_close, legal_id)
        VALUES ('".$req->product->type."', '".$req->product->amount."',
        '".$req->product->rate."', '".$req->product->dateOpen."', '".$req->product->dateClose."', 
        '".$this->id->id."') RETURNING id";
      } else {
        $queryString = "INSERT INTO applications (type, amount, rate, date_open, date_close, individual_id)
        VALUES ('".$req->product->type."', '".$req->product->amount."',
        '".$req->product->rate."', '".$req->product->dateOpen."', '".$req->product->dateClose."', 
        '".$this->id->id."') RETURNING id";
      }
      $result = pg_query($this->db, $queryString);
      if (!$result) {
        return http_response_code(400);
      } else {
        echo 'Заявка успешно отправлена';
      }
		}

    public function getApplication()
		{
      $result = pg_query($this->db, "SELECT * FROM applications");
      if (!$result) {
        return http_response_code(400);
      } else {
        while ($application = pg_fetch_object($result)) {
          echo var_dump($application);
        }
      }
		}
  }
?>