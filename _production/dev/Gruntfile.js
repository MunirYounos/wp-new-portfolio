/**
 * Grunt configuration
 */

'use strict';
module.exports = function(grunt) {


	/**
	 * Setup
	 **/

	// Directory paths
	var path = {
		root: '../../',
		assets: '../../assets',
		devAssets: '../',
		ftpAuth: '.ftppass'
	};

	// JavaScript files for concatenation
	var concatScripts = [
		'<%= path.devAssets %>/scripts/jquery-3.2.1.js',
		'<%= path.devAssets %>/scripts/jquery.owl-carousel.js',
		'<%= path.devAssets %>/scripts/main.js',
	];

	// Load all tasks dependencies from package.json
	require('grunt');
	require('grunt-log-headers')(grunt);
	require('time-grunt')(grunt);
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-copy-modified');
	grunt.loadNpmTasks('grunt-ftpush');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-prompt');
	grunt.loadNpmTasks('grunt-sass');

	// FTP credentials
	var login = grunt.file.readJSON(path.ftpAuth);


	/**
	 * Grunt config
	 **/

	grunt.initConfig({

		// Helper configurations
		pkg: grunt.file.readJSON('package.json'),
		path: path,
		concatScripts: concatScripts,
		ftpType: '',
		ftpErrors: [],


		/**
		 * Sass compiling
		 * @package grunt-sass
		 **/

		sass: {
			options: {
				outputStyle: 'expanded',
				expand: true,
				includePaths: ['<%= path.devAssets %>/sass/'],
				sourceMap: true
			},
			dev: {
				files: {
					'<%= path.assets %>/css/main.css': '<%= path.devAssets %>/sass/main.scss'
				}
			}
		},


		/**
		 * CSS autoprefixing
		 * @package grunt-postcss
		 **/

		postcss: {
			options: {
				map: true,
				processors: [
					require('autoprefixer')({ browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'] }),
				]
			},
			dist: {
				src: '<%= path.assets %>/css/main.css'
			}
		},


		/**
		 * CSS minification
		 * @package grunt-contrib-cssmin
		 **/

		cssmin: {
			dist: {
				files: [{
					expand: true,
					cwd: '<%= path.assets %>/css',
					src: ['*.css', '!*.min.css'],
					dest: '<%= path.assets %>/css',
					ext: '.min.css'
				}]
			}
		},


		/**
		 * JavaScript file concatination
		 * @package grunt-contrib-concat
		 **/

		concat: {
			options: {
				seperator: ';'
			},
			all: {
				src: concatScripts,
				dest: '<%= path.assets %>/scripts/main.js'
			}
		},


		/**
		 * Minify JavaScript
		 * @package grunt-contrib-uglify
		 **/

		uglify: {
			options: {
				preserveComments: false,
				banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */',
				mangle: {
					except: ['jQuery']
				}
			},
			dist: {
				files: {
					'<%= path.assets %>/scripts/main.min.js': '<%= path.assets %>/scripts/main.js'
				}
			}
		},


		/**
		 * Copy images and fonts when modified
		 * @package grunt-copy-modified
		 **/

		copy_modified: {
			images: {
				files: [{
					cwd: '<%= path.devAssets %>/images',
					src: ['**/*.{jpg,jpeg,png,svg,gif}'],
					dest: '<%= path.assets %>/images'
				}]
			},
			fonts: {
				files: [{
					cwd: '<%= path.devAssets %>/fonts',
					src: ['**/*.{ttf,eot,woff,woff2,svg}'],
					dest: '<%= path.assets %>/fonts'
				}]
			}
		},


		/**
		 * FTP deployment
		 * @package grunt-ftpush
		 **/

		ftpush: {
			dev: {
				auth: {
					host: login.dev.host,
					port: 21,
					authKey: 'dev'
				},
				src: '<%= path.root %>',
				dest: 'gruntproject',
				simple: true,
				exclusions: [
					'_production',
					'.gitignore',
					'.git',
					'**/.DS_Store'
				]
			},
			live: {
				auth: {
					host: login.live.host,
					port: 21,
					authKey: 'live'
				},
				src: '<%= path.root %>',
				dest: 'gruntproject',
				simple: true,
				exclusions: [
					'_production',
					'.gitignore',
					'.git',
					'**/.DS_Store'
				]
			}
		},


		/**
		 * Watch
		 * @package grunt-contrib-watch
		 **/

		// Live
		watch: {
			options: {
				spawn: false,
				livereload: true
			},
			styles: {
				files: ['<%= path.devAssets %>/sass/**/*.scss'],
				tasks: ['sass:dev', 'postcss:dist', 'cssmin:dist']
			},
			scripts: {
				files: [
					'<%= path.devAssets %>/scripts/**/*.js',
					'Gruntfile.js'
				],
				tasks: ['concat:all', 'uglify:dist']
			},
			php: {
				files: ['<%= path.root %>/**/*.php']
			},
			images: {
				files: ['<%= path.devAssets %>/images/**/*.{png,svg,jpg,jpeg,gif}'],
				tasks: ['copy_modified:images']
			},
			fonts: {
				files: ['<%= path.devAssets %>/fonts/**/*.{ttf,eot,svg,woff,woff2}'],
				tasks: ['copy_modified:fonts']
			},
			ftp: {
				files: [
					'<%= path.root %>/**/*.php',
					'<%= path.devAssets %>/sass/**/*.scss',
					'<%= path.devAssets %>/scripts/**/*.js',
					'<%= path.devAssets %>/images/**/*.{png,svg,jpg,jpeg,gif}'
				],
				tasks: ['ftpush:<%= ftpType %>']
			}
		},


		/**
		 * Prompt user if proper login does not exist
		 * @package grunt-promt
		 **/

		prompt: {
			login: {
				options: {
					gruntLogHeader: false,
					questions: [
						{
							config: 'host',
							type: 'input',
							message: 'Indtast host:',
							validate: function(value) {
								return (value !== '') ? true : 'Feltet er tomt. Indtast en host.';
							},
							when: function() {
								return (grunt.config('ftpErrors').indexOf('host') !== -1) ? true : false;
							}
						},
						{
							config: 'username',
							type: 'input',
							message: 'Indtast username:',
							validate: function(value) {
								return (value !== '') ? true : 'Feltet er tomt. Indtast et username.';
							},
							when: function() {
								return (grunt.config('ftpErrors').indexOf('username') !== -1) ? true : false;
							}
						},
						{
							config: 'password',
							type: 'input',
							message: 'Indtast password:',
							validate: function(value) {
								return (value !== '') ? true : 'Feltet er tomt. Indtast et password.';
							},
							when: function() {
								return (grunt.config('ftpErrors').indexOf('password') !== -1) ? true : false;
							}
						}
					],
					then: function(results) {
						var task = grunt.config('ftpType');
						var errors = grunt.config('ftpErrors');

						// Add newly created information to existing object
						for ( var key in results ) {
							if ( login[task].hasOwnProperty(key) ) {
								if ( errors.indexOf(key) !== -1 ) {
									login[task][key] = results[key];
								} else {
									continue;
								}
							}
						}

						grunt.file.write(path.ftpAuth, JSON.stringify(login, null, 2));

						grunt.log.writeln('');
						grunt.log.writeln('FTP-oplysninger til '['magenta'] + task['magenta'].bold + '-task gemt.'['magenta']);
						grunt.log.writeln('');

						grunt.task.run('build');
					}
				}
			},
			confirm: {
				options: {
					gruntLogHeader: false,
					questions: [
						{
							config: 'confirmed',
							type: 'confirm',
							message: 'is the top FTP info correct?',
							default: true
						}
					],
					then: function(results) {
						if ( results.confirmed === true ) {
							grunt.task.run('build');
						} else {
							grunt.log.writeln('');
							grunt.log.writeln('Indtast nye FTP-informationer');
							grunt.config('ftpErrors', ['host', 'username', 'password']);
							grunt.task.run('prompt:login');
						}
					}
				}
			}
		}
	});


	/*
	 * Helper functions
	 **/

	// Check for empty FTP login information based on task
	function validateLoginKeys(authObj) {
		var errors = [];

		for ( var key in authObj ) {
			if ( authObj.hasOwnProperty(key)) {
				if ( authObj[key] === '' ) {
					errors.push(key);
				} else {
					continue;
				}
			}
		}

		return errors;
	}

	// Get saved credentials
	function getSavedLogin(task) {
		var cred = login[task];

		grunt.log.writeln('');
		grunt.log.writeln('=============================='['magenta']);
		grunt.log.writeln('Gemte FTP-informationer (' + task + '):');
		grunt.log.writeln('Host: ' + cred.host.bold);
		grunt.log.writeln('Username: ' + cred.username.bold);
		grunt.log.writeln('Password: ' + cred.password.bold);
		grunt.log.writeln('=============================='['magenta']);
		grunt.log.writeln('');
	}


	/*
	 * Helper tasks
	 **/

	// Check FTP login
	grunt.registerTask('ftp-check', 'Check for FTP credentials', function() {
		var task = grunt.config('ftpType');
		var authObj = login[task];
		var errors = validateLoginKeys(authObj);
		grunt.config('ftpErrors', errors);

		if ( errors.length ) {
			// Prompt for new login if errors are present
			grunt.log.error('FTP-login mangler følgende information(er): ' + errors.join(', ').bold);
			grunt.task.run('prompt:login');
		} else {
			getSavedLogin(task);
			grunt.task.run('prompt:confirm');
		}
	});

	// Watch task
	grunt.registerTask('build', 'Watch task', function() {
		var task = grunt.config('ftpType');

		grunt.task.run([
			'sass:dev',
			'postcss:dist',
			'cssmin:dist',
			'concat:all',
			'uglify:dist',
			'copy_modified:images',
			'copy_modified:fonts',
			'ftpush:' + task,
			'watch'
		]);
	});


	/*
	 * Default tasks
	 **/

	// Development task
	grunt.registerTask('dev', 'Development task', function() {
		grunt.config('ftpType', 'dev');
		grunt.task.run('ftp-check');
	});

	// Live task
	grunt.registerTask('live', 'Live task', function() {
		grunt.config('ftpType', 'live');
		grunt.task.run('ftp-check');
	});
};
