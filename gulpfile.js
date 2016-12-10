var gulp = require('gulp'),
	postCss = require('gulp-postcss'),
	watch = require('gulp-watch'),
	importCss = require('postcss-import'),
	nested = require('postcss-nested'),
	variable = require('postcss-simple-vars'),
	autoprefixer = require('autoprefixer'),
	refresh = require('browser-sync').create(),
	nunjucksrender = require('gulp-nunjucks-render');


	gulp.task('style', function(){
		gulp.src('mainCss/style.css')
		.pipe(postCss([importCss, nested, variable, autoprefixer]))
		.pipe(gulp.dest('css'));
	});


	gulp.task('nunjucks', function(){
		return gulp.src('structureCompile/**/*.html')
		.pipe(nunjucksrender({
			path:['templates']
			}))
		.pipe(gulp.dest('app'));
		});


	gulp.task('watch', ['nunjucks'], function(){
		refresh.init({
			notify:false,
			server:{
				baseDir:''
			}
		});

		watch('index.html', function(){
			refresh.reload();
		});

		watch('structureCompile/**/*.html', ['nunjucks']);

		
		watch("js/**/*.js", function(){
			refresh.reload();
			});

		watch('mainCss/**/*.css', function(){
			gulp.start('cssInject');
		});
	});


	gulp.task('cssInject', ['style'], function(){
		gulp.src('css/style.css')
		.pipe(refresh.stream());
	});











