const mix = require('laravel-mix')
const path = require('path')
const directory = path.basename(path.resolve(__dirname))

const source = `platform/plugins/${directory}`
const dist = `public/vendor/core/plugins/${directory}`

mix.js(`${source}/resources/js/notification-plus.js`, `${dist}/js`).copy(`${dist}/js`, `${source}/public/js`)
