<?php

use App\Models\Role;

return [
    [
        'title' => "Try Out",
        'menu' => [
            [
                'title' => 'Soal',
                'icon' => 'fa fa-question',
                'route' => 'question',
                'url' => 'question',
                'role' => [Role::ADMIN]
            ],
            [
                'title' => 'Kategori Soal',
                'icon' => 'fa fa-list',
                'route' => 'question-category',
                'url' => 'question-category',
                'role' => [Role::ADMIN]
            ],
            [
                'title' => 'Try Out',
                'icon' => 'fa fa-edit',
                'route' => 'tryout',
                'url' => 'tryout',
                'role' => [
                    Role::ADMIN
                ]
            ],
        ]
    ], 
];
