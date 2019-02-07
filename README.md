# Laravel Stub Generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require oguzcandemircan/laravel-stub-generator
```

## Config
```php
return [
    'source_path' => storage_path('stubs/source'), // stubs source path
    'target_path' => storage_path('stubs/target'), // stubs target path
];
```

## Usage

Stub file:
```php
//storage/stubs/source/model.stub

namespace {{namespace}};

use Illuminate\Database\Eloquent\Model;

class {{modelName}} extends Model
{
    protected $fillable = [{{fillable}}];
}
```

Generate:
```php

LaravelStubGenerator::source('model')->params([
  '{{modelName}}' => 'UserModel',
  '{{namespace}}' => 'App\Models',
  '{{fillable}}' => "'name', 'email', 'age'",
])->generate();
```

Save:
```php

LaravelStubGenerator::source('model')->params([
  '{{modelName}}' => 'UserModel',
  '{{namespace}}' => 'App\Models',
  '{{fillable}}' => "'name', 'email', 'age'",
])->save('UserModel.php');

// force save
->save('UserModel.php', true);

```
Download:
```php

LaravelStubGenerator::source('model')->params([
  '{{modelName}}' => 'UserModel',
  '{{namespace}}' => 'App\Models',
  '{{fillable}}' => "'name', 'email', 'age'",
])->download('UserModel.php');
```

Output:
```php
//storage/stubs/target/UserModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $fillable = ['name', 'email', 'age'];
}
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Oğuzcan Demircan](https://github.com/oguzcandemircan)
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/oguzcandemircan/laravelstubgenerator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/oguzcandemircan/laravelstubgenerator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/oguzcandemircan/laravelstubgenerator
[link-downloads]: https://packagist.org/packages/oguzcandemircan/laravelstubgenerator
[link-author]: https://github.com/oguzcandemircan
[link-contributors]: ../../contributors
