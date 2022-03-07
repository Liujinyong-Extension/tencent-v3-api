<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\TencentV3Api\Lib
     * User: Brahma
     * Date: 2022/2/23
     * Time: 1:43 上午
     */

    namespace Liujinyong\TencentV3Api\Lib;


    use Liujinyong\TencentV3Api\Exception\HttpException;
    use Liujinyong\TencentV3Api\Exception\InvalidArgumentException;
    use think\Exception;

    class People extends Common
    {
        protected $host = "https://iai.tencentcloudapi.com";


        /**
         * @param string $name     用户名
         * @param string $userId   用户id
         * @param string $imageUrl 用户图片
         * @param string $groupId  人员库ID
         *
         * @return mixed
         *
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
            $header  = $this->paramClass->header("CreatePerson", json_encode($payload));

            try {

                $res = $this->httpClient->post($this->host, ['headers' => $header, 'json' => $payload]);

            } catch (\Exception $e) {

                throw new HttpException($e->getMessage(), $e->getCode(), $e);
            }

            return json_decode($res->getBody()->getContents(), 1);
        }

        /**
         * @param string $userId 用户ID
         * @param string $groupId 人员库ID
         *
         * @return mixed
         *
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
            try {
                $res = $this->httpClient->post($this->host, [
                    'json'    => $payload,
                    'headers' => $this->paramClass->header("DeletePersonFromGroup", json_encode($payload))
                ]);

            } catch (\Exception $e) {
                throw new HttpException($e->getMessage(), $e->getCode(), $e);
            }

            return json_decode($res->getBody()->getContents(), 1);
        }
    }
