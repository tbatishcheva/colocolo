# colocolo

![](./logo.jpg)

Part #1

// create the new Symfony application using Composer:
```bash
composer create-project symfony/skeleton colocolo
```

// Install Doctrine bundle & various libraries
```bash
composer require symfony/orm-pack
composer require annotations
composer require validator
composer require template
composer require security-bundle
composer require --dev maker-bundle
```

// replace info in .env
```bash
DATABASE_URL=mysql://admin:admin@127.0.0.1:3306/colocolo
```
// tip to create a DB : `.helpers/run-mysql-docker.sh`

// If needed, create a database with the value of your database name
```bash
php bin/console doctrine:database:create
```

// Create new ProductController
```bash
php bin/console make:controller
```

// Symfony's web server
```bash
composer require server --dev
```

// run the following command
```bash
php bin/console server:run
```

// Create new Category entity
```bash
php bin/console make:entity
```

// Create new Product entity
```bash
php bin/console make:entity
```

// Doctrine can create the tables we've specified
```bash
php bin/console doctrine:schema:update --force
```

// install doctrine-fixtures
```bash
composer require --dev doctrine/doctrine-fixtures-bundle
```

// run the fixtures
```bash
php bin/console doctrine:fixtures:load
```

// In order to install HWIOAuth Bundle, which uses a virtual package php-http/client-implementation, we need to install several third-party libraries
```bash
composer require hwi/oauth-bundle php-http/guzzle6-adapter php-http/httplug-bundle
```

or add next text to composer.json:
```json
    "require": {
        "hwi/oauth-bundle": "^0.6.3",
        "php-http/guzzle6-adapter": "^1.1",
        "php-http/httplug-bundle": "^1.16",
}
```

// Create new CategoryController
```bash
php bin/console make:controller
```

// clear the cache in your Symfony
```bash
php bin/console cache:clear
```

// add aasets 
```bash
composer require symfony/asset
```

Part #2

// install Symfony's Webpack Encore
```bash
composer require webpack-encore
```

// install some dependencies. sass-loader and node-sass 
```bash
yarn add sass-loader node-sass --dev
```

// compile our Javascript and CSS into assets to be used by Symfony
```bash
yarn run encore dev --watch
```

// In order to make use of Bootstrap we need to install jQuery
```bash
yarn add jquery --dev
```

//  install bootstrap-sass
```bash
yarn add bootstrap-sass --dev
```

// todo
* DateTimeInterface
* many-to-many relation
* Migrations

help
* `composer clearcache`
