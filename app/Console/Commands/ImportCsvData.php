<?php

namespace App\Console\Commands;

use App\Models\UserInfo;
use Illuminate\Console\Command;

class ImportCsvData extends Command
{
    protected $signature = 'import:data';

    protected $description = 'Import data from csv file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filename = 'test-data.csv';
        $path = public_path('storage/' . $filename);
        $handle = fopen($path, 'r');
        if ($handle) {
            $count = 0;
            $header = fgetcsv($handle, 0);
            while (($line = fgetcsv($handle, 0)) !== FALSE) {

                if (empty($line[0]) || empty($line[1]))
                    continue;

                $count++;

                UserInfo::create([
                   'email' => trim($line[1]),
                   'name' => trim($line[2]),
                   'dob' => trim($line[3]),
                   'phone' => trim($line[4]),
                   'ip' => trim($line[5]),
                   'country' => trim($line[6]),
                ]);

                $output = [];
                $output[] = 'Time: ' . date('r');
                $output[] = 'Importing row count: ' . $count;
                $this->replaceCommandOutput($output);
                usleep(100);
            }

            echo "Time: " . date('r') . "\n";
            echo "Importing row count: " . $count;
        }
    }

    public function replaceCommandOutput(array $output)
    {
        static $oldLines = 0;
        $numNewLines = count($output) - 1;

        if ($oldLines == 0) {
            $oldLines = $numNewLines;
        }

        echo implode(PHP_EOL, $output);
        echo chr(27) . "[0G";
        echo chr(27) . "[" . $oldLines . "A";

        $numNewLines = $oldLines;
    }
}
