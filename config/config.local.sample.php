<?php

/*
*	Config file: Local environment
*
*/

return array(

	'db' => array(
		'server' => 'localhost',
		'user' => 'root',
		'password' => 'root',
		'database' => '',
	),

	'devMode' => true,
	'phpMaxMemoryLimit' => '256M',
  'backupDbOnUpdate' => true,
  'translationDebugOutput' => false,
  'useCompressedJs' => false,
  'enableTemplateCaching' => false,
  'userSessionDuration'           => 'P101Y',
	'rememberedUserSessionDuration' => 'P101Y',
	'rememberUsernameDuration'      => 'P101Y',

	//'testToEmailAddress'  => 'tester@testingtesting123.com',

);
