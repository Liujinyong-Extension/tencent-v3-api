<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/2/23
     * Time: 21:43 上午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use Liujinyong\TencentV3Api\Exception\HttpException;
    use Liujinyong\TencentV3Api\Exception\InvalidArgumentException;
    use Liujinyong\TencentV3Api\Exception\InvalidSettingParam;
    use think\Exception;

    class People extends Common
    {
        protected $host = "https://iai.tencentcloudapi.com";


        public function __construct($secretId = "", $secretKey = "")
        {
            if ($secretId == "" || $secretKey == "") {
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
         * @param string $name     用户名
         * @param string $userId   用户id
         * @param string $imageUrl 用户图片
         * @param string $groupId  人员库ID
         *
         * @return mixed
         * 【创建人员】
         * author Brahma
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         */
        public function CreatePerson(string $name, string $userId, string $imageUrl, string $groupId)
        {
            if (!is_string($name) || !is_string($userId) || !is_string($imageUrl) || empty($name) || empty($userId) || empty($imageUrl) || !is_string($groupId) || empty($groupId)) {
                throw new InvalidArgumentException("Invalid type of param");
            }

            $payload = [
                "GroupId"    => $groupId,
                "PersonName" => $name,
                "PersonId"   => (string)$userId,
                "Url"        => $imageUrl
            ];

            return $this->tryCurl("CreatePerson",$payload);

        }

        /**
         * @param string $userId  用户ID
         * @param string $groupId 人员库ID
         *
         * @return mixed
         * 【删除人员】
         * author Brahma
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \Liujinyong\TencentV3Api\Exception\HttpException
         * @throws \Liujinyong\TencentV3Api\Exception\InvalidArgumentException
         */
        public function DeletePersonFromGroup(string $userId, string $groupId)
        {
            if (!is_string($userId) || empty($userId) || !is_string($groupId) || empty($groupId)) {
                throw new InvalidArgumentException("Invalid type of param");
            }
            $payload = [
                "PersonId" => (string)$userId,
                "GroupId"  => "security",
            ];
            return $this->tryCurl("DeletePersonFromGroup",$payload);

        }
    }
