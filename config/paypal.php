<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
        'client_id'  => 'AQAK3XVazZ_WyO1eBjFbN6ixQ-xLCyjMY3XgbIpfWIdyF1GfNbuqPq3DZNkiGiYYePkk-cXoPV8UeY_n',
        'secret'     => 'EBzHV9LTmNV8yHGAsnYbUQgUecX3FkhjEAT7Anb97LCSVgWisIiZKmKH_y-C0KrSv8lwCC14WEKZMm-_',

        'setting' => [
            'mode' => 'sandbox',
            'http.ConnectionTimeout' => 100000,
            'Log.LogEnabled' => true,
            'Log.FileName' => storage_path().'/logs/paypal.log',
            'Log.LogLevel' => 'FINE',
        ],
        // Validate SSL when creating api client.
];
