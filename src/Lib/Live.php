<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/4/9
     * Time: 3:55 下午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;

    class Live extends Common
    {
        use \Liujinyong\TencentV3Api\Lib\common\Live;

        protected $pushUrl = "";
        protected $pullUrl = "";

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
            if ($this -> pullUrl == "") {
                $this -> pullUrl = $pullUrl;
            }
            parent::__construct($secretId, $secretKey);
        }

    }