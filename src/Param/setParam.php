<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Param
     * User: Brahma
     * Date: 2022/2/23
     * Time: 10:38 上午
     */

    namespace Liujinyong\TencentV3Api\Param;


    class setParam
    {
        protected $secretId  = "";
        protected $secretKey = "";
        protected $timeStamp = null;

        const HOST    = "iai.tencentcloudapi.com";
        const VERSION = "2020-03-03";
        const REGION  = "ap-beijing";
        const SERVICE = "iai";

        public function __construct()
        {

            $this->secretId  = "XXXXXXXXXXX";
            $this->secretKey = "XXXXXXXXXXX";
            $this->timeStamp = time();

        }

        public function Authorization($payload)
        {
            $algorithm = "TC3-HMAC-SHA256";

            $httpRequestMethod    = "POST";
            $canonicalUri         = "/";
            $canonicalQueryString = "";
            $canonicalHeaders     = "content-type:application/json; charset=utf-8\n" . "host:" . self::HOST . "\n";
            $signedHeaders        = "content-type;host";

            $hashedRequestPayload   = hash("SHA256", $payload);
            $canonicalRequest       = $httpRequestMethod . "\n" . $canonicalUri . "\n" . $canonicalQueryString . "\n" . $canonicalHeaders . "\n" . $signedHeaders . "\n" . $hashedRequestPayload;
            $date                   = gmdate("Y-m-d", $this->timeStamp);
            $credentialScope        = $date . "/" . self::SERVICE . "/tc3_request";
            $hashedCanonicalRequest = hash("SHA256", $canonicalRequest);
            $stringToSign           = $algorithm . "\n" . $this->timeStamp . "\n" . $credentialScope . "\n" . $hashedCanonicalRequest;

            $secretDate    = hash_hmac("SHA256", $date, "TC3" . $this->secretKey, true);
            $secretService = hash_hmac("SHA256", self::SERVICE, $secretDate, true);
            $secretSigning = hash_hmac("SHA256", "tc3_request", $secretService, true);
            $signature     = hash_hmac("SHA256", $stringToSign, $secretSigning);
            $authorization = $algorithm . " Credential=" . $this->secretId . "/" . $credentialScope . ", SignedHeaders=content-type;host, Signature=" . $signature;

            return $authorization;
        }

        public function header($action, $payload)
        {
            return [
                'Authorization'  => $this->Authorization($payload),
                'Content-Type'   => 'application/json; charset=utf-8',
                'Host'           => self::HOST,
                'X-TC-Action'    => $action,
                'X-TC-Timestamp' => $this->timeStamp,
                'X-TC-Version'   => self::VERSION,
                'X-TC-Region'    => self::REGION
            ];
        }
    }