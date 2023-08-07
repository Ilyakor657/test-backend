<?php
  require_once 'db.php';

  class ClientModel {
    private $db;

    public function __construct() {
      $this->db = (new DB())->connect();
    }

    public function checkClient($subject, $inn) {
      $subject_id = pg_fetch_object(pg_query($this->db, "SELECT id FROM $subject WHERE inn=$inn"));
      if (!$subject_id) {
        return $subject_id;
      } else {
        $client_id = pg_fetch_object(pg_query($this->db, "SELECT id FROM client WHERE subject_id='".$subject_id->id."' AND subject='".$subject."'"));
        if (!$client_id) {
          http_response_code(400);
          exit;
        }
        return $client_id->id;
      }
    }

    public function createClient($client) {
      $queryString;
      switch ($client->subject) {
        case 'legal':
          $addressString = "".$client->org->address->region.", г. ".$client->org->address->city.", ул. ".$client->org->address->street." ".$client->org->address->house."";
          $queryString = "INSERT INTO legal (surname, name, patronymic, inn_chief, name_org, ogrn, inn, kpp, address)
          VALUES ('".$client->chief->surnameLegal."', '".$client->chief->nameLegal."',
          '".$client->chief->patronymicLegal."', '".$client->chief->innLegal."',
          '".$client->org->nameOrg."', '".$client->org->ogrn."', '".$client->org->innOrg."',
          '".$client->org->kpp."', '".$addressString."') RETURNING id";
          break;
        case 'individual':
          $queryString = "INSERT INTO individual (surname, name, patronymic, date_birth, inn, serial, number, date_issue)
          VALUES ('".$client->surnameIndividual."', '".$client->nameIndividual."',
          '".$client->patronymicIndividual."', '".$client->dateBirth."', '".$client->innIndividual."', 
          '".$client->passport->serial."', '".$client->passport->number."', '".$client->passport->dateIssue."') RETURNING id";
          break;  
      }
      $subject_id = pg_query($this->db, $queryString);
      $client_id = pg_query($this->db, "INSERT INTO client (subject, subject_id)
      VALUES ('".$client->subject."', '".pg_fetch_object($subject_id)->id."') RETURNING id");
      if (!$subject_id || !$client_id) {
        http_response_code(400);
        exit;
      } else {
        return pg_fetch_object($client_id)->id;
      }
    }
  } 
?>