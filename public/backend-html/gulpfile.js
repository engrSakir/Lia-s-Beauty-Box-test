//gulpfile.js
const gulp = require('gulp'),
    minifyCSS = require('gulp-clean-css'),
    uglify = require('gulp-uglify'),
    rename = require("gulp-rename"),
    sass = require('gulp-sass');


const sassFiles = 'dist/scss/*.scss',
    cssDest = 'assets/backend/dist/css/';
	pagescss = 'dist/scss/pages/**/*.scss';
	pagecssdest = 'assets/backend/dist/css/pages/';
//compile scss into css
function style() {

    //1. Where is my scss
    return gulp.src(sassFiles)

        //2.pass through compiler
        .pipe(sass().on('error', sass.logError))

        //3.wher to save css
        .pipe(gulp.dest(cssDest))

}

//compile pages scss into css
function pagesstyle() {

    //1. Where is my scss
    return gulp.src(pagescss)

        //2.pass through compiler
        .pipe(sass().on('error', sass.logError))

        //3.wher to save css
        .pipe(gulp.dest(pagecssdest))

}


//This is for the minify css
function minifycss() {
    return gulp.src(['assets/backend/dist/css/*.css', '!assets/backend/dist/css/**/*.min.css'])
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest(cssDest))
}

// This is for the minifyjs
function minifyjs() {
    return gulp.src(['assets/backend/dist/js/custom.js', '!assets/backend/dist/js/custom.min.js'])
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'))
}

function watch() {
    gulp.watch(['dist/scss/**/*.scss'], style);
    gulp.watch(['dist/scss/pages/**/*.scss'], pagesstyle);
    gulp.watch(['assets/backend/dist/css/style.css'], minifycss);
    gulp.watch(['assets/backend/dist/js/custom.js', '!assets/backend/dist/js/custom.min.js'], minifyjs);
}


gulp.task('default', watch);

exports.style = style;
exports.minifycss = minifycss;
exports.minifyjs = minifyjs;
exports.watch = watch;
