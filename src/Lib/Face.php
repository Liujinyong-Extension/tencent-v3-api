<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/3/7
     * Time: 2:11 上午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use Liujinyong\TencentV3Api\Exception\HttpException;
    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;
    use think\Exception;

    class Face extends Common
    {

        protected $host = "https://iai.tencentcloudapi.com";

        public function __construct($secretId = "", $secretKey = "")
        {
            if ($secretId == "" || $secretKey == "" ) {
                throw new InvalidSettingParam("配置参数为空");
            }
            $option = [
                'host'=>'iai.tencentcloudapi.com',
                'version'=>'2020-03-03',
                'region'=>'ap-beijing',
                'service'=>'iai',
            ];
            parent::__construct($secretId, $secretKey,$option);
        }

        /**
         * @param string $userId   用户ID
         * @param string $imageUrl 用户人脸照片
         *
         * @return mixed
         *  【验证用户人脸】
         * author Brahma
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         */
        public function VerifyFace(string $userId, string $imageUrl)
        {
            $payload = [
                "PersonId" => (string)$userId,
                "Url"      => $imageUrl,
            ];
            try {
                $res = $this->httpClient->post($this->host, [
                    'json'    => $payload,
                    'headers' => $this->paramClass->header("VerifyFace", json_encode($payload))
                ]);
            } catch (Exception $e) {
                throw new HttpException($e->getMessage(), $e->getCode(), $e);
            }

            return json_decode($res->getBody()->getContents(), 1);
        }
    }