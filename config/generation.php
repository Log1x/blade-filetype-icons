<?php

use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

$sanitize = function (string $icon, SplFileInfo $file, array $except = []) {
    $disallowedAttributes = [
        'style' => '/<style>.*?<\/style>/s',
        'id' => '/ (?<=\s)id=".*?"/s',
        'class' => '/ (?<=\s)class=".*?"/s',
        'height' => '/ (?<=\s)height=".*?"/s',
        'width' => '/ (?<=\s)width=".*?"/s',
        'fill' => ['/ (?<=\s)fill="(?!(#fff|#ffffff|white|currentColor)).*?"/s' => ' fill="currentColor"'],
        'stroke' => ['/ (?<=\s)stroke="(?!(#fff|#ffffff|white|currentColor)).*?"/s' => ' stroke="currentColor"'],
    ];

    $colors = [
        'st0',
        'st1',
        'st2',
        'st3',
        'st4',
        'st5',
        'st6',
        'st7',
    ];

    $disallowedAttributes = collect($disallowedAttributes)
        ->reject(function ($value, $key) use ($except) {
            return in_array($key, $except);
        })
        ->toArray();

    $content = $file->getContents();

    $content = str_replace('<svg ', '<svg fill="currentColor" ', $content);

    foreach ($colors as $color) {
        $matches = [
            ".{$color}{fill:#fff}",
            ".{$color}{fill:#ffffff}",
            ".{$color}{fill:white}",
        ];

        if (Str::contains($content, $matches)) {
            $content = str_replace("class=\"{$color}\"", 'fill="#fff"', $content);
        }
    }

    foreach ($disallowedAttributes as $attribute) {
        $value = is_array($attribute) ? array_keys($attribute)[0] : $attribute;
        $replacement = is_array($attribute) ? array_values($attribute)[0] : '';

        $content = preg_replace($value, $replacement, $content);
    }

    file_put_contents($icon, $content);
};

return [
    [
        'source' => __DIR__.'/../vendor/dmhendricks/file-icon-vectors/dist/icons/classic',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 'c-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file, ['fill', 'stroke']);
        },
    ],
    [
        'source' => __DIR__.'/../vendor/dmhendricks/file-icon-vectors/dist/icons/square-o',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 's-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file);
        },
    ],
    [
        'source' => __DIR__.'/../vendor/dmhendricks/file-icon-vectors/dist/icons/vivid',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 'v-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file);
        },
    ],
    [
        'source' => __DIR__.'/../vendor/dmhendricks/file-icon-vectors/dist/icons/extra',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 'e-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file, ['fill', 'stroke']);
        },
    ],
    [
        'source' => __DIR__.'/../vendor/dmhendricks/file-icon-vectors/dist/icons/high-contrast',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 'hc-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file);
        },
    ],
];
