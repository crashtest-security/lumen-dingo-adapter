# Dingo Adapter for Lumen 5.4 to 6.0
Using Dingo + JWT in your Lumen Based Application with no pain.

All dependencies have been updated to work with Lumen 6.0

| Tag  | Lumen Version |
|------|---------------|
| 6.0  | 6.0.*         |
| 5.8  | 5.8.*         |
| 5.7  | 5.7.*         |
| 1.1  | 5.4.*         |


### Installation

```
composer require crashtest-security/lumen-dingo-adapter
```

### Configuration

In your `bootstrap/app.php` file add this line:

```php
$app->register(Zeek\LumenDingoAdapter\Providers\LumenDingoAdapterServiceProvider::class);
```

Configure one of the following environment variables to make this package work out of the box:

```env
API_PREFIX=api
API_DOMAIN=api.example.com
```

### Guarding Your Routes via Dingo Routing

```php
$app->make(Dingo\Api\Routing\Router::class)->version('v1', function ($api) {
    $api->group([
        'middleware' => 'api.auth',
    ], function ($api) {
        $api->get('/', 'App\Http\Controllers\DefaultController@index');
    });
});
```

### Quick Start

I have made a boilerplate [here](https://github.com/krisanalfa/lumen-jwt). Read the docs there to find out how to _Quick Start_ this package.


### LICENSE
Copyright 2017 Krisan Alfa Timur

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
