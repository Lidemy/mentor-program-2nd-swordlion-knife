var gulp = require('gulp');
var sass = require('gulp-sass');
var babel = require('gulp-babel');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var clean = require('gulp-clean');
var autoprefixer = require('gulp-autoprefixer');


gulp.task('styles',['clean'],()=> {
    gulp.src('./source/*.scss')   
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false,
            remove:true 
        }))
        .pipe(rename({
        	suffix: '.min'
        }))
        .pipe(gulp.dest('./output'));
});

gulp.task('es5', ['clean'],()=> {
	gulp.src('./source/*.js')
		.pipe(babel({
			"presets": ["env"]
		}))
        .pipe(uglify())
        .pipe(rename({
        	suffix: '.min'
        }))
        .pipe(gulp.dest('./output'));
});

gulp.task('clean', ()=>{
	return gulp.src('./output/*')
		.pipe(clean());
});