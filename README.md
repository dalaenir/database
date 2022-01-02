# Easy-to-use SQL queries library

## Install

`composer require dalaenir/database`

## Usage

```php
<?php
use \Dalaenir\Utils\Database;
$database = new Database($pdo);
$result = $database->query($statement, $params, $className, $onlyOne);
```

- `$statement` is a `string` (**required**).
- `$params` is an `array` (*optional*, empty by default).
- `$className` is a `string` (*optional*, empty by default).
- `$onlyOne` is a `boolean` (*optional*, `false` by default).

## Examples

```php
<?php
$usersList = $database->query("SELECT * FROM `users`;");

$user = $database->query("SELECT * FROM `users` WHERE `id` = ?;", [1], "", true);

$userEntity = $database->query("SELECT * FROM `users` WHERE `id` = ?;", [1], UserEntity::class, true);
```