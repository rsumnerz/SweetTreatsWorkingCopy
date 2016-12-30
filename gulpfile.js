var gulp = require('gulp'),
	postCss = require('gulp-postcss'),
	watch = require('gulp-watch'),
	importCss = require('postcss-import'),
	nested = require('postcss-nested'),
	variable = require('postcss-simple-vars'),
	autoprefixer = require('autoprefixer'),
	refresh = require('browser-sync').create(),
	nunjucksrender = require('gulp-nunjucks-render'),
	webpack = require('webpack');


//update app.js when a change is made in a JS file using webpack//
gulp.task('scripts',function(callback){
	webpack(require('./webpack.config.js'), function(err,stats){
		if(err){
			console.log(err.toString());
		}
		console.log(stats.toString());
		callback();
	});
});


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

		
		// watch("js/**/*.js",function(){
		// 	refresh.reload();
		// 	});
		//refresh webpage call to scriptsRefresh to make sure scripts runs first
		watch('js/*.js',function(){
			gulp.start('scriptsRefresh');
		});

		watch('mainCss/**/*.css', function(){
			gulp.start('cssInject');
		});

		
	});

	//runs scripts and reloads page
	 gulp.task('scriptsRefresh',['scripts'], function(){
	 	refresh.reload();
	 });

	gulp.task('cssInject', ['style'], function(){
		gulp.src('css/style.css')
		.pipe(refresh.stream());
	});

	











