<?php

return [


    /*
     |--------------------------------------------------------------------------
     | Handler
     |--------------------------------------------------------------------------
     |
     | Les handlers ont la responsabilité de collecter les logs et en faire
     | quelque chose avec (écriture fichier, envoi mail, etc.)
     |
     */

    'handlers' => [

        /*
         |--------------------------------------------------------------------------
         | Fichiers de logs
         |--------------------------------------------------------------------------
         |
         | Les logs sont écrits dans des fichiers de logs, un par jour.
         |
         */

        log_files => [

            # activé / désactivé
            'enable' => true,

            # chemin et nom de base des fichiers de logs
            'filename' => storage_path('logs') . DIRECTORY_SEPARATOR . 'laravel.log',

            # le nombre de fichiers à conserver
            'max_files' => 7,
        ],

    ],

    /*
     |--------------------------------------------------------------------------
     | Processors
     |--------------------------------------------------------------------------
     |
     | Les processors permettent d'ajouter des informations additionnelles aux logs.
     | Choississez ci-dessous les processors que vous souhaitez utiliser.
     |
     */

    'processors' => [

        /*
         |--------------------------------------------------------------------------
         | Web Processor
         |--------------------------------------------------------------------------
         |
         | Adds the current request URI, request method and client IP to a log record.
         |
         */

        'web' => true,

        /*
         |--------------------------------------------------------------------------
         | Memory Usage Processor
         |--------------------------------------------------------------------------
         |
         | Adds the current memory usage to a log record.
         |
         */

        'memory_usage' => true,

        /*
         |--------------------------------------------------------------------------
         | Memory Peak Usage Processor
         |--------------------------------------------------------------------------
         |
         | Adds the peak memory usage to a log record.
         |
         */

        'memory_peak_usage' => true,

        /*
         |--------------------------------------------------------------------------
         | Get and Post Processor
         |--------------------------------------------------------------------------
         |
         | Adds the $_GET and $_POST data to a log record.
         |
         */

        'get_and_post' => true,

        /*
         |--------------------------------------------------------------------------
         | Get and Post Processor
         |--------------------------------------------------------------------------
         |
         | Processes a log record's message according to PSR-3 rules,
         | replacing {foo} with the value from $context['foo'].
         |
         */

        'psr_log_message' => true,

        /*
         |--------------------------------------------------------------------------
         | Introspection Processor
         |--------------------------------------------------------------------------
         |
         | Adds the line/file/class/method from which the log call originated.
         |
         */

        'introspection' => false,

    ],

];
