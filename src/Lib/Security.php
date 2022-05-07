<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Jack
     * Date: 2022/4/24
     * Time: 23:21
     */

    namespace Liujinyong\TencentV3Api\Lib;

    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

    class Security extends Common
    {

        protected $host = "https://vm.tencentcloudapi.com";

        public function __construct($secretId = "", $secretKey = "")
        {
            if ($secretId == "" || $secretKey == "") {
                throw new InvalidSettingParam("配置参数为空");
            }
            $option = [
                'host'    => 'vm.tencentcloudapi.com',
                'version' => '2020-12-29',
                'region'  => 'ap-beijing',
                'service' => 'vm',
            ];
            parent::__construct($secretId, $secretKey, $option);
        }

        /**
         * @param $steamName
         * @param $pullUrl
         * @param $bizType
         * @param $callBackUrl
         * 创建视频审核任务
         * @return mixed
         * author Fox
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         */
        public function createVideoSecurityTask($steamName, $pullUrl,$bizType,$callBackUrl ="")
        {
            $payload = [
                "Type"    => "LIVE_VIDEO",
                "Tasks"   => [
                   [
                       "DataId" => $steamName,
                       "Input"  => [
                           "Type" => "URL",
                           "Url"  => $pullUrl
                       ]
                   ]
                ],
                "BizType" => $bizType,
            ];
            if ($callBackUrl != ""){
                $payload["CallbackUrl"] = $callBackUrl;
            }

            return $this->tryCurl("CreateVideoModerationTask", $payload);

        }

        /**
         * @param $taskId
         *  取消视频内容安全监控
         * @return mixed
         * author Fox
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         */
        public function cancelTask($taskId)
        {
            $payload = [
                "TaskId"    => $taskId,
            ];
            return $this->tryCurl("CancelTask",$payload);
        }
    }