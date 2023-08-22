<?php

use Symfony\Component\Finder\SplFileInfo;

$sanitize = function (string $icon, SplFileInfo $file) {
    $disallowedAttributes = [
        '/<style>.*?<\/style>/s',
        '/ (?<=\s)id=".*?"/s',
        '/ (?<=\s)class=".*?"/s',
        '/ (?<=\s)height=".*?"/s',
        '/ (?<=\s)width=".*?"/s',
        '/ (?<=\s)fill=".*?"/s' => ' fill="currentColor"',
        '/ (?<=\s)stroke=".*?"/s' => ' stroke="currentColor"',
    ];

    $content = $file->getContents();

    foreach ($disallowedAttributes as $attribute => $replacement) {
        $content = preg_replace(
            is_int($attribute) ? $replacement : $attribute,
            is_int($attribute) ? '' : $replacement,
            $content
        );
    }

    file_put_contents($icon, $content);
};

return [
    [
        'source' => __DIR__.'/../node_modules/file-icon-vectors/dist/icons/classic',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 'c-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file);
        },
    ],
    [
        'source' => __DIR__.'/../node_modules/file-icon-vectors/dist/icons/square-o',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 's-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file);
        },
    ],
    [
        'source' => __DIR__.'/../node_modules/file-icon-vectors/dist/icons/vivid',
        'destination' => __DIR__.'/../resources/svg',
        'output-prefix' => 'v-',
        'safe' => true,
        'after' => static function (string $icon, array $config, SplFileInfo $file) use ($sanitize) {
            $sanitize($icon, $file);
        },
    ],
];
