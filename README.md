# Kanvas Moderation

[![Latest Stable Version](http://poser.pugx.org/kanvas/moderation/v)](https://packagist.org/packages/kanvas/moderation) [![Total Downloads](http://poser.pugx.org/kanvas/moderation/downloads)](https://packagist.org/packages/kanvas/moderation) [![Latest Unstable Version](http://poser.pugx.org/kanvas/moderation/v/unstable)](https://packagist.org/packages/kanvas/moderation) [![License](http://poser.pugx.org/kanvas/moderation/license)](https://packagist.org/packages/kanvas/moderation) [![PHP Version Require](http://poser.pugx.org/kanvas/moderation/require/php)](https://packagist.org/packages/kanvas/moderation)
[![Tests](https://github.com/bakaphp/moderation/workflows/Tests/badge.svg?branch=0.1)](https://github.com/bakaphp/moderation/actions?query=Tests)

This package allows you to add a moderation layer to any Kanvas Application

# Usage

For the public facing controller , create a route and implement the ReportableRoute Trait

```php

class ReportsController
{
    use ReportableRoutes;
}

```

To list the different report types for the current app , use the ReportableTypesRoutes Trait

```php

class TypesController
{
    use ReportableTypesRoutes;
}

```

Exposing the route to block users

```php

class UsersController
{
    use BlockedUserRoutes;
}

```


# Routes

User report creation:

```php
Route::post('/reports')->controller('Moderation\ReportsController')->action('create'),
Route::get('/report-types')->controller('Moderation\TypesController')->action('index'),
```

Blocked / Unblock user routes:

```php
Route::get('/block-users')->controller('Users\BlockUserController')->action('index'),
Route::post('/block-users/{id}')->controller('Users\BlockUserController')->action('blockUser'),
```