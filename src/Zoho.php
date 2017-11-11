<?php
/**
 * Created by PhpStorm.
 * User: Teen Techies
 * Date: 10-11-2017
 * Time: 07:20 PM
 */

namespace rahulreghunath\zoho;


class Zoho
{
    private $key;

    public function __construct() {

        $this->key = config('zoho.key'); # authentication key

    }

    private function checkOptions($option,$value) { # checking option's availability

        if($option ) {
            return "&".$value."=".$option;
        } else {
            return null;
        }

    }

    private function getData($url,$param) { # getting remote data from Zoho

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($ch);
        curl_error ($ch);
        curl_close($ch);
        return json_decode($result, true);

    }

    public function getMyRecord(
        $scope = 'crmapi',
        $selectColumns = null,
        $fromIndex = null,
        $toIndex = null,
        $sortColumnString = null,
        $sortOrderString = null,
        $lastModifiedTime = null,
        $newFormat = null,
        $version = null
    ) {

        $url = 'https://crm.zoho.com/crm/private/json/Leads/getMyRecords';
        $param= "authtoken=".$this->key
            .$this->checkOptions($scope,'scope')
            .$this->checkOptions($selectColumns,'selectColumns')
            .$this->checkOptions($fromIndex,'fromIndex')
            .$this->checkOptions($toIndex,'toIndex')
            .$this->checkOptions($sortColumnString,'sortColumnString')
            .$this->checkOptions($sortOrderString,'sortOrderString')
            .$this->checkOptions($lastModifiedTime,'lastModifiedTime')
            .$this->checkOptions($newFormat,'newFormat')
            .$this->checkOptions($version,'version');


        return $this->getData($url,$param);

    }

    public function getRecords(
        $scope = 'crmapi',
        $selectColumns = null,
        $fromIndex = null,
        $toIndex = null,
        $sortColumnString = null,
        $sortOrderString = null,
        $lastModifiedTime = null,
        $newFormat = null,
        $version = null
    ) {

         $url = 'https://crm.zoho.com/crm/private/json/Leads/getRecords';
         $param= "authtoken=".$this -> key
            .$this->checkOptions($scope,'scope')
            .$this->checkOptions($selectColumns,'selectColumns')
            .$this->checkOptions($fromIndex,'fromIndex')
            .$this->checkOptions($toIndex,'toIndex')
            .$this->checkOptions($sortColumnString,'sortColumnString')
            .$this->checkOptions($sortOrderString,'sortOrderString')
            .$this->checkOptions($lastModifiedTime,'lastModifiedTime')
            .$this->checkOptions($newFormat,'newFormat')
            .$this->checkOptions($version,'version');

        return $this->getData($url,$param);

    }

    public function getRecordById (
        $scope = 'crmapi',
        $ids = null,
        $newFormat = null,
        $version = null
    ) {


        if($ids) {
            if (strpos($ids, ';')) {
                $ids = '&idlist='.$ids;
            } else {
                $ids = '&id='.$ids;
            }
        }
        $url = 'https://crm.zoho.com/crm/private/json/Leads/getRecordById';
        $param= "authtoken=".$this -> key
            .$this->checkOptions($scope,'scope')
            .$ids
            .$this->checkOptions($newFormat,'scope')
            .$this->checkOptions($version,'scope');

        return $this->getData($url,$param);
    }
}
