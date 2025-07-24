<?php

return [
    'autoload' => false,
    'hooks' => [
        'app_init' => [
            'cos',
        ],
        'module_init' => [
            'cos',
        ],
        'upload_config_init' => [
            'cos',
        ],
        'upload_delete' => [
            'cos',
        ],
        'epay_config_init' => [
            'epay',
        ],
        'addon_action_begin' => [
            'epay',
        ],
        'action_begin' => [
            'epay',
        ],
        'config_init' => [
            'summernote',
        ],
    ],
    'route' => [],
    'priority' => [],
    'domain' => '',
];
