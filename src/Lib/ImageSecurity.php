<?php

namespace Liujinyong\TencentV3Api\Lib;

use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

class ImageSecurity extends Common
{
    protected $host = "https://ims.tencentcloudapi.com";

    public function __construct($secretId = "", $secretKey = "")
    {
        if ($secretId == "" || $secretKey == "") {
            throw new InvalidSettingParam("配置参数为空");
        }
        $option = [
            'host'    => 'ims.tencentcloudapi.com',
            'version' => '2020-12-29',
            'region'  => 'ap-guangzhou',
            'service' => 'ims',
        ];
        parent::__construct($secretId, $secretKey, $option);
    }

    /**
     * @param $CallbackUrl
     * @param $FileUrl
     * @param $DataId
     * @return mixed
     * @throws \Liujinyong\TencentV3Api\Exception\HttpException
     * 图片内容审核 异步
     */
    public function check($CallbackUrl = "", $FileUrl = "", $DataId = "")
    {
        $payload = [
            "CallbackUrl" => $CallbackUrl,
            "FileUrl"     => $FileUrl
        ];
        if ($DataId != "") $payload['DataId'] = $DataId;

        return $this->tryCurl("CreateImageModerationAsyncTask", $payload);
    }

    /**
     * @param $FileUrl
     * @param $DataId
     * @return mixed
     * @throws \Liujinyong\TencentV3Api\Exception\HttpException
     * 图片内容审核 同步
     */
    public function checkSync( $FileUrl = "", $DataId = "")
    {
        $payload = [
            "FileUrl"     => $FileUrl
        ];
        if ($DataId != "") $payload['DataId'] = $DataId;

        return $this->tryCurl("ImageModeration", $payload);
    }
}