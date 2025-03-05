<?php

namespace App;

use Contentful\Core\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

class ContentfulErrorHandler
{
    public static function handle($exception, ResponseInterface $response, Twig $view)
    {
        if ($exception instanceof NotFoundException) {
            return $view->render($response->withStatus(404), 'errors/404.html.twig');
        }

        // Log other errors
        error_log($exception->getMessage());
        return $view->render($response->withStatus(500), 'errors/500.html.twig');
    }
}
