<?php

declare(strict_types=1);

namespace MediaMonks\FrontendConnectorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\EventListener\AbstractSessionListener;
use Twig\Environment;

class FrontController implements FrontendConnector
{
    private Environment $twig;
    protected string $template = 'frontend.html.twig';
    protected array $templateData = [];
    protected int $cacheDuration = 300;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     * @throws \Exception
     */
    public function index(Request $request): Response
    {
        if (!$this->template) throw new \Exception('Template property not set.');

        $resp = new Response($this->twig->render($this->template, $this->templateData));
        $resp->headers->set(AbstractSessionListener::NO_AUTO_CACHE_CONTROL_HEADER, 'true');
        $resp->setSharedMaxAge($this->cacheDuration);

        return $resp;
    }
}