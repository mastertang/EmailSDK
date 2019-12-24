<?php

namespace EmailSDK;

use EmailSDK\driver\Mailer;

/**
 * Class EmailSDK
 * @package EmailSDK
 */
class EmailSDK
{
    /**
     * @var string 服务器地址
     */
    protected $server = "";

    /**
     * @var string 服务器端口
     */
    protected $port = null;

    /**
     * @var string 服务器用户名
     */
    protected $username = "";

    /**
     * @var string 服务器密码
     */
    protected $password = "";

    /**
     * 设置配置
     *
     * @param $server
     * @param $port
     * @param $username
     * @param $password
     * @return $this
     */
    public function setConfig($server, $port, $username, $password)
    {
        $this->server   = $server;
        $this->port     = $port;
        $this->username = $username;
        $this->password = $password;
        return $this;
    }

    /**
     * 重置配置
     *
     * @return $this
     */
    public function resetConfig()
    {
        $this->server   = "";
        $this->port     = null;
        $this->username = "";
        $this->password = "";
        return $this;
    }

    /**
     * 发送邮件
     *
     * @param $title
     * @param $sendFrom
     * @param $sendName
     * @param $sendTo
     * @param $body
     * @param string $errorMessage
     * @param array $failedRecipients
     * @param array $bcc
     * @param array $cc
     * @param array $relayTo
     * @return bool
     */
    public function sendEmail(
        $title,
        $sendFrom,
        $sendName,
        $sendTo,
        $body,
        &$errorMessage = "success",
        &$failedRecipients = [],
        $encryption = "tls",
        $contentType = "text/html",
        $bcc = [],
        $cc = [],
        $relayTo = []
    )
    {
        $mailer = new Mailer();
        $result = $mailer->server($this->server)
            ->serverPort($this->port)
            ->username($this->username)
            ->password($this->password)
            ->emailTitle($title)
            ->sendFrom($sendFrom, $sendName)
            ->sendTo($sendTo)
            ->body($body)
            ->bcc($bcc)
            ->cc($cc)
            ->encryption($encryption)
            ->contentType($contentType)
            ->replayTo($relayTo)
            ->send();
        if ($result === false) {
            $errorMessage     = $mailer->errorMessage;
            $failedRecipients = $mailer->failedRecipients;
            return false;
        }
        return $result;
    }
}