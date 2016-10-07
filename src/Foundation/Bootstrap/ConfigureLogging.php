<?php

namespace Axn\Illuminate\Foundation\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Logger as Monolog;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Processor\WebProcessor;

class ConfigureLogging
{
    protected $config;

    private $monolog;

    public function __construct(Application $app)
    {
        $this->config= $app->make('config')->get('logging');
    }

    public function getMonologConfigurator(Monolog $monolog)
    {
        $this->monolog = $monolog;

        $this->setCommonsProcessors();

        $this->setLogFilesHandler();

        $this->setHtmlFilesHandler();

        $this->setSwiftMailerHandler();
    }

    protected function setLogFilesHandler()
    {
        $config = $this->config['handlers']['log_files'];

        if (!$config['enable']) {
            return;
        }

        $handler = new RotatingFileHandler(
            $config['file'],
            $config['max_files']
        );

        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $this->monolog->pushHandler($handler);
    }

    protected function setHtmlFilesHandler()
    {
        $handler = new RotatingFileHandler(
            $this->app->storagePath() . '/logs/laravel.html',
            $this->app->make('config')->get('app.log_max_files', 5)
        );

        $handler->setFormatter(new HtmlFormatter());

        $this->monolog->pushHandler($handler);
    }

    protected function setSwiftMailerHandler()
    {
        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

        $message = Swift_Message::newInstance()
            ->setSubject('Laravel error logging')
            ->setFrom(['no-reply@axn.fr' => 'AXN Informatique'])
            ->setTo(['developpement@axn.fr' => 'Dev spe']);

        $handler = new SwiftMailerHandler(
            $mailer,
            $message
        );

        $handler->setFormatter(new HtmlFormatter());

        $this->monolog->pushHandler($handler);
    }

    /**
     * Set commons processors according to configuration values.
     *
     */
    protected function setCommonsProcessors()
    {
        $config = $this->config['processors'];

        if ($config['introspection']) {
            $this->monolog->pushProcessor(new IntrospectionProcessor());
        }

        if ($config['web']) {
            $this->monolog->pushProcessor(new WebProcessor());
        }

        if ($config['memory_usage']) {
            $this->monolog->pushProcessor(new MemoryUsageProcessor());
        }

        if ($config['memory_peak_usage']) {
            $this->monolog->pushProcessor(new MemoryPeakUsageProcessor());
        }

        if ($config['psr_log_message']) {
            $this->monolog->pushProcessor(new PsrLogMessageProcessor());
        }

        if ($config['get_and_post']) {
            $this->monolog->pushProcessor(function ($record) {
                $record['extra']['HTTP _GET'] = isset($_GET) ? $_GET : [];
                $record['extra']['HTTP _POST'] = isset($_POST) ? $_POST : [];

                return $record;
            });
        }
    }
}
