<?php
	require 'vendor/mustache/mustache/src/Mustache/Autoloader.php';
	Mustache_Autoloader::register();

	$mustache = new Mustache_Engine(array(
		'template_class_prefix' => '__MyTemaplate_',
		//'cache' => dirname(__FILE__). '/tmp/cache/mustache',
		'cache_file_mode' => 0666,
		'cache_lambda_templates' => true,
		'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/views'),
		'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/views/partials'),
		'helpers' => array('i18n' => function($text){
			// do something translatey here...
		}),
		'escape' => function($value){
			return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
		},
		'charset' => 'ISO-8859-1',
		'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
		'strict_callables' => true,
		'pragmas' => [Mustache_Engine::PRAGMA_FILTERS],
	));

	$tpl = $mustache->loadTemplate('sample'); // loads __DIR__.'/views/sample.mustache'
	echo $tpl->render(array('bar' => 'baz'));


	$m = new Mustache_Engine;

	echo $m->render('Hello, {{ planet }}!', 
	array('planet'=>'World this is a mustache project sample'));// this printout hello world
