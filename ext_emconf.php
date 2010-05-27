<?php

########################################################################
# Extension Manager/Repository config file for ext "seminarspaypal".
#
# Auto generated 27-05-2010 13:54
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
	'dependencies' => 'oelib,seminars',
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
	'author_company' => 'oliverklee.de',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.3.0-0.0.0',
			'oelib' => '0.7.0-',
			'seminars' => '0.9.0-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:9:{s:9:"ChangeLog";s:4:"442b";s:16:"ext_autoload.php";s:4:"84d6";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"5195";s:14:"ext_tables.php";s:4:"1dbf";s:38:"Configuration/TypoScript/constants.txt";s:4:"d41d";s:34:"Configuration/TypoScript/setup.txt";s:4:"284d";s:48:"Hooks/class.tx_seminarspaypal_Hooks_MyEvents.php";s:4:"6703";s:28:"Tests/Hooks/MyEventsTest.php";s:4:"aedb";}',
	'suggests' => array(
	),
);

?>