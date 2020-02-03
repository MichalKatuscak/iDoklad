# iDoklad API v2 integration

PHP7 library for calling iDoklad API (v2). Library is **not stable** yet.

# Install with Composer

    composer require katuscak/idoklad

# Basic usage

```php
use Fousky\Component\iDoklad\Functions as Func;
use Fousky\Component\iDoklad\iDoklad;
use Fousky\Component\iDoklad\iDokladFactory;

/** 
 * Create iDoklad client with specific configuration.
 *
 * @var \Fousky\Component\iDoklad\iDoklad $idoklad
 */
$idoklad = iDokladFactory::create([
    'client_id' => '##TODO:INSERT CLIENT ID##',
    'client_secret' => '##TODO:INSERT CLIENT SECRET##',
]);

/**
 * Execute function (iDokladFunctionInterface), 
 * this will call iDoklad API and returns model object (iDokladModelInterface).
 *
 * @var \Fousky\Component\iDoklad\Model\Contacts\ContactCollectionModel $responseModel
 */
$responseModel = $idoklad->execute(
    new Func\Contacts\GetContacts()
);

/**
 * Here you have response data from iDoklad API in model class
 * @see GetContacts::getModelClass
 */
var_dump($responseModel);
```

# CI code quality check

Try to run `composer ci` where you can find this commands:

* `composer validate --no-check-all`
* `composer install --no-progress --no-interaction --no-suggest --no-scripts`
* `php vendor/bin/phpstan analyze ./ -c phpstan.neon --level=7`
* `parallel-lint -j 10 --exclude vendor ./`
