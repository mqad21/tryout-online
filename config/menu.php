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
    [
        'title' => "Pengguna",
        'menu' => [
            [
                'title' => 'Kelola Pengguna',
                'icon' => 'fa fa-user',
                'route' => 'user',
                'url' => 'user',
                'role' => [Role::ADMIN]
            ],
        ]
    ], 
    [
        'title' => "Try Out",
        'menu' => [
            [
                'title' => 'Kerjakan Try Out',
                'icon' => 'fa fa-edit',
                'route' => 'tryout/do',
                'url' => 'tryout/do',
                'role' => [Role::ADMIN, Role::SISWA]
            ],
            [
                'title' => 'Hasil dan Pembahasan',
                'icon' => 'fa fa-clipboard',
                'route' => 'tryout/explanation',
                'url' => 'tryout/explanation',
                'role' => [Role::ADMIN, Role::SISWA]
            ],
            [
                'title' => 'Grafik Hasil Try Out',
                'icon' => 'fa fa-check',
                'route' => 'tryout/chart',
                'url' => 'tryout/chart',
                'role' => [Role::ADMIN, Role::SISWA]
            ]
        ]
    ], 
];
