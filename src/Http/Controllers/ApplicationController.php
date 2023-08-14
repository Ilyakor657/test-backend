<?php
  require_once 'src/Models/ProductModel.php';
  require_once 'src/Models/client/LegalModel.php';
  require_once 'src/Models/client/IndividualModel.php';
  require_once 'src/UseCases/CreateApplicationUseCase.php';

  class ApplicationController {
    public function createApplication($req) {
      switch ($req->client->subject) {
        case 'legal':
          $chief = new Chief($req->client->chief);
          $address = new Address($req->client->org->address);
          $org = new Org($req->client->org, $address);
          $client = new LegalModel($req->client->subject, $chief, $org);
          break;
        case 'individual':
          $passport = new Passport($req->client->passport);
          $client = new IndividualModel($req->client, $passport);
          break;
      }
      $product = new ProductModel($req->product);
      $application = new CreateApplicationUseCase($client, $product);
      $application->createApplication();
      http_response_code(200);
      exit;
    }
  } 
?>