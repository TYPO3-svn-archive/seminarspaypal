<?php
/***************************************************************
* Copyright notice
*
* (c) 2010 Oliver Klee <typo3-coding@oliverklee.de>
* All rights reserved
*
* This script is part of the TYPO3 project. The TYPO3 project is
* free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* The GNU General Public License can be found at
* http://www.gnu.org/copyleft/gpl.html.
*
* This script is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once(t3lib_extMgm::extPath('oelib') . 'class.tx_oelib_Autoloader.php');

/**
 * Class tx_seminarspaypal_Hoooks_MyEvents for the "seminarspaypal" extension.
 *
 * This class provides a hook for adding an "add to cart" PayPal Button to the
 * "my events" list of the seminars extension.
 *
 * @package TYPO3
 * @subpackage tx_seminarspaypal
 *
 * @author Oliver Klee <typo3-coding@oliverklee.de>
 */
class tx_seminarspaypal_Hooks_MyEvents {

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Hooks/class.tx_seminarspaypal_Hooks_MyEvents.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Hooks/class.tx_seminarspaypal_Hooks_MyEvents.php']);
}
?>