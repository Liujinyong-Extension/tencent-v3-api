<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/2/23
     * Time: 1:41 上午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use GuzzleHttp\Client;
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

    }