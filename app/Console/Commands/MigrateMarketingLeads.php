<?php

namespace App\Console\Commands;

use App\Imports\DataMigrations\LeadsMigration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MigrateMarketingLeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-marketing-leads';

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
        Log::channel('migration')->info('---------------Marketing Leads--------------------------------');
        $folderPath = public_path('migrationdata/leads/data'); // Replace with the actual path to your folder
        $uploadedFolderPath = public_path('migrationdata/leads/completed');
        $files = File::files($folderPath);
        foreach ($files as $key => $file) {
            Log::channel('migration')->info('********************************************************');
            Log::channel('migration')->info('Import Started From '.$file);
            try {
                $this->info('Import Started from '.$file);
                $import = new LeadsMigration();
                $import->import($file);
                $data = $this->format_error_data($import->failed_imports) + $this->format_imported_data($import->imported);
                $total = sizeof($data);
                $completed = sizeof($import->imported);
                Log::channel('migration')->info('Total Records in the csv '.$total);
                Log::channel('migration')->info('Total Records Imported from csv '.$completed);
                // Log::channel('migration')->info('--------------FailedImports----------------------------');
                // Log::channel('migration')->info(serialize($this->format_error_data($import->failed_imports)));
                // Log::channel('migration')->info('--------------FailedImports----------------------------');
                $this->info('Total Imported Data '.$completed);
                $this->info('Import Completed from '.$file);
                $index = $key + 1;
                File::move($file, $uploadedFolderPath.'/marketing_leads_uploaded_'.$index.'.csv');
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                $errors = [];
                foreach ($failures as $failure) {
                    $errors[$failure->row()][$failure->attribute()] = $failure->errors()[0];
                }

                Log::info(serialize($errors));
            }

            Log::channel('migration')->info('Import From '.$file.' Is Completed');
        }
        Log::channel('migration')->info('---------------Marketing Leads--------------------------------');
    }

    public function format_error_data($data)
    {
        $response = [];
        foreach ($data as $key => $value) {
            $response[$value->row()]['has_errors'] = true;
            $response[$value->row()]['row'] = $value->row();
            $response[$value->row()]['values'] = $value->values();
            $response[$value->row()]['errors'][$value->attribute()] = $value->errors();
        }

        return $response;
    }

    public function format_imported_data($data)
    {
        $response = [];
        foreach ($data as $key => $value) {
            $response[$value['row']]['has_errors'] = $value['has_errors'];
            $response[$value['row']]['row'] = $value['row'];
            $response[$value['row']]['values'] = $value['values'];
            $response[$value['row']]['errors'] = $value['errors'];
        }

        return $response;
    }
}
