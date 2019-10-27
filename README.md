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
DATABASE_URL=mysql://admin:admin@127.0.0.1:3306/colocolo
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

