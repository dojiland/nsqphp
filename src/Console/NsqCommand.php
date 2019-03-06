<?php

namespace Per3evere\Nsq\Console;

use Illuminate\Console\Command;
use Per3evere\Nsq\Subscribe;

class NsqCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'nsq';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '启动 NSQ 监听服务.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach (config('nsq.subscribes') as $subscribe) {
            $subscribe = $this->laravel->make($subscribe);

            if ($subscribe instanceof Subscribe) {
                $subscribe->execute();
            }
        }

        app('nsq')->run();
    }
}