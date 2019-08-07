var gulp  = require( 'gulp' );
var zip   = require( 'gulp-zip' );
var wpPot = require( 'gulp-wp-pot' );

gulp.task( 'dist-archive', function(){

	var src = [
		'**/*',
		//'!vendor{,/**}',
		'!node_modules{,/**}',
		'!src{,/**}',
		'!Gulpfile.js',
		'!webpack.config.js',
		'!composer.json',
		'!composer.lock',
		'!package.json',
		'!package-lock.json',
		'!phpcs.xml',
	];

	return gulp.src( src )
        .pipe( zip('my-theme.zip') )
        .pipe( gulp.dest( './..' ) );
});

gulp.task( 'pot', function () {

	var src = [
		'**/*.php',
		'!vendor/**',
		'!node_modules/**',
	];

    return gulp.src( src )
        .pipe( wpPot( {
            domain: 'my-theme',
            package: 'MyTheme',
        }))
        .pipe( gulp.dest( 'languages/my-theme.pot' ) );
});
