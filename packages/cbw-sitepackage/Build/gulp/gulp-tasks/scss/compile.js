const config = require('../../gulpconfig')(),
    $ = require('gulp-load-plugins')(),
    gulp = require('gulp'),
    minify = require('gulp-clean-css'),
    sass = require('gulp-sass')(require('sass'));

function gzip () {
     return  gulp.src(config.target.css + '*.css')
        .pipe($.gzip())
        .pipe($.debug())
        .pipe(gulp.dest(config.target.css));
}


function scssMain () {
     return gulp.src(config.source.scssSelection)
        .pipe($.sourcemaps.init())
        .pipe(sass({
                silenceDeprecations: ['legacy-js-api', 'mixed-decls', 'color-functions', 'global-builtin', 'import', 'abs-percent'],
                indentWidth: 2,
            }
        ))
        .pipe($.autoprefixer({
            cascade: false
        }))
        .pipe($.debug())
        .pipe($.cssbeautify({
            indent: '   ',
            openbrace: 'seperate-line',
            autosemicolon: true
        }))
        .pipe(gulp.dest(config.source.css))
        .pipe(minify())
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.sourcemaps.write('./'))
        .pipe(gulp.dest(config.target.css));
}
function scssRte () {
     return gulp.src(config.source.rteCss)
        .pipe($.sourcemaps.init())
        .pipe(sass({
                silenceDeprecations: ['legacy-js-api', 'mixed-decls', 'color-functions', 'global-builtin', 'import', 'abs-percent'],
            }
        ))
        .pipe($.autoprefixer({
            cascade: false
        }))
        .pipe($.debug())
        .pipe($.cssbeautify({
            indent: '   ',
            openbrace: 'seperate-line',
            autosemicolon: true
        }))
        .pipe(gulp.dest(config.source.css))
        .pipe($.cssmin())
        .pipe(gulp.dest(config.target.rteCss));
}

const scss = gulp.series(scssMain, scssRte, gzip);
exports.scss = scss;
exports.gzip = gzip;
gulp.task('css', scssMain);
gulp.task('gzip', gzip);