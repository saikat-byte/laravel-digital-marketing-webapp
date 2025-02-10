<?php
// config/sections.php
return [
    'types' => [
        'video' => [
            'name' => 'Video Section',
            'view' => 'admin.modules.pages.sections.video',
            'fields' => [
                'video' => [
                    'type' => 'file',
                    'label' => 'Video File',
                    'accept' => 'video/*',
                    'required' => true
                ],
                'heading' => [
                    'type' => 'text',
                    'label' => 'Heading',
                    'required' => false
                ],
                'sub_heading' => [
                    'type' => 'text',
                    'label' => 'Sub Heading',
                    'required' => false
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'required' => false
                ],
                'button1_text' => [
                    'type' => 'text',
                    'label' => 'Button 1 Text',
                    'required' => false
                ],
                'button1_link' => [
                    'type' => 'text',
                    'label' => 'Button 1 Link',
                    'required' => false
                ],
                'button2_text' => [
                    'type' => 'text',
                    'label' => 'Button 2 Text',
                    'required' => false
                ],
                'button2_link' => [
                    'type' => 'text',
                    'label' => 'Button 2 Link',
                    'required' => false
                ]
            ]
        ],
        'multi_image' => [
            'name' => 'Multiple Images',
            'view' => 'admin.modules.pages.sections.multi_image',
            'fields' => [
                'logos' => [
                    'type' => 'file',
                    'label' => 'Upload Images',
                    'multiple' => true,
                    'accept' => 'image/*',
                    'required' => false
                ]
            ]
        ],
        'text' => [
            'name' => 'Text Section',
            'view' => 'admin.modules.pages.sections.text',
            'fields' => [
                'title' => [
                    'type' => 'text',
                    'label' => 'Title',
                    'required' => false
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'required' => false
                ],
                'button_text' => [
                    'type' => 'text',
                    'label' => 'Button Text',
                    'required' => false
                ],
                'button_link' => [
                    'type' => 'text',
                    'label' => 'Button Link',
                    'required' => false
                ]
            ]
        ],
        'custom' => [
            'name' => 'Custom Section',
            'view' => 'admin.modules.pages.sections.custom',
            'fields' => [
                'title' => [
                    'type' => 'text',
                    'label' => 'Section Title',
                    'required' => false
                ],
                'subtitle' => [
                    'type' => 'text',
                    'label' => 'Section Subtitle',
                    'required' => false
                ]
            ],
            'card_fields' => [
                'title' => [
                    'type' => 'text',
                    'label' => 'Card Title'
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Card Description'
                ],
                'image' => [
                    'type' => 'file',
                    'label' => 'Card Image',
                    'accept' => 'image/*'
                ],
                'button_text' => [
                    'type' => 'text',
                    'label' => 'Button Text'
                ],
                'button_link' => [
                    'type' => 'text',
                    'label' => 'Button Link'
                ]
                ],
                'stats_fields' => [  // Add this new section
                    'EXPERIENCE' => [
                        'type' => 'text',
                        'label' => 'Experience Value'
                    ],
                    'PROJECTS' => [
                        'type' => 'text',
                        'label' => 'Projects Value'
                    ],
                    'CLIENT' => [
                        'type' => 'text',
                        'label' => 'Client Value'
                    ],
                    'SUCCESS_RATE' => [
                        'type' => 'text',
                        'label' => 'Success Rate Value'
                    ]
                ]
        ]
    ]
];
