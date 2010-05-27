<?php

########################################################################
# Extension Manager/Repository config file for ext "seminarspaypal".
#
# Auto generated 27-05-2010 13:34
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'PayPal integration for seminars',
	'description' => 'This extension adds "add to card" PayPal buttons to the "my events" list of the seminars extension in a very quick-and-dirty way.',
	'category' => 'fe',
	'author' => 'Oliver Klee',
	'author_email' => 'typo3-coding@oliverklee.de',
	'shy' => '',
	'dependencies' => 'seminars',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'seminars' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:7:{s:9:"ChangeLog";s:4:"442b";s:12:"ext_icon.gif";s:4:"1bdc";s:14:"ext_tables.php";s:4:"e215";s:19:"doc/wizard_form.dat";s:4:"766f";s:20:"doc/wizard_form.html";s:4:"2085";s:48:"static/paypal_seminars_integration/constants.txt";s:4:"d41d";s:44:"static/paypal_seminars_integration/setup.txt";s:4:"284d";}',
);

?>