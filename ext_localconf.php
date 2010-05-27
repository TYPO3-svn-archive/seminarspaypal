<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seminars']['registration'][]
	= 'EXT:seminarspaypal/Hooks/class.tx_seminarspaypal_Hooks_MyEvents.php:' .
		'&tx_seminarspaypal_Hooks_MyEvents';
?>