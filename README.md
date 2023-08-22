# Blade File Type Icons

![Latest Stable Version](https://img.shields.io/packagist/v/log1x/blade-filetype-icons.svg?style=flat-square)
![Total Downloads](https://img.shields.io/packagist/dt/log1x/blade-filetype-icons.svg?style=flat-square)
![Build Status](https://img.shields.io/github/actions/workflow/status/log1x/blade-filetype-icons/compatibility.yml?branch=master&style=flat-square)

A package to easily make use of [file-icon-vectors](https://github.com/dmhendricks/file-icon-vectors) by [Daniel Hendricks](https://github.com/dmhendricks) in your Laravel Blade views.

For a full list of available icons, see [the SVG directory](resources/svg) or the [original repo](https://github.com/dmhendricks/file-icon-vectors/tree/master/dist/icons).

## Requirements

- PHP 8.0 or higher
- Laravel 9.0 or higher

## Installation

```bash
$ composer require log1x/blade-filetype-icons
```

## Blade Icons

Blade File Type Icons uses Blade Icons under the hood. Please refer to [the Blade Icons readme](https://github.com/blade-ui-kit/blade-icons) for additional functionality. We also recommend to [enable icon caching](https://github.com/blade-ui-kit/blade-icons#caching) with this library.

## Configuration

Blade File Type Icons also offers the ability to use features from Blade Icons like default classes, default attributes, etc. If you'd like to configure these, publish the `blade-filetype-icons.php` config file:

```bash
php artisan vendor:publish --tag=blade-filetype-icons-config
```

## Usage

Icons can be used as self-closing Blade components which will be compiled to SVG icons:

```blade
<x-filetype-c-exe />
```

You can also pass classes to your icon components:

```blade
<x-filetype-c-exe class="w-6 h-6 text-gray-500" />
```

And even use inline styles:

```blade
<x-filetype-c-exe style="color: #555" />
```

Or use the `@svg` directive:

```blade
@svg('filetype-c-exe', 'w-6 h-6', ['style' => 'color: #555'])
```

The vivid icons can be referenced like this:

```blade
<x-filetype-v-exe />
```

The square-o icons can be referenced like this:

```blade
<x-filetype-s-exe />
```

### Raw SVG Icons

If you want to use the raw SVG icons as assets, you can publish them using:

```bash
php artisan vendor:publish --tag=blade-filetype-icons --force
```

Then use them in your views like:

```blade
<img src="{{ asset('vendor/blade-filetype-icons/v-exe.svg') }}" width="10" height="10"/>
```

## Bug Reports

If you discover a bug in Blade File Type Icons, please [open an issue](https://github.com/Log1x/blade-filetype-icons/issues).

## Contributing

Contributing whether it be through PRs, reporting an issue, or suggesting an idea is encouraged and appreciated.

## License

Blade File Type Icons is provided under the [MIT License](LICENSE.md).
