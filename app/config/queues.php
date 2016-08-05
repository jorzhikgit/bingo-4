<?php

$upload_dir = app_path() . '/uploads/';
$download_url = url('/') . '/image/';

return [
	
	/**
	* Repositories Configuration
	*/
	'repository' => [
		'namespace' => 'Queue\Repositories\\',

		'list' => [
			'User',
		]
	],

	'image' => [
		'upload_dir'   => $upload_dir,
		'download_url' => $download_url
	]
];
