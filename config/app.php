<?php

return [
    'locale' => env('APP_LOCALE', 'en'),
    'providers' => [
        Yajra\DataTables\DataTablesServiceProvider::class,
    ],


    'aliases' => [
        'DataTables' => Yajra\DataTables\Facades\DataTables::class,
    ]
];
