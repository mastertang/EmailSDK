<?php
include "../driver/Mailer.php";
include "../EmailSDK.php";

// 发送邮件
$result = (new \EmailSDK\EmailSDK())
    ->setConfig(
        "xxx.xxx.xxx",
        465,
        "test",
        "123456"
    )->sendEmail(
        "标题",
        ["xxxx@xx.com" => "sendFrom"],
        ["xxxx@xx.com" => "sendTo"],
        "内容",
        $errorMessage,
        $failedRecipients,
        ["xxxx@xx.com" => "bcc"],
        ["xxxx@xx.com" => "cc"],
        ["xxxx@xx.com" => "relayTo"]
    );

if ($result === false) {
    var_dump($errorMessage);
    var_dump($failedRecipients);
}
var_dump($result);