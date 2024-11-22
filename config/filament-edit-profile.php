<?php

return [
    'show_custom_fields' => false,
    'custom_fields' => [
        'banner' => [
            'type' => 'fileUpload',
            'label' => 'Banner',
            'placeholder' => '',
            'required' => false,
            'rules' => 'nullable|image|max:1024',
        ]
    ]
];