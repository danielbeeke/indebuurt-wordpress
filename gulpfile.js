'use strict';

let gulp = require('gulp');
let browserSync = require('browser-sync').create();
let reload = browserSync.reload;
let autoprefixer = require('gulp-autoprefixer');
let sass = require('gulp-sass');
let sassGlob = require('gulp-sass-glob');

gulp.task('css', function () {
  return gulp.src('indebuurt/scss/style.scss')
    .pipe(sassGlob())
    .pipe(sass())
    .pipe(autoprefixer({
      browsers: ['last 20 versions'],
      cascade: false
    }))
    .pipe(gulp.dest('indebuurt'))
    .pipe(browserSync.stream());
});

gulp.task('browsersync', () => {
  browserSync.init({
    proxy: 'http://192.168.99.100:8000'
  });

  gulp.watch('indebuurt/scss', gulp.series('css'));
});

gulp.task('serve', gulp.series('css', 'browsersync'));
