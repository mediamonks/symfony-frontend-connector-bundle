<?php

declare(strict_types=1);

namespace MediaMonks\FrontendConnectorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface FrontendConnector {
    public function index(Request $request): Response;
}