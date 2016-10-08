<?php

namespace Axn\Illuminate\Foundation\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Processor\WebProcessor;

class ConfigureLogging
{
    protected $config;

    private $logger;

    public function __construct(Application $app)
    {
        $this->config= $app->make('config')->get('logging');
    }

    /**
     * Entry point for the Monolog Configuration.
     *
     * @param Logger $monolog
     */
    public function configure(Logger $monolog)
    {
        $this->logger = $monolog;

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
            $config['max_files'],
            $config['level'],
            $config['bubble']
        );

        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $this->logger->pushHandler($handler);
    }

    protected function setHtmlFilesHandler()
    {
        $config = $this->config['handlers']['html_files'];

        if (!$config['enable']) {
            return;
        }

        $handler = new RotatingFileHandler(
            $config['file'],
            $config['max_files'],
            $config['level'],
            $config['bubble']
        );

        $handler->setFormatter(new HtmlFormatter());

        $this->logger->pushHandler($handler);
    }

    protected function setSwiftMailerHandler()
    {
        $config = $this->config['handlers']['mailer'];

        if (!$config['enable']) {
            return;
        }

        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

        $message = Swift_Message::newInstance()
            ->setFrom($config['from'])
            ->setTo($config['to']);

        $handler = new SwiftMailerHandler(
            $mailer,
            $message,
            $config['level'],
            $config['bubble']
        );

        $handler->setFormatter(new HtmlFormatter());

        $this->logger->pushHandler($handler);
    }

    /**
     * Set commons processors according to configuration values.
     *
     */
    protected function setCommonsProcessors()
    {
        $config = $this->config['processors'];

        if ($config['introspection']) {
            $this->logger->pushProcessor(new IntrospectionProcessor());
        }

        if ($config['web']) {
            $this->logger->pushProcessor(new WebProcessor());
        }

        if ($config['memory_usage']) {
            $this->logger->pushProcessor(new MemoryUsageProcessor());
        }

        if ($config['memory_peak_usage']) {
            $this->logger->pushProcessor(new MemoryPeakUsageProcessor());
        }

        if ($config['psr_log_message']) {
            $this->logger->pushProcessor(new PsrLogMessageProcessor());
        }

        if ($config['get_and_post']) {
            $this->logger->pushProcessor(function ($record) {
                $record['extra']['HTTP _GET'] = !empty($_GET) ? $_GET : [];
                $record['extra']['HTTP _POST'] = !empty($_POST) ? $_POST : [];

                return $record;
            });
        }
    }
}
