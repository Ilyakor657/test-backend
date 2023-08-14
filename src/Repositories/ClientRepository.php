<?php
  require_once 'config/database.php';
  require_once 'src/Mappers/Mapper.php';

  class ClientRepository {
    private $db;
    private $mapper;
    
    public function __construct() {
      $database = DataBase::getInstance();
      $this->db = $database->getConnect();
      $this->mapper = new Mapper();
    }

    public function checkClient($subject, $inn) {
      $subject_id = $this->mapper->mapPgSqlToObject(pg_query($this->db, "SELECT id FROM $subject WHERE inn=$inn"));
      if (!$subject_id) {
        return $subject_id;
      } else {
        $client_id = $this->mapper->mapPgSqlToObject(pg_query($this->db, "SELECT id FROM client WHERE subject_id='".$subject_id->id."' AND subject='".$subject."'"));
        if (!$client_id) {
          http_response_code(400);
          exit;
        }
        return $client_id->id;
      }
    }

    public function createClient($client) {
      switch ($client->getSubject()) {
        case 'legal':
          $addressString = "".$client->getOrg()->getAddress()->getRegion().", г. ".$client->getOrg()->getAddress()->getCity().", ул. ".$client->getOrg()->getAddress()->getStreet()." ".$client->getOrg()->getAddress()->getHouse()."";
          $queryString = "INSERT INTO legal (surname, name, patronymic, inn_chief, name_org, ogrn, inn, kpp, address)
          VALUES ('".$client->getChief()->getSurname()."', '".$client->getChief()->getName()."',
          '".$client->getChief()->getPatronymic()."', '".$client->getChief()->getInn()."',
          '".$client->getOrg()->getNameOrg()."', '".$client->getOrg()->getOgrn()."', '".$client->getOrg()->getInnOrg()."',
          '".$client->getOrg()->getKpp()."', '".$addressString."') RETURNING id";
          break;
        case 'individual':
          $queryString = "INSERT INTO individual (surname, name, patronymic, date_birth, inn, serial, number, date_issue)
          VALUES ('".$client->getSurname()."', '".$client->getName()."',
          '".$client->getPatronymic()."', '".$client->getDateBirth()."', '".$client->getInn()."', 
          '".$client->getPassport()->getSerial()."', '".$client->getPassport()->getNumber()."', '".$client->getPassport()->getDateIssue()."') RETURNING id";
          break;  
      }
      $subject_id = pg_query($this->db, $queryString);
      $client_id = pg_query($this->db, "INSERT INTO client (subject, subject_id)
      VALUES ('".$client->getSubject()."', '".$this->mapper->mapPgSqlToObject($subject_id)->id."') RETURNING id");
      if (!$subject_id || !$client_id) {
        http_response_code(400);
        exit;
      } else {
        return $this->mapper->mapPgSqlToObject($client_id)->id;
      }
    }
  } 
?>