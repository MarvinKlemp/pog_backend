var gulp = require('gulp')
var gutil = require('gulp-util')
var browserify = require('browserify')
var source = require('vinyl-source-stream')
var streamify = require('gulp-streamify')
var uglify = require('gulp-uglify')

gulp.task('js', function() {
  return browserify('./app/assets/js/index.js')
    .bundle()
    .on('error', gutil.log)
    .pipe(source('index.js'))
    .pipe(streamify(uglify()))
    .pipe(gulp.dest('./web/js'))
})

gulp.task('watch', function() {
  gulp.watch('app/assets/js/**', ['js'])
})

gulp.task('default', ['js', 'watch'])
