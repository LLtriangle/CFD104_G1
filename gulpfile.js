const {
    src,
    dest,
    series,
    parallel,
    watch
} = require('gulp');


function missionA(cb) {
    console.log('missionA');
    cb();
}


function missionB(cb) {
    console.log('missionB');
    cb();
}

exports.async = series(missionB , missionA); // 先執行 missionA 在執行missionB
exports.sync =   parallel(missionA , missionB); //兩個任務同時執行


function copy(){
     return src('html/a.html').pipe(dest('./'))// 由html/a.html 搬到 ./
}

exports.c = copy // 任務執行





const fileinclude = require('gulp-file-include');

function includeHTML() {
    return src('html/*.html')
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(dest('./dist'));
}

//watch files
exports.w = function watchs() {
    watch(['html/*.html', 'html/**/*.html'], includeHTML);
}

//2.js
//上線用---> uglify、改為min檔
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');

function ugjs(){
    return src ('js/*.js')
    .pipe(babel({
        presets: ['@babel/env']
    })) //es6 -> es5
    .pipe(uglify()) //先uglify 壓縮
    .pipe(rename({
        extname : '.min.js' //加上副檔名
    }))
    .pipe(dest('./dist/js')); //將檔案放到跟目錄下
}

// exports.js = ugjs

//css 壓縮
const cleanCSS = require('gulp-clean-css');

function cleanC() {
    return src('css/*.css') //來源
    .pipe(cleanCSS()) //壓縮
    .pipe(dest('css/min')) //目的地
}

// exports.css = cleanC

//合併css

var concat = require('gulp-concat');

function concatCss(){
    return src('css/*.css')
    .pipe(concat('all.css'))
    .pipe(dest('css/all/'))
}

exports.allcss  = concatCss;

//3.sass編譯
const sass = require('gulp-sass')(require('sass'));


function sassstyle() {
    return src('./sass/*.scss')
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(dest('./dist/css'));
}

exports.scss  = sassstyle;

//組合任務

exports.all = series(ugjs, cleanC)

//圖片搬家
function mv_img(){
    return src('imag/*.*').pipe(dest('dist/images'))
}

//4.瀏覽器同步
const browserSync = require('browser-sync');
const reload = browserSync.reload;

function browser(done) {
    browserSync.init({
        server: {
            baseDir: "./",
            index: "index.html"
        },
        port: 3000
    });
    done();
    watch(['html/*.html', 'html/**/*.html'], includeHTML).on('change', reload);
    watch(['js/*.js', 'js/**/*.js'], ugjs).on('change', reload);
    watch(['sass/*.scss', 'sass/**/*.scss'], sassstyle).on('change', reload);
    watch();
}


exports.default  = series(paeallel(mv_img, includeHTML, ugjs, sassstyle), browser);

//圖片壓縮 (上線用)

const imagemin = require('gulp-imagemin');

function min_images(){
    return src('img/*.*')
    .pipe(imagemin([
        imagemin.mozjpeg({quality: 70, progressive: true}) // 壓縮品質      quality越低 -> 壓縮越大 -> 品質越差 
    ]))
    .pipe(dest('dist/images'))
}

exports.img = min_images;
