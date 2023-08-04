<?php
  include_once 'models/applicationModel.php';
  include_once 'models/clientModel.php';

  class ApplicationController {
    private $application;
    private $client;

    public function __construct() {
      $this->application = new ApplicationModel();
      $this->client = new ClientModel();
    }

    public function createApplication($req) {
      $inn;
      if ($req->client->subject == 'legal') {
        $inn = $req->client->org->innOrg;
      } elseif ($req->client->subject == 'individual') {
        $inn = $req->client->innIndividual;
      }
      $client_id = $this->client->checkClient($req->client->subject, $inn);
      if (!$client_id) {
        $client_id = $this->client->createClient($req->client);
      }
      $this->application->createApllication($req->product, $client_id);
      http_response_code(200);
      exit;
    }

    public function getApplication($req) {
      $this->application->getApllication();
      http_response_code(200);
      exit;
    }
  } 
?>