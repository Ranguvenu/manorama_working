<?php

namespace Database\Seeders;

use App\Models\MasterData\Taxonomy;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'lead_category' => [
                'marketing' => [
                    'name' => 'Marketing Lead',
                    'slug' => 'marketing',
                    'code' => 'marketing',
                    'meta' => [
                        'singular' => 'Marketing Lead',
                        'plural' => 'Marketing Leads',
                        'add' => true,
                        'new' => 'Add Marketing Lead',
                        'edit' => 'Edit Marketing Lead',
                        'canupload' => true,
                        'upload' => 'Upload Marketing Leads',
                    ],
                    'editable' => false,
                ],
                'callback' => [
                    'name' => 'Callback Request',
                    'slug' => 'callback',
                    'code' => 'callback',
                    'meta' => [
                        'singular' => 'Callback Request',
                        'plural' => 'Callback Requests',
                        'add' => false,
                        'edit' => 'Edit Callback Request',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'registered' => [
                    'name' => 'Registered Users',
                    'slug' => 'registered',
                    'code' => 'registered',
                    'meta' => [
                        'singular' => 'Registered User',
                        'plural' => 'Registered Users',
                        'add' => false,
                        'edit' => 'Edit Registered User',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],
            'user_type' => [
                'staff' => [
                    'name' => 'Internal Staff',
                    'slug' => 'staff',
                    'code' => 'staff',
                    'meta' => [
                        'singular' => 'Internal Staff',
                        'plural' => 'Internal Staff',
                        'add' => true,
                        'new' => 'Add Internal Staff',
                        'edit' => 'Edit Internal Staff',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'subscribers' => [
                    'name' => 'Registered Users',
                    'slug' => 'subscribers',
                    'code' => 'subscriber',
                    'meta' => [
                        'singular' => 'Registered User',
                        'plural' => 'Registered Users',
                        'add' => false,
                        'new' => 'Add User',
                        'edit' => 'Edit User',
                        'canupload' => true,
                        'upload' => 'Upload Users',
                    ],
                    'editable' => false,
                ],
            ],
            'package_type' => [
                'course' => [
                    'name' => 'Course',
                    'slug' => 'course',
                    'code' => 'course',
                    'meta' => [
                        'singular' => 'course',
                        'plural' => 'courses',
                        'add' => false,
                        'new' => 'Add Course',
                        'edit' => 'Edit Course',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'test' => [
                    'name' => 'Test',
                    'slug' => 'test',
                    'code' => 'test',
                    'meta' => [
                        'singular' => 'Test',
                        'plural' => 'Tests',
                        'add' => false,
                        'new' => 'Add Test',
                        'edit' => 'Edit Test',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],
            'blog_type' => [
                'article' => [
                    'name' => 'Article',
                    'slug' => 'article',
                    'code' => 'article',
                    'meta' => [
                        'singular' => 'Article',
                        'plural' => 'Articles',
                        'add' => false,
                        'new' => 'Add Article',
                        'edit' => 'Edit Article',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'current-affair' => [
                    'name' => 'Current Affair',
                    'slug' => 'current-affair',
                    'code' => 'current-affair',
                    'meta' => [
                        'singular' => 'Current Affair',
                        'plural' => 'Current Affairs',
                        'add' => false,
                        'new' => 'Add Current Affair',
                        'edit' => 'Edit Current Affair',
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],
            'payment_type' => [
                'free' => [
                    'name' => 'Free',
                    'slug' => 'free',
                    'code' => 'free',
                    'meta' => [
                        'singular' => 'Free',
                        'plural' => 'Free',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'paid' => [
                    'name' => 'Paid',
                    'slug' => 'paid',
                    'code' => 'paid',
                    'meta' => [
                        'singular' => 'Paid',
                        'plural' => 'Paid',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],
            'hierarchy_type' => [
                'goal' => [
                    'name' => 'Goal',
                    'slug' => 'goal',
                    'code' => 'goal',
                    'meta' => [
                        'singular' => 'Goal',
                        'plural' => 'Goals',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'board' => [
                    'name' => 'Board',
                    'slug' => 'board',
                    'code' => 'board',
                    'meta' => [
                        'singular' => 'Board',
                        'plural' => 'Boards',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'class' => [
                    'name' => 'Class',
                    'slug' => 'class',
                    'code' => 'class',
                    'meta' => [
                        'singular' => 'Class',
                        'plural' => 'Classes',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'course' => [
                    'name' => 'Course',
                    'slug' => 'course',
                    'code' => 'course',
                    'meta' => [
                        'singular' => 'course',
                        'plural' => 'Courses',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],

            'batch_provider' => [
                'tutor_waves' => [
                    'name' => 'Tutor Waves',
                    'slug' => 'tutor_waves',
                    'code' => 'tutor_waves',
                    'meta' => [
                        'singular' => 'Tutor Wave',
                        'plural' => 'Tutor Waves',
                        'add' => false,
                        'new' => false,
                        'edit' => true,
                        'canupload' => false,
                    ],
                    'editable' => true,
                ],
                'ias' => [
                    'name' => 'IAS',
                    'slug' => 'ias',
                    'code' => 'ias',
                    'meta' => [
                        'singular' => 'IAS',
                        'plural' => 'IAS',
                        'add' => false,
                        'new' => false,
                        'edit' => true,
                        'canupload' => false,
                    ],
                    'editable' => true,
                ],
                'ca' => [
                    'name' => 'CA',
                    'slug' => 'ca',
                    'code' => 'ca',
                    'meta' => [
                        'singular' => 'CA',
                        'plural' => 'CA',
                        'add' => false,
                        'new' => false,
                        'edit' => true,
                        'canupload' => false,
                    ],
                    'editable' => true,
                ],
                'merit_nation' => [
                    'name' => 'Merit Nation',
                    'slug' => 'merit_nation',
                    'code' => 'merit_nation',
                    'meta' => [
                        'singular' => 'Merit Nation',
                        'plural' => 'Merit Nations',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],
            'lead_source' => [
                'callback_request' => [
                    'name' => 'Callback Requests',
                    'slug' => 'callback_request',
                    'code' => 'callback_request',
                    'meta' => [
                        'singular' => 'Callback Request',
                        'plural' => 'Callback Requests',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'downloadable_resources' => [
                    'name' => 'Downloadable Resources',
                    'slug' => 'downloadable_resources',
                    'code' => 'downloadable_resources',
                    'meta' => [
                        'singular' => 'Downloadable Resources',
                        'plural' => 'Downloadable Resources',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
                'website_registration' => [
                    'name' => 'Website Registration',
                    'slug' => 'website_registration',
                    'code' => 'website_registration',
                    'meta' => [
                        'singular' => 'Website Registration',
                        'plural' => 'Website Registrations',
                        'add' => false,
                        'new' => false,
                        'edit' => false,
                        'canupload' => false,
                    ],
                    'editable' => false,
                ],
            ],
        ];
        foreach ($categories as $key => $category) {
            $taxonomy = Taxonomy::findOrFail($key);
            if ($taxonomy) {
                foreach ($category as $index => $value) {
                    $taxonomy->categories()->updateOrCreate([
                        'slug' => $index,
                    ], $value);
                }
            }
        }
    }
}
