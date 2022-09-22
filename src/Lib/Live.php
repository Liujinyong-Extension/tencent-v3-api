<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/4/9
     * Time: 21:55 下午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use Liujinyong\TencentV3Api\Exception\HttpException;
    use Liujinyong\TencentV3Api\Exception\InvalidArgumentException;
    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

    class Live extends Common
    {
        use \Liujinyong\TencentV3Api\Lib\common\Live;

        protected $pushUrl = "";
        protected $pullUrl = "";
        protected $host    = "https://live.tencentcloudapi.com";


        /**
         * Live constructor.
         *
         * @param string $secretId  密钥ID
         * @param string $secretKey 密钥Key
         * @param string $pushUrl   推流地址
         * @param string $pullUrl   拉流地址
         */
        public function __construct($secretId = "", $secretKey = "", $pushUrl = "", $pullUrl = "")
        {
            if ($secretId == "" || $secretKey == "" || $pushUrl == "" || $pullUrl == "") {
                throw new InvalidSettingParam("配置参数为空");
            }
            if ($this->pushUrl == "") {
                $this->pushUrl = $pushUrl;
            }
            if ($this->pullUrl == "") {
                $this->pullUrl = $pullUrl;
            }
            $option = [
                'host'    => 'live.tencentcloudapi.com',
                'version' => '2018-08-01',
                'region'  => 'ap-guangzhou',
                'service' => 'live',
            ];
            parent::__construct($secretId, $secretKey, $option);
        }

        /**
         * @param string $streamName 流名称
         * @param string $domainName 推流域名
         * @param string $appName    推流路径
         * @param int    $endTime    结束时间
         *
         * @return mixed
         * 创建直播录制任务
         * author Brahma
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         */
        public function createRecordTask($streamName = "", $domainName = "", $appName = "", $endTime = 0)
        {
            if ($streamName == "" || $domainName == "" || $appName == "" || $endTime == 0) {
                throw new InvalidArgumentException("参数有无,请重新检查");
            }
            $payload = [
                'StreamName' => $streamName,
                'DomainName' => $domainName,
                'AppName'    => $appName,
                'EndTime'    => $endTime
            ];

            return $this->tryCurl("CreateRecordTask",$payload);
        }

        /**
         * @param string $taskId 直播任务ID
         *
         * @return mixed
         * 终止直播任务 并生产录制文件
         * author Brahma
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         * @throws \Liujinyong\TencentV3Api\Exception\InvalidArgumentException
         */
        public function stopRecordTask($taskId = "")
        {
            if ($taskId == "") {
                throw new InvalidArgumentException("taskId必须");
            }
            $payload = [
                'TaskId' => $taskId,
            ];
            return $this->tryCurl("StopRecordTask",$payload);

        }

        /**
         * @param string $taskId 直播任务
         *
         * @return mixed
         *  删除直播任务 当前推流不受影响 结束后生产录制文件，但该任务不会在启用
         * author Brahma
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         * @throws \Liujinyong\TencentV3Api\Exception\InvalidArgumentException
         */
        public function deleteRecordTask($taskId = "")
        {
            if ($taskId == "") {
                throw new InvalidArgumentException("taskId必须");
            }
            $payload = [
                'TaskId' => $taskId,

            ];
            return $this->tryCurl("DeleteRecordTask",$payload);

        }

        /**
         * @param $StreamName string 流名称
         *  精准查询流信息
         * @return mixed
         * author Fox
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         * @throws \Liujinyong\TencentV3Api\Exception\InvalidArgumentException
         */
        public function DescribeStreamPlayInfoList($StreamName = "")
        {
            if ($StreamName == "") {
                throw new InvalidArgumentException("StreamName必须");
            }
            $payload = [
                'StreamName' => $StreamName,
                'StartTime' => date('Y-m-d H:i:00',time()),
                'EndTime' => date('Y-m-d H:i:00',time()+60),

            ];
            return $this->tryCurl("DescribeStreamPlayInfoList",$payload);
        }

    }