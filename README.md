<h1 align="center"> tencent-v3-api </h1>

<p align="center"> base on tencent-api V3 version.</p>

## 安装

```shell
$ composer require liujinyong/tencent-v3-api 
```

## 配置

``
在使用本扩展之前，请先注册腾讯云账号，获取secretId和secretKey,及创建相应的人员库.
``

```php
<?php

  require __DIR__ . '/vendor/autoload.php';

    $secretId  = "";
    $secretKey = "";
    $userHearderImg = "";
    $groupId = "";
    $pushUrl = "";
    $pullUrl = ""
    $key = "";
    //创建人员库
    $people    = new \Liujinyong\TencentV3Api\Lib\People($secretId, $secretKey);
    $res       = $people->CreatePerson("user1", "26", $userHearderImg, $groupId);
    
    //删除人员库
    $res       = $people->DeletePersonFromGroup("26", $groupId);
    
    //验证人脸
    $face = new \Liujinyong\TencentV3Api\Lib\Face($secretId, $secretKey);
    $res = $face->VerifyFace("user1", $userHearderImg);
    
    //获取直播推拉流地址
    $live = new \Liujinyong\TencentV3Api\Lib\Live($secretId,$secretKey,$pushUrl,$pullUrl);
    $res = $live->getLiveUrl("live","ceshi1",$key,"2022-04-10 17:33:00",true);
    
    //创建直播录制任务
    $res = $live->createRecordTask("luzhi",$pushUrl,"live",1649732129);
    
    
    //根据流名称查询在线人数
    $res = $live->DescribeStreamPlayInfoList("aaa");
    
    //终止直播录制任务
    $taskId = "";
    $res = $live->stopRecordTask($taskId);
    
    //创建视频审核任务
    $callBack = "";
    $bizType = "";
    $security = new \Liujinyong\TencentV3Api\Lib\Security($secretId,$secretKey);
    $res = $security->createVideoSecurityTask("bbb",$pullUrl,$bizType,$callBack);
    
    //终止视频审核任务
    $taskIdforVideo = "";
    $res = $security->cancelTask($taskIdforVideo);
    
  

```



## Usage

1.在config文件里添加secretId和secretKey配置项

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/liujinyong/tencent-v3-api/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/liujinyong/tencent-v3-api/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT