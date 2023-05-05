<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2023/5/5
     * Time: 13:50
     */

    namespace Liujinyong\TencentV3Api\Lib;

    use Liujinyong\TencentV3Api\Exception\InvalidArgumentException;
    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

    class Ocr extends Common
    {
        protected $host = "https://ocr.tencentcloudapi.com";

        public function __construct($secretId = "", $secretKey = "")
        {
            if ($secretId == "" || $secretKey == "") {
                throw new InvalidSettingParam("配置参数为空");
            }
            $option = [
                'host'    => 'ocr.tencentcloudapi.com',
                'version' => '2018-11-19',
                'region'  => 'ap-beijing',
                'service' => 'ocr',
            ];
            parent::__construct($secretId, $secretKey, $option);
        }

        /**
         * @param $ImageUrl
         *  ocr名片识别接口
         * @return mixed
         * author Brahma
         * BusinessCardOCR
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         * @throws \Liujinyong\TencentV3Api\Exception\InvalidArgumentException
         */
        public function BusinessCardOCR($ImageUrl = "")
        {
            if ($ImageUrl == "") {
                throw new InvalidArgumentException("Invalid type of param");
            }
            $payload = [
                "ImageUrl" => $ImageUrl,
            ];

            return $this->tryCurl("BusinessCardOCR", $payload);

        }


    }