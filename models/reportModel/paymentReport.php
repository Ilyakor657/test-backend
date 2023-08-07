<?php
  class PaymentReportModel {
    private $xml;
    private $xsl;

    public function __construct($client, $schedule) {
      $clientString;
      switch ($client->subject) {
        case 'legal':
          $clientString = '
            <chief>
              <surnameLegal>'.$client->chief->surnameLegal.'</surnameLegal>
              <nameLegal>'.$client->chief->nameLegal.'</nameLegal>
              <patronymicLegal>'.$client->chief->patronymicLegal.'</patronymicLegal>
              <innLegal>'.$client->chief->innLegal.'</innLegal>
            </chief>
            <org>
              <nameOrg>'.$client->org->nameOrg.'</nameOrg>
              <ogrn>'.$client->org->ogrn.'</ogrn>
              <innOrg>'.$client->org->innOrg.'</innOrg>
              <kpp>'.$client->org->kpp.'</kpp>
              <address>
                <region>'.$client->org->address->region.'</region>
                <city>'.$client->org->address->city.'</city>
                <street>'.$client->org->address->street.'</street>
                <house>'.$client->org->address->house.'</house>
              </address>
            </org>';
          break;
        case 'individual':
          $clientString = '
            <client>
              <surnameIndividual>'.$client->surnameIndividual.'</surnameIndividual>
              <nameIndividual>'.$client->nameIndividual.'</nameIndividual>
              <patronymicIndividual>'.$client->patronymicIndividual.'</patronymicIndividual>
              <dateBirth>'.$client->dateBirth.'</dateBirth>
              <innIndividual>'.$client->innIndividual.'</innIndividual>
              <passport>
                <serial>'.$client->passport->serial.'</serial>
                <number>'.$client->passport->number.'</number>
                <dateIssue>'.$client->passport->dateIssue.'</dateIssue>
              </passport>
            </client>';
          break;
      }
      $productString = '';
      foreach(json_decode($schedule) as $product) {
        $productString .= '
          <payment>
            <number>'.$product->number.'</number>
            <date>'.$product->date.'</date>
            <amountPayment>'.$product->amountPayment.'</amountPayment>
            <percent>'.$product->percent.'</percent>
            <debt>'.$product->debt.'</debt>
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
      $this->xsl->load('templates/paymentReport.xsl');
    }

    public function createReport() {
      $proc = new XSLTProcessor;
      $proc->importStyleSheet($this->xsl);
      return $proc->transformToXML($this->xml);
    }
  } 
?>