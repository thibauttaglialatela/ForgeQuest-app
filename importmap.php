<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    '@ckeditor/ckeditor5-adapter-ckfinder/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-alignment/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-autoformat/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-autosave/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-basic-styles/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-block-quote/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-ckbox/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-ckfinder/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-clipboard/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-cloud-services/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-code-block/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-core/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-easy-image/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-editor-balloon/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-editor-classic/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-editor-decoupled/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-editor-inline/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-editor-multi-root/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-engine/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-enter/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-essentials/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-find-and-replace/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-font/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-heading/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-highlight/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-horizontal-line/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-html-embed/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-html-support/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-image/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-indent/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-language/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-link/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-list/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-markdown-gfm/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-media-embed/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-mention/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-minimap/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-page-break/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-paragraph/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-paste-from-office/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-remove-format/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-restricted-editing/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-select-all/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-show-blocks/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-source-editing/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-special-characters/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-style/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-table/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-typing/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-ui/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-undo/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-upload/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-utils/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-watchdog/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-widget/dist/index.js' => [
        'version' => '44.1.0',
    ],
    '@ckeditor/ckeditor5-word-count/dist/index.js' => [
        'version' => '44.1.0',
    ],
    'lodash-es' => [
        'version' => '4.17.21',
    ],
    'blurhash' => [
        'version' => '2.0.5',
    ],
    'marked' => [
        'version' => '4.0.12',
    ],
    'turndown' => [
        'version' => '7.2.0',
    ],
    'turndown-plugin-gfm' => [
        'version' => '1.0.2',
    ],
    'color-parse' => [
        'version' => '1.4.2',
    ],
    'color-convert' => [
        'version' => '2.0.1',
    ],
    'vanilla-colorful/lib/entrypoints/hex' => [
        'version' => '0.7.2',
    ],
    'color-name' => [
        'version' => '1.1.4',
    ],
    'chart.js' => [
        'version' => '3.9.1',
    ],
    '@ckeditor/ckeditor5-bookmark/dist/index.js' => [
        'version' => '44.1.0',
    ],
    'ckeditor5' => [
        'version' => '44.1.0',
    ],
    'ckeditor5/translations/fr.js' => [
        'version' => '44.1.0',
    ],
    'ckeditor5/dist/ckeditor5.min.css' => [
        'version' => '44.2.0',
        'type' => 'css',
    ],
];
