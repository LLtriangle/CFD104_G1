const {
    src,
    dest,
    series,
    parallel,
    watch
} = require('gulp');

const fileinclude = require('gulp-file-include');

function includeHTML() {
    return src('html/*.html')
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest('./'));
}

//watch files
exports.w = function watchs() {
    watch(['html/*.html', 'html/**/*.html'], includeHTML);
}

const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
// 上線用
function ugjs(){
    return src('js/*.js')
    .pipe(uglify())
    .pipe(rename({
        extname: '.min.js',
    }))
    .pipe(dest('./'));
}

exports.js = ugjs


const cleanCSS = require('gulp-clean-css');

function cleanC() {
    return src('css/*.css') // 來源
    .pipe(cleanCSS()) // 壓縮
    .pipe(rename({
        extname: '.min.css',
    }))
    .pipe(dest('css')) // 目的地
}


var concat = require('gulp-concat');

function concatcss(){
    return src('css/*.css')
    .pipe(concat('all.css'))
    .pipe(dest('css/all/'))
}

exports.allcss  = concatcss;


// sass編譯
const sass = require('gulp-sass')(require('sass'));

function sassstyle() {
    return src('./sass/*.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(dest('./assets/css'));
}

exports.scss  = sassstyle;


// 組合任務
exports.all = series(ugjs,cleanC)

// exports.css = cleanC