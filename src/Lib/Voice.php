<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/5/27
     * Time: 19:54
     */

    namespace Liujinyong\TencentV3Api\Lib;

    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

    class Voice extends Common
    {
        protected $host = "https://tts.tencentcloudapi.com";

        public function __construct($secretId = "", $secretKey = "")
        {
            if ($secretId == "" || $secretKey == "") {
                throw new InvalidSettingParam("配置参数为空");
            }
            $option = [
                'host'    => 'tts.tencentcloudapi.com',
                'version' => '2019-08-23',
                'region'  => 'ap-beijing',
                'service' => 'tts',
            ];
            parent::__construct($secretId, $secretKey, $option);
        }
        public function TextToVoice($text = "",$SessionId = null)
        {
            $payload = [
                "Text" => $text,
                "SessionId"      => (string)$SessionId,
                "Codec"      => 'mp3',
            ];
            //var_dump($payload);die();
            return $this->tryCurl("TextToVoice",$payload);
        }

    }