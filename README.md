Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require mediamonks/symfony-frontend-connector-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mediamonks/symfony-frontend-connector-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    MediaMonks\FrontendConnectorBundle::class => ['all' => true],
];
```

Configuration
----------------------------------------

#### Bundle config file
```yaml
# config/packages/frontend_connector.yaml
parameters:
  asset_version: src #[deploytool]
```

#### Routing file
```yaml
# config/routes/frontend_connector.yaml
frontend-connector:
  path: /
  methods: GET
  requirements:
    p: '^(?!api/*).+'
  controller: MediaMonks\FrontendConnectorBundle\Controller\FrontendController::index
```

Using your own controller
----------------------------------------

It's easy to overwrite parts of the default controller, by just extending it.
```php
// App/Controller/Api/FrontendController
<?php

declare(strict_types=1);

namespace App\Controller\Api;

use MediaMonks\FrontendConnectorBundle\Controller\FrontendController as BaseController;

class FrontendController extends BaseController {
    // Setting your own template
    protected string $template = 'frontend.html.twig';
    
    // Setting template data
    protected array $templateData = [
        'facebook' => [
            'title' => 'foo',
            'description' => 'bar',
        ]
    ];
    
    // Setting shared max age
    protected int $cacheDuration = 500;
}
```

Adjust the route:
```yaml
# config/routes/frontend_connector.yaml
frontend-connector:
  path: /
  methods: GET
  requirements:
    p: '^(?!api/*).+'
  controller: App\Api\Controller\FrontendController::index
```