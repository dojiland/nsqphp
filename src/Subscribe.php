<?php

namespace Per3evere\Nsq;

use Per3evere\Nsq\Message\Message;

abstract class Subscribe
{
    /**
     * 订阅的主题.
     *
     * @var string
     */
    protected $topic;

    /**
     * 订阅的频道.
     *
     * @var string
     */
    protected $channel;

    /**
     * 监听消息回调处理
     *
     * @return void
     */
    abstract public function callback(Message $msg);

    public function execute()
    {
        app('nsq')->subscribe($this->topic, $this->channel, [$this, 'callback']);
    }
}
