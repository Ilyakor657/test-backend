<?php
  require_once 'src/Repositories/ApplicationRepository.php';
  require_once 'src/Repositories/ClientRepository.php';

  class CreateApplicationUseCase {
    private $client;
    private $product;
    private $clientRepository;
    private $applicationRepository;

    public function __construct($client, $product) {
      $this->client = $client;
      $this->product = $product;
      $this->clientRepository = new ClientRepository();
      $this->applicationRepository = new ApplicationRepository();
    }

    public function createApplication() {
      switch ($this->client->getSubject()) {
        case 'legal':
          $inn = $this->client->getOrg()->getInnOrg();
          break;
        case 'individual':
          $inn = $this->client->getInn();
          break;
      }
      $this->client->setClientId($this->clientRepository->checkClient($this->client->getSubject(), $inn));
      if (!$this->client->getClientId()) {
        $this->client->setClientId($this->clientRepository->createClient($this->client));
      }
      $this->applicationRepository->createApplication($this->product, $this->client->getClientId());
      return;
    }
  } 
?>