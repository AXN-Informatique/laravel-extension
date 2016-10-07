<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Handlers
     |--------------------------------------------------------------------------
     |
     | Handlers are responsible for collecting logs records and do something
     | with (write to a file, send an email, etc.)
     |
     | Handlers currently available:
     |
     |  - log_files     : Rotating log files handler
     |  - html_files    : Rotating HTML files handler
     |  - mailer        : Mailer handler
     |
     | You can specify for each handler, what minimum level
     | they have to be triggered.
     |
     | Availlable levels:
     |
     |  - 100 : DEBUG      Detailed debug information
     |  - 200 : INFO       Interesting events
     |  - 250 : NOTICE     Uncommon events
     |  - 300 : WARNING    Exceptional occurrences that are not errors
     |  - 400 : ERROR      Runtime errors
     |  - 500 : CRITICAL   Critical conditions
     |  - 550 : ALERT      Action must be taken immediately
     |  - 600 : EMERGENCY  Urgent alert
     |
     | Also, you can choose for each handler whether messages
     | that are handled can bubble up the stack or not.
     |
     */

    'handlers' => [

        /*
         |--------------------------------------------------------------------------
         | Rotating log files handler
         |--------------------------------------------------------------------------
         |
         | Stores logs to files that are rotated every day
         | and a limited number of files are kept.
         |
         */

        'log_files' => [

            /*
             |--------------------------------------------------------------------------
             | Status (boolean)
             |--------------------------------------------------------------------------
             |
             | Enable or disable this handler with a boolean ("true" or "false").
             |
             */

            'enable' => true,

            /*
             |--------------------------------------------------------------------------
             | Filename (string)
             |--------------------------------------------------------------------------
             |
             | The path and file name basis of the log files.
             |
             */

            'filename' => storage_path('logs') . DIRECTORY_SEPARATOR . 'laravel.log',

            /*
             |--------------------------------------------------------------------------
             | Max files (int)
             |--------------------------------------------------------------------------
             |
             | The maximal amount of files to keep (0 means unlimited)
             |
             */

            'max_files' => 7,

            /*
             |--------------------------------------------------------------------------
             | Level (int)
             |--------------------------------------------------------------------------
             |
             | The minimum logging level at which this handler will be triggered.
             |
             */

            'level' => 100,

            /*
             |--------------------------------------------------------------------------
             | Bubble (boolean)
             |--------------------------------------------------------------------------
             |
             | Whether the messages that are handled by this handler
             | can bubble up the stack or not.
             |
             */

            'bubble' => true,
        ],

        /*
         |--------------------------------------------------------------------------
         | Rotating HTML files handler
         |--------------------------------------------------------------------------
         |
         | The same as the previous handler but in HTML format.
         |
         */

        'html_files' => [

            /*
             |--------------------------------------------------------------------------
             | Status (boolean)
             |--------------------------------------------------------------------------
             |
             | Enable or disable this handler with a boolean ("true" or "false").
             |
             */

            'enable' => false,

            /*
             |--------------------------------------------------------------------------
             | Filename (string)
             |--------------------------------------------------------------------------
             |
             | The path and file name basis of the log files.
             |
             */

            'filename' => storage_path('logs') . DIRECTORY_SEPARATOR . 'laravel.html',

            /*
             |--------------------------------------------------------------------------
             | Max files (int)
             |--------------------------------------------------------------------------
             |
             | The maximal amount of files to keep (0 means unlimited)
             |
             */

            'max_files' => 7,

            /*
             |--------------------------------------------------------------------------
             | Level (int)
             |--------------------------------------------------------------------------
             |
             | The minimum logging level at which this handler will be triggered.
             |
             */

            'level' => 100,

            /*
             |--------------------------------------------------------------------------
             | Bubble (boolean)
             |--------------------------------------------------------------------------
             |
             | Whether the messages that are handled by this handler
             | can bubble up the stack or not.
             |
             */

            'bubble' => true,
        ],

        /*
         |--------------------------------------------------------------------------
         | Mailer handler
         |--------------------------------------------------------------------------
         |
         | Envoi les logs à une adresse e-mail.
         |
         */

        'mailer' => [

            /*
             |--------------------------------------------------------------------------
             | Status (boolean)
             |--------------------------------------------------------------------------
             |
             | Enable or disable this handler with a boolean ("true" or "false").
             |
             */

            'enable' => false,

            /*
             |--------------------------------------------------------------------------
             | Email address from
             |--------------------------------------------------------------------------
             |
             | ...
             |
             */

            'from' => ['no-reply@example.com' => 'Project logs'],

            /*
             |--------------------------------------------------------------------------
             | Email address to
             |--------------------------------------------------------------------------
             |
             | ...
             |
             */

            'to' => ['dev@example.com' => 'Dev Team'],

            /*
             |--------------------------------------------------------------------------
             | Level (int)
             |--------------------------------------------------------------------------
             |
             | The minimum logging level at which this handler will be triggered.
             |
             */

            'level' => 400,

            /*
             |--------------------------------------------------------------------------
             | Bubble (boolean)
             |--------------------------------------------------------------------------
             |
             | Whether the messages that are handled by this handler
             | can bubble up the stack or not.
             |
             */

            'bubble' => true,
        ],
    ],

    /*
     |--------------------------------------------------------------------------
     | Processors
     |--------------------------------------------------------------------------
     |
     | The processors are used to add additional information to the logs records.
     |
     | Choose below the processors you want to use, each processor
     | may be enabled or disabled with a boolean ("true" or "false").
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
         | PSR log messages
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
