<?php

namespace Database\Seeders;

use App\Models\Website\PageBuilder\PageComponentType;
use Illuminate\Database\Seeder;

class PageComponentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $components = [
            'feature-cards' => [
                'name' => 'Feature Cards Component',
                'slug' => 'feature-cards',
                'featured_image' => '/images/pagebuilder/featurecards/featured-image.png',
                'order' => 1,
                'configuration' => [
                    'settings' => [
                        'title' => 'Your Title',
                        'background' => '#fff',
                        'layout' => 'layout-one',
                        'columns' => 3,
                        'items' => [
                            [
                                'icon' => '',
                                'title' => 'Your Title',
                                'description' => 'Add your description here',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'client-carousels' => [
                'name' => 'Client Carousels Component',
                'slug' => 'client-carousels',
                'featured_image' => '/images/pagebuilder/clientcarousels/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Your Title',
                        'navigation' => 1,
                        'pagination' => 1,
                        'items' => [
                            [
                                'logo' => '/images/pagebuilder/clientcarousels/carousel-image.png',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'home-banner' => [
                'name' => 'Home Banner Component',
                'slug' => 'home-banner',
                'order' => 3,
                'featured_image' => '/images/pagebuilder/homebanner/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'primary_title' => 'Better Learning.',
                        'secondary_title' => 'Better Results.',
                        'font_color_secondary' => 'rgb(235, 29, 78)',
                        'font_color_primary' => 'rgb(33, 33, 33)',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem',
                        'nameonbutton' => 'Request a Call back',
                        'button' => [
                            'type' => 'cta',
                            'link' => '',
                            'title' => 'Request a Callback',
                        ],
                        'items' => [
                            [
                                'cardtitle' => 'Getting Ready for the Kerala Administrative Services Exam?',
                                'description' => 'Enroll now in the integrated course for the KAS Exam',
                                'button' => [
                                    'label' => 'Enrol Now',
                                    'link' => '',
                                ],
                                'image' => '/images/pagebuilder/homebanner/home-banner.png',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'number-counter' => [
                'name' => 'Number Counter Component',
                'slug' => 'number-counter',
                'featured_image' => '/images/pagebuilder/numbercounter/featured-image.png',
                'order' => 4,
                'configuration' => [
                    'settings' => [
                        'title' => 'Number Counter',
                        'background_color' => '#fdedef',
                        'border_color' => '#f9c3cd',
                        'primary_color' => '#212121',
                        'secondary_color' => '#eb1d4e',
                        'item_count'    => 1,
                        'items' => [
                            [
                                'icon' => '/images/pagebuilder/numbercounter/student-logo.png',
                                'count' => '150',
                                'display_operator' => '2',
                                'operator' => '+',
                                'description' => 'Student Selections',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'image-text' => [
                'name' => 'Image Text',
                'slug' => 'image-text',
                'featured_image' => '/images/pagebuilder/imagetext/featured-image.png',
                'order' => 1,
                'configuration' => [
                    'settings' => [
                        'title' => 'Your Title',
                        'media_alignment' => 'left-layout',
                        'media_type' => 'image',
                        'player_mode' => 'in-line',
                        'image' => '/images/pagebuilder/imagetext/image-text.png',
                        'description' => '<h2>Live class and Concept Videos</h2>
                        Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives',
                        'video' => '/images/pagebuilder/imagetext/video-text.mp4',
                        'background' => '#fff',
                        'layout' => 'layout-one',
                        'columns' => 3,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'cta-block' => [
                'name' => 'CTA Block',
                'slug' => 'cta-block',
                'featured_image' => '/images/pagebuilder/ctablock/featured-image.png',
                'order' => 1,
                'configuration' => [
                    'settings' => [
                        'title' => 'Lookin for study abroad option',
                        'image' => '/images/pagebuilder/ctablock/abroad.png',
                        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,',
                        'buttons' => [
                            [
                                'type' => 'cta',
                                'title' => 'Request Callback',
                                'design' => '',
                                'link' => '#',
                            ],
                            [
                                'type' => 'icon',
                                'title' => '',
                                'design' => '',
                                'link' => '/images/pagebuilder/ctablock/clip-path.png',
                            ],
                            [
                                'type' => 'icon',
                                'title' => '',
                                'design' => '',
                                'link' => '/images/pagebuilder/ctablock/conduira_logo.png',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'faq' => [
                'name' => 'FAQ',
                'slug' => 'faq',
                'featured_image' => '/images/pagebuilder/faq/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\FaqsComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'FAQ',
                        'mode' => 0,
                        'categories' => [],
                        'items' => [
                            [
                                'category' => 'Question Category',
                                'question' => 'Here goes the question?',
                                'answer' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'news-letter' => [
                'name' => 'News Letter',
                'slug' => 'news-letter',
                'featured_image' => '/images/pagebuilder/newslatter/featured-image.png',
                'order' => 1,
                'configuration' => [
                    'settings' => [
                        'title' => 'Subscribe Newsletter',
                        'image' => '',
                        'color' => '#fff',
                        'type' => 'color',
                        'background' => '#212121',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'testimonials' => [
                'name' => 'Testimonials Component',
                'slug' => 'testimonials',
                'featured_image' => '/images/pagebuilder/testimonial/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\TestimonialsComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Learn why people choose us',
                        'caption' => 'Loreum Ipsum is simply dummy text of the printing and typesetting industry',
                        'perpage' => 5,
                        'package' => 0,
                        'view_all' => '',
                        'layout'  => 'grid-layout',
                        'navigation' => 1,
                        'pagination'   => 1,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                            'gradient' => '',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'texteditor' => [
                'name' => 'Text Editor',
                'slug' => 'texteditor',
                'featured_image' => '/images/pagebuilder/texteditor/featured-image.png',
                'order' => 1,
                'configuration' => [
                    'settings' => [
                        'title' => 'Section Title',
                        'content' => '<h2>Why Manorama Horizon?</h2>
                        Manoramahorizon.com, the most trending educational portal, is an allied digital wing of the pioneers of print media, The Malayala Manorama Daily. We have been providing reliable high-quality news content to over 1.44 crore readers everyday for over a century now. At Horizon, we aspire to be a one-stop destination for every school-going student and civil service aspirant.',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'jobpostings' => [
                'name' => 'Job Postings',
                'slug' => 'jobpostings',
                'featured_image' => '/images/pagebuilder/jobposting/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\JobPostingComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Open Positions',
                        'perpage' => 10,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'introbanner' => [
                'name' => 'Intro Banner',
                'slug' => 'introbanner',
                'featured_image' => '/images/pagebuilder/introbanner/featured-image.png',
                'order' => 1,
                'configuration' => [
                    'settings' => [
                        'main_heading' => 'Join us to create an impact',
                        'main_caption' => "Learn how we're working to expand the possibilities of content and technology to support learning in a connected world",
                        'image' => [
                            'url' => '',
                            'alignment' => '',
                        ],
                        'buttons' => [
                            [
                                'type' => 'link',
                                'title' => 'View More',
                                'design' => 'btn-primary',
                                'link' => '#',
                            ],
                        ],
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'instructors' => [
                'name' => 'Instructors Component',
                'slug' => 'instructors',
                'featured_image' => '/images/pagebuilder/instructor/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Your Title',
                        'title_alignment' => 'left',
                        'layout' => 'grid-layout',
                        'navigation' => 1,
                        'pagination' => 1,
                        'view_all'  => [
                            'label' => 'View All Instructors',
                            'url'   => '#'
                        ],
                        'items' => [
                            [
                                'instructor_image' => '/images/pagebuilder/instructor/instructor.png',
                                'description' => 'Chemistry master teacher',
                                'name' => 'Rachita Sachdeva',
                                'experience' => '5+ Years Exp',
                                'organization' => 'IIS University',
                                'organizations' => 'IIS University',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'twocolumnimagealternating' => [
                'name' => 'Two Column Image Alternating Component',
                'slug' => 'twocolumnimagealternating',
                'featured_image' => '/images/pagebuilder/twoimagealternative/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Exploring Our Impressive Range of Features',
                        'caption' => 'Unveiling a Suite of Capabilities Designed to Elevate Your Experience',
                        'background_color'    => '#ffeae0',
                        'title_alignment'   => 'center',
                        'items' => [
                            [
                                'image' => '/images/pagebuilder/twoimagealternative/liveclass-img.png',
                                'description' => '<h2>Live class and Concept Videos</h2>
                                Dive deep into the heart of complex topics with our meticulously crafted concept videos. Our expert educators break down intricate concepts into easy-to-understand visual narratives',
                                'viewmore'  => [
                                    'label' => 'Viewmore',
                                    'url'   => '#'
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'slider' => [
                'name' => 'Slider Component',
                'slug' => 'slider',
                'featured_image' => '/images/pagebuilder/slider/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Your Title',
                        'show_items' => '3',
                        'move_items' => '1',
                        'items' => [
                            [
                                'image' => '/images/pagebuilder/slider/slider-image.png',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'blogs' => [
                'name' => 'Blogs',
                'slug' => 'blogs',
                'featured_image' => '/images/pagebuilder/blogs/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\BlogsComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Read Latest Articles',
                        'type' => 'article',
                        'search' => 'Search Articles',
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                        'perpage' => 10,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'downloadableresources' => [
                'name' => 'Downloadable Resources',
                'slug' => 'downloadableresources',
                'featured_image' => '/images/pagebuilder/downloadableresource/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\DownloadableResourceComponent',
                'configuration' => [
                    'settings' => [
                        'caption' => 'Get access solved questions with solutions from experts. Compare your answers with the given solutions and key. Estimate your score and chances for getting selected.',
                        'perpage' => 10,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'course-highlights' => [
                'name' => 'course Highlights Component',
                'slug' => 'course-highlights',
                'featured_image' => '/images/pagebuilder/coursehighlights/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Course Highlights',
                        'no_of_columns' => '3',
                        'background_color' => '#ffeae0',
                        'text_color' => '#531c09',
                        'border_color' => '#d81b43',
                        'border_styles' => 'solid',
                        'items' => [
                            [
                                'icon' => '/images/pagebuilder/coursehighlights/check-circle.png',
                                'description' => 'Helps to develop a strong theoretical understanding on the basics of AI',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'site-map' => [
                'name' => 'Site Map Component',
                'slug' => 'site-map',
                'featured_image' => '/images/pagebuilder/sitemap/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Site Map',
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                        'items' => [
                            [
                                'title' => 'title',
                                'links' => [
                                    [
                                        [
                                        'title' => 'The site-map title',
                                        'url' => 'https://',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'contact-page' => [
                'name' => 'Contact Page Component',
                'slug' => 'contact-page',
                'featured_image' => '/images/pagebuilder/contactpage/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'primary_title' => "Let's ",
                        'secondary_title' => 'Talk',
                        'description' => 'Your Description goes here',
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'cards-with-cta' => [
                'name' => 'Cards With CTA',
                'slug' => 'cards-with-cta',
                'featured_image' => '/images/pagebuilder/cardswithcta/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Cards with CTA',
                        'number_of_columns' => 2,
                        'bg_gradient_color' => 'linear-gradient(0deg, rgba(253, 206, 206, 0.45) 14%, rgba(234, 203, 236, 0.79) 69%)',
                        'items' => [
                            [
                                'title' => 'Are You Getting Ready for a competative Exam?',
                                'image' => '/images/pagebuilder/cardswithcta/exam.png',
                                'buttons' => [
                                    [
                                        'type' => 'link',
                                        'label' => 'Enrol Now',
                                        'link' => '#',
                                        'design' => 'regular',
                                        'package' => 0,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
'lead-Capture-page' => [
                'name' => 'Lead Capture Page Component',
                'slug' => 'lead-capture-page',
                'featured_image' => '/images/pagebuilder/contactpage/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Title',
                        'caption' => 'Caption',
                        'image' => '',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'package' => [
                'name' => 'K12 Package',
                'slug' => 'package',
                'featured_image' => '/images/pagebuilder/k12package/featured-image.png',
                'service' => 'App\Services\PageComponents\K12PackageComponent',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Courses',
                        'package' => 0,
                        'batchdate' => '',
                        'is_variable' => 1,
                        'studyplan' => '',
                        'courses' => [
                            [
                                'slug' => 'science',
                                'title' => 'Science',
                                'timings' => 'Mon - Fri - 7:30PM to 9:00PM',
                                'syllabus' => [
                                    [
                                        'title' => 'Biological Classification',
                                        'topics' => [
                                            [
                                                'type' => 'reading',
                                                'title' => '',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'cepackage' => [
                'name' => 'Competitive Exam Package',
                'slug' => 'cepackage',
                'featured_image' => '/images/pagebuilder/cepackage/featured-image.png',
                'order' => 2,
                'service' => 'App\Services\PageComponents\CEPackageComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Course Info',
                        'description' => '',
                        'package' => 0,
                        'timings' => '',
                        'batchstart' => '',
                        'duration' => '',
                        'topics' => [
                            [
                                'title' => 'Ancient & Medieval India',
                                'type' => 'video',
                                'duration' => '14hr',
                            ],
                        ],
                        'total_duration' => 0,
                        'fetch_from_lms' => false,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'mcpackage' => [
                'name' => 'Micro Course Package',
                'slug' => 'mcpackage',
                'featured_image' => '/images/pagebuilder/mcpackage/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Course Info',
                        'description' => '',
                        'package' => 0,
                        'timings' => '',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'scrolltotabs' => [
                'name' => 'Scroll To Tabs',
                'slug' => 'scrolltotabs',
                'featured_image' => '/images/pagebuilder/scrolltotabs/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'tabs' => [
                            [
                                'name' => 'Testimonials',
                                'scroll_to' => 'testimonials',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
        'resource-persons' => [
                'name' => 'Resource Persons',
                'slug' => 'resource-persons',
                'featured_image' => '/images/pagebuilder/resourcepersons/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Resource Persons',
                        'items' => [
                            [
                                'name' => 'Mr. Akarsh K Nair',
                                'designation' => 'AI Product Management Leader / ex Amazon, Elsevier / MIT',
                                'description' => 'Akarsh K Nair is a doctoral researcher at the Indian Institute of Information Technology (IIIT), Kottayam, specializing in distributed learning, machine learning, federated learning, and Edge Intelligence. Previously, he worked as an assistant professor in the Department of Computer Science at TEC College, Palakkad, India. In addition to being selected for the prestigious ACM Anveshan Setu mentorship program in 2021 and 2023, he is also associated with the iHub HCI foundation at IIT  doctoral fellow. Akarsh has already published several research Read More',
                                'image' => '/images/pagebuilder/resourcepersons/resourceperson.png',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'course-curriculum' => [
                'name' => 'Course Curriculum',
                'slug' => 'course-curriculum',
                'featured_image' => '/images/pagebuilder/coursecurriculum/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Course Curriculum',
                        'days' => '4 Days',
                        'hours' => '8hr Total class',
                        'items' => [
                            [
                                'title' => 'Day 1 - Basics of AI',
                                'description' => 'AI Product Management Leader / ex Amazon, Elsevier / MIT',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'school-exams' => [
                'name' => 'School Exams Component',
                'slug' => 'school-exams',
                'featured_image' => '/images/pagebuilder/schoolexams/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'School Exams',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum',
                        'title_alignment' => 'center',
                        'categories' => [
                            [
                                'title' => 'CBSE',
                                'more' => [
                                    'label' => 'View More',
                                    'link' => '',
                                ],
                                'items' => [
                                    [
                                        'label' => 'Class 8',
                                        'url' => '',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'course-listing' => [
                'name' => 'Course Listing Component',
                'slug' => 'course-listing',
                'featured_image' => '/images/pagebuilder/courselisting/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Course Listing',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum',
                        'categories' => [
                            [
                                'title' => 'CBSE',
                                'items' => [
                                    [
                                        'label' => 'Class 8',
                                        'url' => '',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'enquiry-page' => [
                'name' => 'Enquiry Page Component',
                'slug' => 'enquiry-page',
                'featured_image' => '/images/pagebuilder/enquirypage/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Still confused about choosing',
                        'caption' => 'Just leave us your contact details. Our representatives will get back to you with everything you need to know',
                        'button_title' => 'Enquire Now',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'free-resources' => [
                'name' => 'Free Resources',
                'slug' => 'free-resources',
                'featured_image' => '/images/pagebuilder/freeresources/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\FreeResources',
                'configuration' => [
                    'settings' => [
                        'title' => 'Free Resources',
                        'categories' => [
                            'webinars' => [
                                'label' => 'Webinars',
                                'slug' => 'webinars',
                                'show' => 1,
                                'count' => 4,
                                'more' => [
                                    'label' => 'View More',
                                    'link' => 'https://linktomorewebinars',
                                ],
                            ],
                            'article' => [
                                'label' => 'Articles',
                                'slug' => 'article',
                                'show' => 1,
                                'count' => 4,
                                'more' => [
                                    'label' => 'View More',
                                    'link' => 'https://linktomorearticles',
                                ],
                            ],
                            'current-affair' => [
                                'label' => 'Current Affairs',
                                'slug' => 'current-affair',
                                'show' => 1,
                                'count' => 4,
                                'more' => [
                                    'label' => 'View More',
                                    'link' => 'https://linktomorecurrentaffairs',
                                ],
                            ],
                            'studymaterials' => [
                                'label' => 'Study Materials',
                                'slug' => 'studymaterials',
                                'show' => 1,
                                'count' => 4,
                                'more' => [
                                    'label' => 'View More',
                                    'link' => 'https://linktomorestudymaterials',
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'k12-listing-banner' => [
                'name' => 'K12 Listing Banner',
                'slug' => 'k12-listing-banner',
                'featured_image' => '/images/pagebuilder/k12listingbanner/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'breadcrumps' => [
                            [
                                'title' => 'Home',
                                'link' => 'https://manoramal.eabyas.in:1443/home',
                                'active' => 1,
                            ],
                        ],
                        'headings' => [
                            'primary' => [
                                'text' => 'Start your educational journey with',
                                'color' => '#353535',
                            ],
                            'secondary' => [
                                'text' => ' Manorama Horizon.',
                                'color' => '#eb194a',
                            ],
                        ],
                        'caption' => 'School tuitions + 1000 of hours of self-study content from class 8th to Class 12 students ',
                        'buttons' => [
                            [
                                'type' => 'link',
                                'label' => 'Enrol Now',
                                'link' => '#',
                                'design' => 'regular',
                                'package' => 0,
                            ],
                        ],
                        'slider' => [
                            'images' => [
                                [
                                    'image' => '/images/pagebuilder/k12listingbanner/student.png',
                                ],
                            ],
                            'navigation' => 0,
                            'pagination' => 1,
                        ],
                        'stats' => [
                            'items' => [
                                [
                                    'icon' => '/images/pagebuilder/k12listingbanner/courses.png',
                                    'count' => '150',
                                    'display_operator' => 'before',
                                    'operator' => '+',
                                    'description' => 'Batches Till Date',
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'k12-landing-banner' => [
                'name' => 'K12 landing Banner',
                'slug' => 'k12-landing-banner',
                'featured_image' => '/images/pagebuilder/k12landingbanner/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'breadcrumps' => [
                            [
                                'title' => 'Home',
                                'link' => 'https://manoramal.eabyas.in:1443/home',
                                'active' => 1,
                            ],
                        ],
                        'category' => 'CBSE',
                        'title' => 'Class 8',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and typesetting',
                        'buttons' => [
                            [
                                'type' => 'link',
                                'label' => 'Enquire Now',
                                'link' => '#',
                                'design' => 'regular',
                            ],
                        ],
                        'youtube' => 'https://youtube.com',
                        'thumbnail' => '/images/pagebuilder/k12landingbanner/classimg.png',
                        'features' => [
                            [
                                'icon' => '/images/pagebuilder/k12landingbanner/webinarclass.png',
                                'title' => 'Live master class',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'cta-layout-three' => [
                'name' => 'CTA Layout Three',
                'slug' => 'cta-layout-three',
                'featured_image' => '/images/pagebuilder/ctalayoutthree/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'The best place to learn?  ',
                        'caption' => 'School tuitions + 1000 of hours of self-study content from class 8th to Class 12 students ',
                        'images' => [
                            'image_1' => '/images/pagebuilder/ctalayoutthree/mbl-screen-left.png',
                            'image_2' => '/images/pagebuilder/ctalayoutthree/mbl-screen-middle.png',
                            'image_3' => '/images/pagebuilder/ctalayoutthree/mbl-screen-right.png',
                        ],
                        'buttons' => [
                            [
                                'type' => 'icon',
                                'label' => 'Enquire Now',
                                'link' => '/images/pagebuilder/ctalayoutthree/playstore.png',
                                'design' => 'regular',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'cta-layout-two' => [
                'name' => 'CTA Layout Two',
                'slug' => 'cta-layout-two',
                'featured_image' => '/images/pagebuilder/ctalayouttwo/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'Competitive Exam',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
                        'image' => '/images/pagebuilder/ctalayouttwo/comp-exam.png',
                        'more' => [
                            'label' => 'View All Courses',
                            'link' => '',
                        ],
                        'features' => [
                            [
                                'title' => 'Online Civil Service Foundation Course 2023-2024',
                                'caption' => 'Your dream of becoming IAS officer begins here.',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
        'studymaterials' => [
                'name' => 'Study Materials',
                'slug' => 'studymaterials',
                'featured_image' => '/images/pagebuilder/studymaterials/featured-image.png',
                'order' => 1,
                'service' => 'App\Services\PageComponents\StudyMaterialsComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Study Materials',
                        'type' => 'studymaterials',
                        'search' => 'Search Study Materials',
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                        'perpage' => 10,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'country-carousel' => [
                'name' => 'Country Carousel',
                'slug' => 'country-carousel',
                'featured_image' => '/images/pagebuilder/countrycarousels/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'More than 90,000 programs offered in 9+ countries',
                        'navigation' => 0,
                        'pagination' => 1,
                        'items' => [
                            [
                                'icon' => '/images/pagebuilder/countrycarousels/ireland-logo.png',
                                'image' => '/images/pagebuilder/countrycarousels/ireland.png',
                                'title' => 'USA',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'our-mentor' => [
                'name' => 'Our Mentor',
                'slug' => 'our-mentor',
                'featured_image' => '/images/pagebuilder/ourmentors/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'Our Mentors',
                        'mentors' => [
                            [
                                'linkedin' => 'linkedin.com',
                                'profile' => '/images/pagebuilder/ourmentors/mentor2.png',
                                'name' => 'USA',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'testimonials-layout-two' => [
                'name' => 'Testimonials Layout Two',
                'slug' => 'testimonials-layout-two',
                'featured_image' => '/images/pagebuilder/testimonialslayouttwo/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'Results & Testimonials',
                        'caption' => '100+ Admits in Fall 2022 and Spring 2023',
                        'layout'  => 'grid-layout',
                        'navigation' => 1,
                        'pagination'   => 1,
                        'testimonials' => [
                            [
                                'name' => 'Vaishnavi Koya',
                                'profile' => '/images/pagebuilder/testimonialslayouttwo/results-1.png',
                                'university' => 'Pace University',
                                'logo' => '/images/pagebuilder/testimonialslayouttwo/pace-logo.png',
                                'description' => 'Conduria consultancy has helped with the whole admission. Lakshmi Mam and Abdullah sir are available when I need them I am very happy with the support received from Conduria. I also took coaching for GRE and IELTS, The way Abdullah sir teaches is amazing. I highly recommend conduria who is planning their study abroad.',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'two-col-accordion-image' => [
                'name' => 'Two Column Accordion Image',
                'slug' => 'two-col-accordion-image',
                'featured_image' => '/images/pagebuilder/twocolaccordionimage/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'Services We Provide',
                        'image' => '/images/pagebuilder/twocolaccordionimage/country-usersgrp.png',
                        'accordions' => [
                            [
                                'heading' => 'Test Prep',
                                'content' => 'Know more about which test to attempt for the course you intend to pursue, when to attempt the test and what are the alternatives in case you score less than your expectations. Receive Expert guidance on maximizing your test scores.',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'certificate-courses' => [
                'name' => 'Certificate Courses',
                'slug' => 'certificate-courses',
                'featured_image' => '/images/pagebuilder/certificatecourses/featured-image.png',
                'service' => 'App\Services\PageComponents\CertificateCoursesComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Certificate Courses',
                        'title_alignment' => 'center',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
                        'packages' => [],
                        'limit' => 4,
                        'more' => [
                            'label' => 'View All Courses',
                            'link' => '',
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'package-rating' => [
                'name' => 'Package Rating',
                'slug' => 'package-rating',
                'featured_image' => '/images/pagebuilder/packagerating/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'package' => '',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'mc-landing-banner' => [
                'name' => 'MC Landing banner',
                'slug' => 'mc-landing-banner',
                'featured_image' => '/images/pagebuilder/mclandingbanner/featured-image.png',
                'service' => 'App\Services\PageComponents\MCLandingBannerComponent',
                'configuration' => [
                    'settings' => [
                        'primary_title' => ' Manorama Horizon empowers you to ',
                        'secondary_title' => ' Upgrade your skills',
                        'font_color_secondary' => 'rgb(235, 29, 78)',
                        'font_color_primary' => 'rgb(33, 33, 33)',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the',
                        'package' => 0,
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                        'buttons' => [
                            [
                                'type' => 'link',
                                'label' => 'Enrol Now',
                                'link' => '#',
                                'design' => 'regular',
                                'package' => 0,
                            ],
                        ],
                        'logos' => [
                            [
                                'logo' => '/images/pagebuilder/mclandingbanner/bimtech.png',
                            ],
                        ],
                        'slider' => [
                            'images' => [
                                [
                                    'image' => '/images/pagebuilder/mclandingbanner/ai-banner.png',
                                ],
                            ],
                            'navigation' => 0,
                            'pagination' => 1,
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'other-courses' => [
                'name' => 'Other Courses',
                'slug' => 'other-courses',
                'featured_image' => '/images/pagebuilder/othercourses/featured-image.png',
                'service' => 'App\Services\PageComponents\OtherCoursesComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Other Courses',
                        'packages' => [
                            [
                                'package' => 0,
                                'instructor' => 'by Toms thomas',
                                'start_date' => 'Oct 01',
                                'thumbnail' => '/images/pagebuilder/othercourses/product-oc1.png',
                                'button_title' => 'Know More',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'exam-listing' => [
                'name' => 'Exam Listing Component',
                'slug' => 'exam-listing',
                'featured_image' => '/images/pagebuilder/examlist/featured-image.png',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Exam Listing',
                        'title_alignment' => 'center',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum',
                        'items' => [
                            [
                                'description' => 'Civil Services Foundation Course',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'guruvandanam' => [
                'name' => 'Guruvandanam',
                'slug' => 'guruvandanam',
                'featured_image' => '/images/pagebuilder/guruvandanam/gfeature-image.png',
                'configuration' => [
                    'settings' => [
                        'name' => '',
                        'phone' => '',
                        'email' => '',
                        'school' => '',
                        'district' => '',
                        'locality' => '',
                        'pincode' => '',
                        'video' => '',
                        'videourl' => '',
                        'certificate' => '',
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'videolist' => [
                'name' => 'Videolist',
                'slug' => 'videolist',
                'featured_image' => '/images/pagebuilder/videolist/gfeature-image.png',
                'service' => 'App\Services\PageComponents\VideolistComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Watch Latest Videos',
                        'search' => 'Search Videos',
                        'breadcrumps' => [
                            [
                                'title' => 'Breadcrump',
                                'link' => '#',
                                'active' => 1,
                            ],
                        ],
                        'perpage' => 10,
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'readmore' => [
                'name' => 'Readmore',
                'slug' => 'readmore',
                'order' => 3,
                'featured_image' => '/images/pagebuilder/readmore/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'Best Online Learning Platforms for K1 to K12, CBSE, ICSE, JEE & NEET',
                        'description' => '<div class="text-gray-600 text-sm leading-[25px]">MH is Indias one of the best education platforms, known for creating one of the most sought after learning apps. With our unique learning platform called WAVE and immensely talented best teachers, MH offers a highly personalised learning experience for 1st to 12th grades across CBSE and ICSE Boards. Our hands-on teaching methodology has made MH  the primary methodology has made MH the primary</div>',
                        'cutoff' => 55,
                        'readmore_text' => 'See More',
                        'readless_text' => 'See Less'
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'video-player' => [
                'name' => 'Video Player',
                'slug' => 'video-player',
                'order' => 3,
                'featured_image' => '/images/pagebuilder/videoplayer/featured-image.png',
                'configuration' => [
                    'settings' => [
                        'title' => 'See our sample content',
                        'caption' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
                        'video' => 'images/pagebuilder/videoplayer/video-text.mp4',
                        'poster_image'  => '/images/pagebuilder/videoplayer/sample.png'
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'free-test' => [
                'name' => 'Free Test',
                'slug' => 'free-test',
                'order' => 3,
                'featured_image' => '/images/pagebuilder/freetest/featured-image.png',
                'service' => 'App\Services\PageComponents\FreeTestComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Free Test',
                        'packages' => [
                            [
                                'package' => 0,
                                'questions' => '100 Questions',
                                'marks' => '100 Marks',
                                'duration'  => '90 Mins',
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'test-package' => [
                'name' => 'Test Package',
                'slug' => 'test-package',
                'order' => 3,
                'featured_image' => '/images/pagebuilder/testpackage/featured-image.png',
                'service' => 'App\Services\PageComponents\TestPackageComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Exam Details',
                        'package' => 0,
                        'tests' => [
                            [
                                'title' => '2024 UPSC IAS MOCK-TEST_1 (IMP Topics of Current Affairs) ENGLISH',
                                'duration' => '60 Mins',
                                'marks'  => 100,
                                'dates'  => 'Feb 13 Mon 12:30PM',
                                'questions'  => 50,
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
            'our-offerings' => [
                'name' => 'Our Offerings',
                'slug' => 'our-offerings',
                'order' => 1,
                'featured_image' => '/images/pagebuilder/testpackage/featured-image.png',
                'service' => 'App\Services\PageComponents\OurOfferingsComponent',
                'configuration' => [
                    'settings' => [
                        'title' => 'Our Offerings',                       
                        'courses' => [
                            [
                                'title' => 'Techinical',
                                'goal' => '',
                                'limit'  => 4,
                                'timeline' => '',
                                'more'  => [
                                    'label' => 'Viewmore',
                                ],
                            ],
                                [
                                    'title' => 'Non Techinical',
                                    'goal' => '',
                                    'limit'  => 4,
                                    'timeline' => '',
                                    'more'  => [
                                        'label' => '',
                                        'link' => ''
                                    ],

                                ],
                             
                            ],
                        ],
                        'advanced' => [
                            'margins' => [
                                'value' => [
                                    'top' => 0,
                                    'bottom' => 0,
                                    'left' => 0,
                                    'right' => 0,
                                ],
                                'unit' => 'px',
                            ],
                            'padding' => [
                                'value' => [
                                    'top' => 20,
                                    'bottom' => 20,
                                    'left' => 20,
                                    'right' => 20,
                                ],
                                'unit' => 'px',
                            ],
                            'background' => [
                                'type' => 'color',
                                'value' => 'transparent',
                            ],
                            'container' => [
                                'id' => '',
                                'class' => '',
                            ],
                            'type' => 'fwbg',
                        ],
    
                    ],
              ],
              'neatkeamp-package' => [
                'name' => 'NEATKEAMP Package',
                'slug' => 'neatkeamp-package',
                'featured_image' => '/images/pagebuilder/k12package/featured-image.png',
                'service' => 'App\Services\PageComponents\NEATKEAMPackageComponent',
                'order' => 2,
                'configuration' => [
                    'settings' => [
                        'title' => 'Courses',
                        'package' => 0,
                        'name' => [
                        ],
                        'batchdate' => '',
                        'is_variable' => 1,
                        'studyplan' => '',
                        'courses' => [
                            [
                                'slug' => 'science',
                                'title' => 'Science',
                                'timings' => 'Mon - Fri - 7:30PM to 9:00PM',
                                'syllabus' => [
                                    [
                                        'title' => 'Biological Classification',
                                        'topics' => [
                                            [
                                                'type' => 'reading',
                                                'title' => '',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'advanced' => [
                        'margins' => [
                            'value' => [
                                'top' => 0,
                                'bottom' => 0,
                                'left' => 0,
                                'right' => 0,
                            ],
                            'unit' => 'px',
                        ],
                        'padding' => [
                            'value' => [
                                'top' => 20,
                                'bottom' => 20,
                                'left' => 20,
                                'right' => 20,
                            ],
                            'unit' => 'px',
                        ],
                        'background' => [
                            'type' => 'color',
                            'value' => 'transparent',
                        ],
                        'container' => [
                            'id' => '',
                            'class' => '',
                        ],
                        'type' => 'fwbg',
                    ],
                ],
            ],
        ];
        foreach ($components as $key => $component) {
            PageComponentType::updateOrCreate([
                'slug' => $key,
            ], $component);
        }
    }
}
