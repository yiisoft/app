<?php

declare(strict_types=1);

namespace App\Web\HomePage;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

final readonly class Action
{
    public function __construct(
        private WebViewRenderer $viewRenderer,
        private LoggerInterface $logger,
        private ConnectionInterface $db,
    ) {}

    public function __invoke(): ResponseInterface
    {
        $this->logger->info('Home page rendered.', ['category' => 'application']);
        $this->logger->debug('Rendering the home page template.');

        $this->db->createCommand('CREATE TABLE IF NOT EXISTS visit (id INTEGER PRIMARY KEY, seen_at TEXT)')->execute();
        $this->db->createCommand('INSERT INTO visit (seen_at) VALUES (:seenAt)', [':seenAt' => date('c')])->execute();

        $visits = $this->db->createCommand('SELECT COUNT(*) FROM visit')->queryScalar();

        $this->logger->info('Home page visits recorded so far: ' . $visits, ['category' => 'application']);

        return $this->viewRenderer->render(__DIR__ . '/template');
    }
}
