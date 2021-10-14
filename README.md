Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

### Step 1: Requirements

Make sure you have the TwigBundle installed.  
Open a command console, enter your project directory and execute:

```console
$ composer require symfony/twig-bundle
```

### Step 2: Download the Bundle

```console
$ composer require mediamonks/symfony-frontend-connector-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Requirements

Make sure you have the TwigBundle installed.  
Open a command console, enter your project directory and execute:

```console
$ composer require symfony/twig-bundle
```

### Step 2: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mediamonks/symfony-frontend-connector-bundle
```

### Step 3: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    MediaMonks\FrontendConnectorBundle::class => ['all' => true],
];
```

### Step 4: Configure the Bundle

Create the following configuration:
```yaml
# src/config/packages/frontend_connector.yaml
parameters:
  asset_version: src #[deploytool]
```

Afterwards run `frontend-connector:setup`.
