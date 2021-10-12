const mix = require('laravel-mix')
const SvgSpritemapPlugin = require('svg-spritemap-webpack-plugin')

const path = require('path')

require('laravel-mix-purgecss')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    plugins: [
        new SvgSpritemapPlugin([
                'resources/icons/*.svg',
            ], {
            output: {
                filename: 'public/symbol-defs.svg',
                chunk: {
                    keep: true
                } 
            },
            sprite: {
                prefix: 'icon-'
            }
        })
    ]
})

mix.options({
    terser: {
        extractComments: false
    },
    processCssUrls: false
})

mix
    .setPublicPath('./')
    .js('resources/js/main.js', 'public/js')
    .sass('resources/scss/styles.scss', 'public/css')
    .purgeCss({
        extend: {
            content: [
                path.join(__dirname, 'resources/views/**/*.php')
            ]
        }
    })
    .version()