<?php
namespace CMI;

use Exception;
use CMI\Exception\InvalidArgumentException;

class BaseCmiClient implements CmiClientInterface
{

    /**
     * @var string default base URL for CMI's API
     */
    const DEFAULT_API_BASE = 'https://testpayment.cmi.co.ma';
    
    /**
     * @var array Languages supported by CMI
     */
    const LANGUES = ['ar', 'fr', 'en'];

    /**
     * @var array all requiredOpts
     */
    public $requireOpts;
    
    /**
     * Initializes a new instance of the {BaseCmiClient} class.
     * 
     * The constructor takes a require multiple argument. it must be an array
     * 
     * Configuration setting include the following options:
     * 
     * - storekey (string) : it's necessary to generate hash key
     * - clientid (string) : it given by CMI you should contcat them to get a unique clientid
     * - oid (string) : command_id it should be unique for each time your would like to make transaction
     * - okUrl (string) The URL used to redirect the customer back to the mechant's web site (accepted payment)
     * - failUrl (string) The URL used to redirect the customer back to the mechant's web site (failed/rejected payment)
     * - email (string) Customer email
     * - BillToName (string) Customer's name (firstname and lastname)
     * - amount (Numeric) Transaction amount
     */
    public function __construct($requireOpts = [])
    {
        if(!\is_array($requireOpts)) {
            throw new Exception($requireOpts.' must be a array');
        }
        
        // MERGE REQUIRE OPTIONS WITH DEFAULT OPTIONS
        $requireOpts = \array_merge($this->getDefaultOpts(), $requireOpts);

        // VALIDATE REQUIRE OTPIONS
        $this->validateConfig($requireOpts);

        $storeKey = $requireOpts['storekey'];
        
        unset($requireOpts['storekey']); // EXCLUDE storekey
        // ASSIGN 
        $this->requireOpts = $requireOpts;
              
        // GENERATE HASH
        $this->HASH = $this->generateHash($storeKey);

    }

    /**
     * Get default options CMI
     * 
     * @return array all default options
     */
    public function getDefaultOpts()
    {
        return [
            'storetype' => '3D_PAY_HOSTING',
            'trantype' => 'PreAuth',
            'currency' => '504', // MAD
            'rnd' => microtime(),
            'lang' => 'fr',
            'hashAlgorithm' => 'ver3',
            'encoding' => 'UTF-8', // OPTIONAL
            'refreshtime' => '5' // OPTIONAL
        ];
    }

    /**
     * Get all requires options
     * 
     * @return array all require options
     */
    public function getRequireOpts() {

        return $this->requireOpts;
    }
    
