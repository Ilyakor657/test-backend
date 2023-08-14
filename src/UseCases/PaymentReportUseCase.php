<?php
  class PaymentReportUseCase {
    private $xml;
    private $xsl;

    public function __construct($client, $schedule) {
      $clientString;
      switch ($client->getSubject()) {
        case 'legal':
          $clientString = '
            <chief>
              <surnameLegal>'.$client->getChief()->getSurname().'</surnameLegal>
              <nameLegal>'.$client->getChief()->getName().'</nameLegal>
              <patronymicLegal>'.$client->getChief()->getPatronymic().'</patronymicLegal>
              <innLegal>'.$client->getChief()->getInn().'</innLegal>
            </chief>
            <org>
              <nameOrg>'.$client->getOrg()->getNameOrg().'</nameOrg>
              <ogrn>'.$client->getOrg()->getOgrn().'</ogrn>
              <innOrg>'.$client->getOrg()->getInnOrg().'</innOrg>
              <kpp>'.$client->getOrg()->getKpp().'</kpp>
              <address>
                <region>'.$client->getOrg()->getAddress()->getRegion().'</region>
                <city>'.$client->getOrg()->getAddress()->getCity().'</city>
                <street>'.$client->getOrg()->getAddress()->getStreet().'</street>
                <house>'.$client->getOrg()->getAddress()->getHouse().'</house>
              </address>
            </org>';
          break;
        case 'individual':
          $clientString = '
            <client>
              <surnameIndividual>'.$client->getSurname().'</surnameIndividual>
              <nameIndividual>'.$client->getName().'</nameIndividual>
              <patronymicIndividual>'.$client->getPatronymic().'</patronymicIndividual>
              <dateBirth>'.$client->getDateBirth().'</dateBirth>
              <innIndividual>'.$client->getInn().'</innIndividual>
              <passport>
                <serial>'.$client->getPassport()->getSerial().'</serial>
                <number>'.$client->getPassport()->getNumber().'</number>
                <dateIssue>'.$client->getPassport()->getDateIssue().'</dateIssue>
              </passport>
            </client>';
          break;
      }
      $productString = '';
      foreach($schedule as $product) {
        $productString .= '
          <payment>
            <number>'.$product['number'].'</number>
            <date>'.$product['date'].'</date>
            <amountPayment>'.$product['amountPayment'].'</amountPayment>
            <percent>'.$product['percent'].'</percent>
            <debt>'.$product['debt'].'</debt>
          </payment>';
      }
      $xmlString = '<?xml version="1.0" encoding="utf-8"?>
        <report>
          '.$clientString.'
          <table>
            '.$productString.'
          </table>
        </report>';
      $this->xsl = new DOMDocument;
      $this->xml = simplexml_load_string($xmlString);
      $this->xsl->load('src/templates/paymentReport.xsl');
    }

    public function createReport() {
      $proc = new XSLTProcessor;
      $proc->importStyleSheet($this->xsl);
      return $proc->transformToXML($this->xml);
    }
  } 
?>