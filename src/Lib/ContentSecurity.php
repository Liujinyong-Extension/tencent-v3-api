<?php

namespace Liujinyong\TencentV3Api\Lib;

use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

class ContentSecurity extends Common
{
    protected $host = "https://tms.tencentcloudapi.com";

    public function __construct($secretId = "", $secretKey = "")
    {
        if ($secretId == "" || $secretKey == "" ) {
            throw new InvalidSettingParam("配置参数为空");
        }
        $option = [
            'host'=>'tms.tencentcloudapi.com',
            'version'=>'2020-12-29',
            'region'=>'ap-guangzhou',
            'service'=>'tms',
        ];
        parent::__construct($secretId, $secretKey,$option);
    }

    /**
     * @param string $content
     * @param string $BizType
     * @return mixed
     * @throws \Liujinyong\TencentV3Api\Exception\HttpException
     * 校验文本内容
     */
    public function check(string $content, string $BizType = "")
    {
        $payload = [
            "Content" => base64_encode($content)
        ];
        if ($BizType != "") $payload['BizType'] = $BizType;

        return $this->tryCurl("TextModeration",$payload);
    }
}