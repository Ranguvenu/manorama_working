<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\DataMigrations\TempMmPackages;

class MmPackageMigations extends Command
{
    private $client;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mm-package-migations {package_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'package_id' => $this->argument('package_id'),
        ];
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
        $payload = [];

        $token = '3I563ghDI5V';
        $payload['headers'] = [
            'MIGRATEAPI' => 'ZTPLBUUSPZ',
            'Authorization' => 'Bearer '.$token,
        ];
        $packageid = $data['package_id'];
        $url = "https://api.manoramahorizon.com/payment_package/package-data-detail?package_id=".$packageid;

        $post = $this->client->request('POST',
        $url,
        $payload);

        $response = ($post->getStatusCode() == 200) ? json_decode($post->getBody(), true) : false;
        if ($response) {
            $cresponse = $response['response']['package_details'];
            $packageid = $cresponse['id'];
            $contents = $response['response']['package_details']['content'];
            foreach($contents as $content) {
                $mcourseid = $content['master_course'];
                if (!empty($mcourseid)) {
                    $data = [
                        'packageid' => $packageid,
                        'subjectid' => $mcourseid['subject'],
                        'mastercourseid' => $mcourseid['master_course_id'],
                    ];
    
                    TempMmPackages::create($data);
                    $this->info("Data is inserted having packageid ". $packageid .", subject ".$data['subjectid']." and mastercourseid ".$mcourseid['master_course_id']);
                }
            } 
        } else {
            $this->info("No Data Available");
        }

    }
}
