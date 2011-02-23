#!/usr/bin/php
<?php

$paths = array(
	get_include_path(),
	realpath(dirname(__FILE__) . '/../'),
);

set_include_path(implode(PATH_SEPARATOR, $paths));
mb_internal_encoding('UTF-8');

require_once 'Launcher/SimpleLauncher.php';
require_once 'Column/Column.php';

// параметры
$config = array();
$params = array(
	'i|input'	=> '',
	'f|file'	=> '',
	'a|action'	=> 'columnize',
);

// обработать консольный ввод
$slConf = new SimpleLauncher;
$config = $slConf->getConfig($params, $argv);

// reading file
$file = array_pop($argv);
if (!file_exists($file)) {
	throw new Exception('No such file: ' . $file);
}
$in = file_get_contents($file);

// run
$out = '';
$class = 'Column';
$action = $config['action'];

$dict = new $class();

$out = $dict->$action($in);

echo $out;
