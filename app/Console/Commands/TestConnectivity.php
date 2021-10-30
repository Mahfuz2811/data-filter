<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Throwable;

class TestConnectivity extends Command
{
    protected $signature = 'test:connection';

    protected $description = 'Test DB and Cache Connectivity';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $causes = [];

        try {
            app('cache')->connection();
        } catch (Throwable $e) {
            $causes[] = 'Cache';
        }

        try {
            app('db')->connection()->getPdo();
        } catch (Throwable $e) {
            $causes[] = 'Database';
        }

        if (count($causes) > 0) {
            echo "Unable to connect with ";
            foreach ($causes as $cause) {
                echo $cause . " ";
            }
        } else {
            echo "Looks both db and cache connection healthy";
        }
    }
}
