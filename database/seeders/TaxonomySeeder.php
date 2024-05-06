<?php

namespace Database\Seeders;

use App\Models\MasterData\Taxonomy;
use Illuminate\Database\Seeder;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxonomies = [
            'question_source' => [
                'name' => 'Question Source',
                'slug' => 'question_source',
                'singular' => 'Question Source',
                'plural' => 'Question Sources',
                'editable' => true,
            ],
            'faq_category' => [
                'name' => 'Faq Category',
                'slug' => 'faq_category',
                'singular' => 'Faq Category',
                'plural' => 'Faq Categories',
                'editable' => true,
            ],
            'lead_source' => [
                'name' => 'Lead Source',
                'slug' => 'lead_source',
                'singular' => 'Lead Source',
                'plural' => 'Lead Sources',
                'editable' => true,
            ],
            'lead_category' => [
                'name' => 'Lead Category',
                'slug' => 'lead_category',
                'singular' => 'Lead Category',
                'plural' => 'Lead Categories',
                'editable' => false,
            ],
            'resource_type' => [
                'name' => 'Resource Type',
                'slug' => 'resource_type',
                'singular' => 'Resource Type',
                'plural' => 'Resource Types',
                'editable' => true,
            ],
            'user_category' => [
                'name' => 'User Categories',
                'slug' => 'user_category',
                'singular' => 'User Category',
                'plural' => 'User Categories',
                'editable' => true,
            ],
            'user_type' => [
                'name' => 'User Type',
                'slug' => 'user_type',
                'singular' => 'User Type',
                'plural' => 'User Types',
                'editable' => false,
            ],
            'package_type' => [
                'name' => 'Package Type',
                'slug' => 'package_type',
                'singular' => 'Package Type',
                'plural' => 'Package Types',
                'editable' => false,
            ],
            'payment_type' => [
                'name' => 'Payment Type',
                'slug' => 'payment_type',
                'singular' => 'Payment Type',
                'plural' => 'Payment Types',
                'editable' => false,
            ],
            'hierarchy_type' => [
                'name' => 'Hierarchy Type',
                'slug' => 'hierarchy_type',
                'singular' => 'Hierarchy Type',
                'plural' => 'Hierarchies',
                'editable' => false,
            ],
            'blog_type' => [
                'name' => 'Blog Type',
                'slug' => 'blog_type',
                'singular' => 'Blog Type',
                'plural' => 'Blog Types',
                'editable' => false,
            ],
            'article_category' => [
                'name' => 'Article Category',
                'slug' => 'article_category',
                'singular' => 'Article Category',
                'plural' => 'Article Categories',
                'editable' => true,
            ],
            'current-affair_category' => [
                'name' => 'Current Affair Category',
                'slug' => 'current-affair_category',
                'singular' => 'Current Affair Category',
                'plural' => 'Current Affair Categories',
                'editable' => true,
            ],
            'job_category' => [
                'name' => 'Job Category',
                'slug' => 'job_category',
                'singular' => 'Job Category',
                'plural' => 'Job Categories',
                'editable' => true,
            ],
            'webinar_category' => [
                'name' => 'Webinar Category',
                'slug' => 'webinar_category',
                'singular' => 'Webinar Category',
                'plural' => 'Webinar Categories',
                'editable' => true,
            ],
            'batch_provider' => [
                'name' => 'Batch Provider',
                'slug' => 'batch_provider',
                'singular' => 'Batch Provider',
                'plural' => 'Batch Providers',
                'editable' => false,
            ],
            'video_category' => [
                'name' => 'Video Category',
                'slug' => 'video_category',
                'singular' => 'Video Category',
                'plural' => 'Video Categories',
                'editable' => true,
            ],
        ];
        foreach ($taxonomies as $key => $taxonomy) {
            Taxonomy::updateOrCreate([
                'slug' => $key,
            ], $taxonomy);
        }
    }
}
