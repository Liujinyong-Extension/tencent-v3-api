<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/2/23
     * Time: 21:41 上午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use GuzzleHttp\Client;
    use Liujinyong\TencentV3Api\Exception\HttpException;
    use Liujinyong\TencentV3Api\Param\setParam;

    class Common
    {

        protected $paramClass = null;
        protected $httpClient = null;

        public function __construct($secretId = "", $secretKey = "",$option = [])
        {
            if ($this->paramClass == null) {

                $this->paramClass = new setParam($secretId, $secretKey,$option);
            }
            if ($this->httpClient == null) {

                $this->httpClient = new Client();
            }
        }

        public function tryCurl($action,$payload = [])
        {
            try {
                $res = $this->httpClient->post($this->host, [
                    'json'    => $payload,
                    'headers' => $this->paramClass->header($action, json_encode($payload))
                ]);
            } catch (Exception $e) {
                throw new HttpException($e->getMessage(), $e->getCode(), $e);
            }

            return json_decode($res->getBody()->getContents(), 1);
        }

    }