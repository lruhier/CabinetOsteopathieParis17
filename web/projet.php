<?php
try {
	/*if (isset($_SERVER['HTTP_CLIENT_IP'])
	    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	    || !(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1', '82.67.217.46')) || php_sapi_name() === 'cli-server')
	) {
	    header('HTTP/1.0 403 Forbidden');
		var_dump($_SERVER['HTTP_CLIENT_IP'],$_SERVER['HTTP_X_FORWARDED_FOR'],$_SERVER['REMOTE_ADDR']);
		var_dump(!(in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1', '82.67.217.46'))))
		var_dump(php_sapi_name());
	    //exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
	}*/


	$file = '../CabinetOsteopathieParis17.zip';
	$zip = new ZipArchive;
	$res = $zip->open($file);
	if ($res !== TRUE) throw new \Exception('Extraction failed');
	$zip->extractTo('../');
	$zip->close();

	$dir = realpath('../cache/prod');
	$tmpdir = realpath(uniqid('../cache/prod'));
	if (!rename($dir, $tmpdir)) throw new \Exception('Clear cache failed');

	$files = new RecursiveIteratorIterator(
	    new RecursiveDirectoryIterator($tmpdir, RecursiveDirectoryIterator::SKIP_DOTS),
	    RecursiveIteratorIterator::CHILD_FIRST
	);

	foreach ($files as $fileinfo) {
	    $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
	    $todo($fileinfo->getRealPath());
	}

	rmdir($tmpdir);

	header('Location: /');
	exit;

} catch (\Exception $e) {
	die((string)$e);
}