<?php

return array(
	'version' => '0.9.4.1',
	'pgcache.enabled' => false,
	'pgcache.engine' => 'file_generic',
	'dbcache.enabled' => false,
	'dbcache.engine' => 'file',
	'objectcache.enabled' => false,
	'objectcache.engine' => 'file',
	'cdn.enabled' => false,
	'cdn.engine' => 'cf',
	'varnish.enabled' => false,
	'varnish.servers' => array(
		0 => '',
	),
	'widget.pagespeed.enabled' => true,
	'widget.pagespeed.key' => '',
	'config.check' => true,
	'cdn.debug' => false,
	'pgcache.file.nfs' => false,
	'minify.file.nfs' => false,
	'dbcache.file.locking' => false,
	'objectcache.file.locking' => false,
	'pgcache.file.locking' => false,
	'minify.file.locking' => false,
);