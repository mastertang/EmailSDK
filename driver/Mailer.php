<?php

namespace EmailSDK\driver;

/**
 * Class Mailer
 * @package EmailSDK\driver
 */
class Mailer
{
    /**
     * @var string 邮箱服务器
     */
    protected $server = "";

    /**
     * @var string 邮箱端口
     */
    protected $serverPort = "";

    /**
     * @var string 姓名
     */
    protected $username = "";

    /**
     * @var string 密码
     */
    protected $password = "";

    /**
     * @var string 邮件标题
     */
    protected $emailTitle = "";

    /**
     * @var array 发送邮件地址
     */
    protected $sendFrom = [];

    /**
     * @var array 接收邮件地址
     */
    protected $sendTo = [];

    /**
     * @var array bcc地址
     */
    protected $bcc = [];

    /**
     * @var array cc地址
     */
    protected $cc = [];

    /**
     * @var array 延时地址
     */
    protected $replayTo = [];

    /**
     * @var array 附件
     */
    protected $attach = [];

    /**
     * @var string 邮件内容
     */
    protected $body = "";

    /**
     * @var array 邮件内容替换
     */
    protected $bodyReplace = [];

    /**
     * @var string 错误信息
     */
    public $errorMessage = "";

    /**
     * @var array 发送失败邮件地址
     */
    public $failedRecipients = [];

    /**
     * 设置邮箱服务器
     *
     * @param $serverHost
     * @return $this
     */
    public function server($serverHost)
    {
        $this->server = $serverHost;
        return $this;
    }

    /**
     * 设置服务器端口
     *
     * @param $port
     * @return $this
     */
    public function serverPort($port)
    {
        if (is_numeric($port)) {
            $this->serverPort = $port;
        }
        return $this;
    }

    /**
     * 设置用户名字
     *
     * @param $username
     * @return $this
     */
    public function username($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * 设置用户密码
     *
     * @param $password
     * @return $this
     */
    public function password($password)
    {
        $this->username = $password;
        return $this;
    }

    /**
     * 设置邮件标题
     *
     * @param $title
     * @return $this
     */
    public function emailTitle($title)
    {
        $this->emailTitle = $title;
        return $this;
    }

    /**
     * 设置发送邮箱地址
     *
     * @param $emailAddress
     * @param string $name
     * @return $this
     */
    public function sendFrom($emailAddress, $name = "")
    {
        if ($this->checkEmail($emailAddress)) {
            $this->sendFrom = [$emailAddress => $name];
        }
        return $this;
    }

    /**
     * 设置接收邮箱地址
     *
     * @param $emailAddress
     * @param string $name
     * @return $this
     */
    public function sendTo($emailAddress, $name = "")
    {
        if (is_string($emailAddress)) {
            if ($this->checkEmail($emailAddress)) {
                $this->sendTo = [$emailAddress => $name];
            }
        } else if (is_array($emailAddress)) {
            foreach ($emailAddress as $key => $name) {
                if (!$this->checkEmail($emailAddress)) {
                    unset($emailAddress[$key]);
                }
            }
            if (!empty($emailAddress)) {
                $this->sendTo = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * 设置bcc邮箱地址
     *
     * @param $emailAddress
     * @param string $name
     * @return $this
     */
    public function bcc($emailAddress, $name = "")
    {
        if (is_string($emailAddress)) {
            if ($this->checkEmail($emailAddress)) {
                $this->sendTo = [$emailAddress => $name];
            }
        } else if (is_array($emailAddress)) {
            foreach ($emailAddress as $key => $name) {
                if (!$this->checkEmail($emailAddress)) {
                    unset($emailAddress[$key]);
                }
            }
            if (!empty($emailAddress)) {
                $this->sendTo = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * 设置cc邮箱地址
     *
     * @param $emailAddress
     * @param string $name
     * @return $this
     */
    public function cc($emailAddress, $name = "")
    {
        if (is_string($emailAddress)) {
            if ($this->checkEmail($emailAddress)) {
                $this->sendTo = [$emailAddress => $name];
            }
        } else if (is_array($emailAddress)) {
            foreach ($emailAddress as $key => $name) {
                if (!$this->checkEmail($emailAddress)) {
                    unset($emailAddress[$key]);
                }
            }
            if (!empty($emailAddress)) {
                $this->sendTo = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * 设置ReplayTo邮箱地址
     *
     * @param $emailAddress
     * @param string $name
     * @return $this
     */
    public function replayTo($emailAddress, $name = "")
    {
        if (is_string($emailAddress)) {
            if ($this->checkEmail($emailAddress)) {
                $this->sendTo = [$emailAddress => $name];
            }
        } else if (is_array($emailAddress)) {
            foreach ($emailAddress as $key => $name) {
                if (!$this->checkEmail($emailAddress)) {
                    unset($emailAddress[$key]);
                }
            }
            if (!empty($emailAddress)) {
                $this->sendTo = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * 设置接收邮箱地址
     *
     * @param $emailAddress
     * @param string $name
     * @return $this
     */
    public function attach($emailAddress, $name = "")
    {
        if (is_string($emailAddress)) {
            if ($this->checkEmail($emailAddress)) {
                $this->sendTo = [$emailAddress => $name];
            }
        } else if (is_array($emailAddress)) {
            foreach ($emailAddress as $key => $name) {
                if (!$this->checkEmail($emailAddress)) {
                    unset($emailAddress[$key]);
                }
            }
            if (!empty($emailAddress)) {
                $this->sendTo = $emailAddress;
            }
        }
        return $this;
    }

    /**
     * 设置邮件内容
     *
     * @param $body
     * @return $this
     */
    public function body($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * 设置邮件替换
     *
     * @param $replaces
     * @return $this
     */
    public function bodyReplace($replaces)
    {
        if (is_array($replaces)) {
            $this->bodyReplace = $replaces;
        }
        return $this;
    }

    /**
     * 发送邮件
     *
     * @return bool
     */
    public function send()
    {
        if (empty($this->server)) {
            $this->errorMessage = "邮件服务器地址未设置!";
            return false;
        }
        if (empty($this->serverPort)) {
            $this->errorMessage = "邮件服务器端口未设置!";
            return false;
        }
        if (empty($this->username)) {
            $this->errorMessage = "邮箱用户未设置!";
            return false;
        }
        if (empty($this->password)) {
            $this->errorMessage = "邮箱用户密码未设置!";
            return false;
        }
        if (empty($this->sendFrom)) {
            $this->errorMessage = "发送人邮箱地址未设置!";
            return false;
        }
        if (empty($this->sendTo)) {
            $this->errorMessage = "接收人邮箱地址未设置!";
            return false;
        }

        $transport = (new \Swift_SmtpTransport($this->server, $this->serverPort))
            ->setUsername($this->username)
            ->setPassword($this->password);
        $mailer    = new \Swift_Mailer($transport);

        $message = (new \Swift_Message($this->emailTitle))
            ->setFrom($this->sendFrom)
            ->setTo($this->sendTo)
            ->setBody($this->body);

        if (!empty($this->bcc)) {
            $message->setBcc($this->bcc);
        }
        if (!empty($this->cc)) {
            $message->setCc($this->cc);
        }
        $result = $mailer->send($message, $failedRecipients);
        if ($result === 0) {
            $this->failedRecipients = $failedRecipients;
            return false;
        }
        return true;
    }

    /**
     * 检查邮箱地址格式
     *
     * @param $email
     * @return false|int
     */
    protected function checkEmail($email)
    {
        $pregEmail = "/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i";
        return preg_match($pregEmail, $email);

    }
}