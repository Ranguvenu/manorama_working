<?php

namespace App\Console\Commands;

use App\Models\Blog\Article;
use App\Models\Content\StudyMaterial;
use App\Models\Website\PageBuilder\Page;
use Illuminate\Console\Command;

class UpdateSeoConfiguration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-seo-configuration {type}';

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
        $type = $this->argument('type');
        $data = [];
        if ($type == 'page') {
            $data = Page::all();
        } elseif ($type == 'studymaterial') {
            $data = StudyMaterial::all();
        } elseif ($type == 'blog') {
            $data = Article::all();
        }

        foreach ($data as $key => $value) {
            if (!$value->seo_configuration) {
                $seoconfiguration = [
                    'title' => '',
                    'description' => '',
                    'card' => '',
                    'follow_links' => '',
                    'robots' => [],
                    'canonical_url' => '',
                    'schema' => '',
                    'twitter_handle' => '',
                    'keywords' => [],
                    'meta_data' => '',
                ];
            } else {
                $seoconfiguration = $value->seo_configuration;
                $seoconfiguration['meta_data'] = '';
            }
            $value->seoconfiguration = $seoconfiguration;
            $value->save();
        }
    }
}
