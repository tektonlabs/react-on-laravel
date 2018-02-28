# React on Laravel 

Inspired by [React on Rails](https://github.com/shakacode/react_on_rails), this package
lets you implement React client-side and server-side rendering in Laravel 5.5+ projects
integrating [ReactRenderer](https://github.com/Limenius/ReactRenderer) in this framework.

Features included:

* Prerender server-side React components for SEO, faster page loading, and users that have disabled JavaScript.
* Blade integration.
* Integration with Laravel Mix.

Check our example [here](https://github.com/jehupacheco/react-on-laravel-example)

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Context](#context)
- [Generator Functions](#generator-functions)
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

Now you can insert the registered React component in your blade template with our blade directive:

```
{!! @reactComponent('HelloWorld') !!}
```

or using the facade:

```
{!! ReactRenderer::reactRenderComponent('HelloWorld') !!}
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

## Generator Functions

In some cases you may want to do some custom Sever Side Rendering, for example, when
rendering meta tags with [React Helmet](https://github.com/nfl/react-helmet) on
rendering the resulting stylesheet from [Styled Components](http://styled-components.com/).

For that cases, you can use generator functions that, instead of returning a React
Component, can return an object and can freely be registered as the other React Components (using the ReactOnRails package in node).

The returning object should have an attibrute `renderedHtml` containing
another object with an attribute `componentHtml` including in this level any other attribute you want to render.

For instace, a generator function for rendering components that use Helmet will look
like:

```js
export default (initialProps, context) => {
    const renderedHtml = {
      componentHtml: renderToString(
        <MyApp/>
      ),
      title: Helmet.renderStatic().title.toString()
    };
    return { renderedHtml };
}
```

and you can insert the result in your views using our Facade and the `reactRenderComponentArray` method

```
@extends('base')

@php
    $app = ReactRenderer::reactRenderComponentArray('HelloWorld');
@endphp

@section('extra-meta-tags')
    {!! $app['title'] !!}
@endsection

@section('content')
    {!! $app['componentHtml'] !!}
@endsection
```

Our [example](https://github.com/jehupacheco/react-on-laravel-example) uses a
similar approach to include StyledComponents SSR.

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