    /**
     * @param array<string, mixed> $config
     * 
     * @throws \CMI\Exception\InvalidArgumentException
     */
    private function validateConfig($config)
    {
        //storekey
        if(!isset($config['storekey'])) {
            throw new InvalidArgumentException('storekey is required');
        }

        if($config['storekey'] !== null && !\is_string($config['storekey'])) {
            throw new InvalidArgumentException('storekey must be null or string');
        }

        if($config['storekey'] !== null && $config['storekey'] === '') {
            throw new InvalidArgumentException('storekey cannot be the empty string');
        }

        if($config['storekey'] !== null && (\preg_match('/\s/', $config['storekey']))) {
            throw new InvalidArgumentException('storekey cannot contain whitespace');
        }

        //clientid
        if(!isset($config['clientid'])) {
            throw new InvalidArgumentException('clientid is required');
        }

        if($config['clientid'] !== null && !\is_string($config['clientid'])) {
            throw new InvalidArgumentException('clientid must be null or string');
        }

        if($config['clientid'] !== null && $config['clientid'] === '') {
            throw new InvalidArgumentException('clientid cannot be the empty string');
        }

        if($config['clientid'] !== null && (\preg_match('/\s/', $config['clientid']))) {
            throw new InvalidArgumentException('clientid cannot contain whitespace');
        }

        //storetype
        if(!isset($config['storetype'])) {
            throw new InvalidArgumentException('storetype is required');
        }

        if($config['storetype'] !== null && !\is_string($config['storetype'])) {
            throw new InvalidArgumentException('storetype must be null or string');
        }

        if($config['storetype'] !== null && $config['storetype'] === '') {
            throw new InvalidArgumentException('storetype cannot be the empty string');
        }

        if($config['storetype'] !== null && (\preg_match('/\s/', $config['storetype']))) {
            throw new InvalidArgumentException('storetype cannot contain whitespace');
        }

        //trantype
        if(!isset($config['trantype'])) {
            throw new InvalidArgumentException('trantype is required');
        }

        if($config['trantype'] !== null && !\is_string($config['trantype'])) {
            throw new InvalidArgumentException('trantype must be null or string');
        }

        if($config['trantype'] !== null && $config['trantype'] === '') {
            throw new InvalidArgumentException('trantype cannot be the empty string');
        }

        if($config['trantype'] !== null && (\preg_match('/\s/', $config['trantype']))) {
            throw new InvalidArgumentException('trantype cannot contain whitespace');
        }

        //amount
        if(!isset($config['amount'])) {
            throw new InvalidArgumentException('amount is required');
        }

        if($config['amount'] !== null && !\is_string($config['amount'])) {
            throw new InvalidArgumentException('amount must be null or string');
        }

        if($config['amount'] !== null && $config['amount'] === '') {
            throw new InvalidArgumentException('amount cannot be the empty string');
        }

        if($config['amount'] !== null && (\preg_match('/\s/', $config['amount']))) {
            throw new InvalidArgumentException('amount cannot contain whitespace');
        }

        //currency
        if(!isset($config['currency'])) {
            throw new InvalidArgumentException('currency is required');
        }

        if($config['currency'] !== null && !\is_string($config['currency'])) {
            throw new InvalidArgumentException('currency must be null or string');
        }

        if($config['currency'] !== null && $config['currency'] === '') {
            throw new InvalidArgumentException('currency cannot be the empty string');
        }

        if($config['currency'] !== null && (\preg_match('/\s/', $config['currency']))) {
            throw new InvalidArgumentException('currency cannot contain whitespace');
        }

        //oid
        if(!isset($config['oid'])) {
            throw new InvalidArgumentException('oid is required');
        }

        if($config['oid'] !== null && !\is_string($config['oid'])) {
            throw new InvalidArgumentException('oid must be null or string');
        }

        if($config['oid'] !== null && $config['oid'] === '') {
            throw new InvalidArgumentException('oid cannot be the empty string');
        }

        if($config['oid'] !== null && (\preg_match('/\s/', $config['oid']))) {
            throw new InvalidArgumentException('oid cannot contain whitespace');
        }

        //okUrl
        if(!isset($config['okUrl'])) {
            throw new InvalidArgumentException('okUrl is required');
        }

        if($config['okUrl'] !== null && !\is_string($config['okUrl'])) {
            throw new InvalidArgumentException('okUrl must be null or string');
        }

        if($config['okUrl'] !== null && $config['okUrl'] === '') {
            throw new InvalidArgumentException('okUrl cannot be the empty string');
        }

        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$config['okUrl'])) {
            throw new InvalidArgumentException('okUrl Invalid URL');
        }

        //failUrl
        if(!isset($config['failUrl'])) {
            throw new InvalidArgumentException('failUrl is required');
        }

        if($config['failUrl'] !== null && !\is_string($config['failUrl'])) {
            throw new InvalidArgumentException('failUrl must be null or string');
        }

        if($config['failUrl'] !== null && $config['failUrl'] === '') {
            throw new InvalidArgumentException('failUrl cannot be the empty string');
        }
        
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$config['failUrl'])) {
            throw new InvalidArgumentException('failUrl Invalid URL');
        }

        //lang
        if(!isset($config['lang'])) {
            throw new InvalidArgumentException('lang is required');
        }

        if($config['lang'] !== null && !\is_string($config['lang'])) {
            throw new InvalidArgumentException('lang must be null or string');
        }

        if($config['lang'] !== null && $config['lang'] === '') {
            throw new InvalidArgumentException('lang cannot be the empty string');
        }

        if($config['lang'] !== null && (\preg_match('/\s/', $config['lang']))) {
            throw new InvalidArgumentException('currency cannot contain whitespace');
        }

        if(!in_array($config['lang'], self::LANGUES)) {
            throw new InvalidArgumentException('you should choose between fr, ar or en');
        }

        //email
        if(!isset($config['email'])) {
            throw new InvalidArgumentException('email is required');
        }

        if($config['email'] !== null && !\is_string($config['email'])) {
            throw new InvalidArgumentException('email must be null or string');
        }

        if($config['email'] !== null && $config['email'] === '') {
            throw new InvalidArgumentException('email cannot be the empty string');
        }

        if($config['email'] !== null && (\preg_match('/\s/', $config['email']))) {
            throw new InvalidArgumentException('email cannot contain whitespace');
        }

        if (!filter_var($config['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email format');
        }

        //BillToName
        if(!isset($config['BillToName'])) {
            throw new InvalidArgumentException('BillToName is required');
        }

        if($config['BillToName'] !== null && !\is_string($config['BillToName'])) {
            throw new InvalidArgumentException('BillToName must be null or string');
        }

        if($config['BillToName'] !== null && $config['BillToName'] === '') {
            throw new InvalidArgumentException('BillToName cannot be the empty string');
        }

        //hashAlgorithm
        if(!isset($config['hashAlgorithm'])) {
            throw new InvalidArgumentException('hashAlgorithm is required');
        }

        if($config['hashAlgorithm'] !== null && !\is_string($config['hashAlgorithm'])) {
            throw new InvalidArgumentException('hashAlgorithm must be null or string');
        }

        if($config['hashAlgorithm'] !== null && $config['hashAlgorithm'] === '') {
            throw new InvalidArgumentException('hashAlgorithm cannot be the empty string');
        }

        if($config['hashAlgorithm'] !== null && (\preg_match('/\s/', $config['hashAlgorithm']))) {
            throw new InvalidArgumentException('hashAlgorithm cannot contain whitespace');
        }
    }

    /**
     * Generate Hash to make redirection to CMI page
     * 
     * @return string hash
     */
    public function generateHash($storeKey)
    {
        // amount|BillToCompany|BillToName|callbackUrl|clientid|currency|email|failUrl|hashAlgorithm|lang|okurl|rnd|storetype|TranType|storeKey

        $cmiParams = $this->requireOpts;
        $postParams = array_keys($cmiParams);
        natcasesort($postParams);
        $hashval = "";
        foreach ($postParams as $param){

            $paramValue = trim($cmiParams[$param]);
            $escapedParamValue = str_replace("|", "\\|", str_replace("\\", "\\\\", $paramValue));

            $lowerParam = strtolower($param);
            if($lowerParam != "hash" && $lowerParam != "encoding" )	{
                $hashval = $hashval . $escapedParamValue . "|";
            }
        }
        $escapedStoreKey = str_replace("|", "\\|", str_replace("\\", "\\\\", $storeKey));
        $hashval = $hashval . $escapedStoreKey;

        $calculatedHashValue = hash('sha512', $hashval);
        $hash = base64_encode (pack('H*',$calculatedHashValue));

        return $hash;
    }

    public function __get($name)
    {
        return $this->requireOpts[$name];
    }

    public function __set($name, $value)
    {
        $this->requireOpts[$name] = $value;
    }
}