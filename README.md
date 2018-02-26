# React on Laravel 

Inspired by [React on Rails](https://github.com/shakacode/react_on_rails), this package
lets you implement React client-side and server-side rendering in Laravel 5.5+ projects
integrating [ReactRenderer](https://github.com/Limenius/ReactRenderer) in this framework.

Features included:

* Prerender server-side React components for SEO, faster page loading, and users that have disabled JavaScript.
* Blade integration.
* Integration with Laravel Mix.

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Context](#context)
- [Laravel Mix scripts](#laravel-mix-scripts)
- [License](#license)

## Installation

To install this package on your laravel project, add to composer.json:

``` json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/tektonlabs/react-on-laravel"
    }
]
```

And add the package manually to the composer.json:

```json
"require": {
    "php": ">=7.1.3",
    "fideloper/proxy": "~4.0",
    "laravel/framework": "5.6.*",
    "laravel/tinker": "~1.0",
    "tektonlabs/react-on-laravel": "dev-master"
}
```

The run:

```bash
composer update
php artisan vendor:publish
```
## Usage

To include a component in your view you first need to register it. We make use of React
on Rails npm package to do this, and you can register a component like this:

```js
import ReactOnRails from 'react-on-rails';
import HelloWorld from './HelloWorld';

ReactOnRails.register({ HelloWorld });
```

Now you can insert the registered React component in your blade template with:

```
{!! @reactComponent('HelloWorld') !!}
```

and passing props like this:

```
{!! @reactComponent('HelloWorld', ['props' => ['foo' => 'bar']]) !!}
```

You can run `php artisan preset react-on-laravel` to get a basic scaffold including
an example component and webpack configuration in webpack.mix.js. This also includes
code to automatically register all components inside `resources/js/views/` folder using
lowercase and using dots to represent the folder structure, pretty much like the way
views are called in Laravel.

## Configuration

Configuration options are provided the `react_on_laravel.php` published inside the config folder

### Server Bundle

Specifies the route to the bundle used for server side rendering

### Default Rendering

Defines whether the rendering should be done on server side, client side or both. You
can choose between three options: 'client_side', 'server_side' or 'both' (default option).

Also, this parameter can be overrided in the blade call:

```
{!! @reactComponent('HelloWorld', ['props' => ['foo' => 'bar'], 'rendering': 'client_side']) !!}
```

## Context

This library will provide context about the current request to React components. Your components will receive two arguments on instantiation:

```js
const App = (initialProps, context) => {
}
```

In the context object you will receive the following parameters:

```js
{
    serverSide,
    href,
    location,
    scheme,
    host,
    port,
    base,
    pathname,
    search,
}
```

## Laravel Mix scripts

To compile your assets you can use the default Laravel Mix scripts. The aforementioned
preset provides a `webpack.mix.js` file with configuration for browserSync proxying
to the `APP_URL` env variable. The only exception is the `hot`, currently we are not
supporting hot-reloading using webpack-dev-server, it can still be used but it will
raise an error saying that the string compiled from the server is different than the one
obtained in the client. Because of this, we recommend using the `watch` script and
browserSync to get hot-reloading.

## License

The MIT License (MIT).
