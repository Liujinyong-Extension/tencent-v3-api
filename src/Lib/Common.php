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

        public function __construct()
        {
            $this->paramClass = new setParam();
            $this->httpClient = new Client();
        }
    }