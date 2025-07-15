const config = require('../../gulpconfig')(),
    $ = require('gulp-load-plugins')(),
    stylish = require('jshint-stylish'),
    jshint = require('gulp-jshint'),
    gulp = require('gulp');

function jsConcat() {
    return gulp.src(config.source.jsLibs)
        .pipe($.plumber())
        .pipe($.concat('default-libs.js'))
        .pipe(gulp.dest(config.source.jsFile))
        .pipe($.uglify({
            mangle: {
                toplevel: true
            },
            compress: {
                drop_console: true
            },
            output: {
                beautify: false,
                comments: false
            }
        }))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.plumber.stop())
        .pipe(gulp.dest(config.target.js))
        .pipe($.gzip())
        .pipe(gulp.dest(config.target.js));
}

function jsMain() {
    return gulp.src(config.source.mainJS)
        .pipe($.uglify({
            compress: {
                unused: false
            }
        }))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(config.target.js))
        .pipe($.gzip())
        .pipe(gulp.dest(config.target.js));
}

function jsForm() {
    return gulp.src(config.source.formJs)
        .pipe($.uglify({
            compress: {
                unused: false
            }
        }))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(config.target.formJs))
        .pipe($.gzip())
        .pipe(gulp.dest(config.target.formJs));
}


function jsLint () {
    return gulp.src(config.source.mainJS)
        .pipe($.eslint('.eslintrc.json'))
        .pipe($.eslint.format())
        .pipe($.eslint.failAfterError())
}

const js = gulp.series(jsLint, gulp.parallel(jsConcat, jsMain, jsForm));
exports.js = js;
gulp.task('js', gulp.series(jsLint, gulp.parallel(jsConcat, jsMain, jsForm)));
exports.jsConcat = jsConcat;
exports.jsMain = jsMain;
gulp.task('js-lint', jsLint);
gulp.task('js-concat', jsConcat);
gulp.task('js-main', jsMain);
gulp.task('js-form', jsForm);

exports.jsConcat = jsConcat;
exports.jsMain = jsMain;