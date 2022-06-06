<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib\common
     * User: Brahma
     * Date: 2022/4/9
     * Time: 22:07 下午
     */

    namespace Liujinyong\TencentV3Api\Lib\common;


    trait Live
    {
        /**
         * @param string $appName    应用名称 默认live
         * @param string $streamName 流名称
         * @param null   $key        密钥
         * @param null   $time       结束推流时间
         * @param false  $https      是否开启https
         *
         * @return string[]
         *
         * author Brahma
         */
        public function getLiveUrl($appName = "live", $streamName = "", $key = null, $time = null, $https = false)
        {
            if ($key && $time) {
                $txTime   = strtoupper(base_convert(strtotime($time), 10, 16));
                $txSecret = md5($key . $streamName . $txTime);
                $ext_str  = "?" . http_build_query(array(
                                                       "txSecret" => $txSecret,
                                                       "txTime"   => $txTime
                                                   ));
            }
            $https = $https ? "https" : "http";
            $data  = [
                "push_webrtc" => "webrtc://" . $this->pushUrl . "/" . $appName . "/" . $streamName . (isset($ext_str) ? $ext_str : ""),
                "push_rtmp"   => "rtmp://" . $this->pushUrl . "/" . $appName . "/" . $streamName . (isset($ext_str) ? $ext_str : ""),
                "pull_flv"   => $https."://" . $this->pullUrl . "/" . $appName . "/" . $streamName . ".flv",
                "pull_m3u8"   => $https . "://" . $this->pullUrl . "/" . $appName . "/" . $streamName . ".m3u8",
                "pull_webrtc" => "webrtc://" . $this->pullUrl . "/" . $appName . "/" . $streamName,
            ];

            return $data;
        }

    }