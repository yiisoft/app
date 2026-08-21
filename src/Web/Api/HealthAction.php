<?php

declare(strict_types=1);

namespace App\Web\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

use function json_encode;

/**
 * JSON API endpoint consumed by Vanilla JS (assets/main/app.js).
 * Demonstrates Yii3 backend <-> Vanilla JS frontend co-work.
 */
final readonly class HealthAction
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {}

    public function __invoke(): ResponseInterface
    {
        $payload = [
            'status' => 'ok',
            'framework' => 'Yii3',
            'frontend' => 'Vanilla JS',
            'time' => date('Y-m-d H:i:s'),
        ];

        $body = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $response = $this->responseFactory
            ->createResponse(200)
            ->withHeader('Content-Type', 'application/json; charset=UTF-8')
            ->withHeader('Cache-Control', 'no-store');

        $response->getBody()->write($body);

        return $response;
    }
}
