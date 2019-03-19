<?php

namespace Per3evere\Nsq\Logger;

use Illuminate\Support\Facades\Log;

class LaravelLogger implements LoggerInterface
{
    /**
     * Log error
     *
     * @param string|\Exception $msg
     */
    public function error($msg)
    {
        Log::error($msg);
    }

    /**
     * Log warn
     *
     * @param string|\Exception $msg
     */
    public function warn($msg)
    {
        Log::warning($msg);
    }

    /**
     * Log info
     *
     * @param string|\Exception $msg
     */
    public function info($msg)
    {
        Log::info($msg);
    }

    /**
     * Log debug
     *
     * @param string|\Exception $msg
     */
    public function debug($msg)
    {
        Log::debug($msg);
    }
}
