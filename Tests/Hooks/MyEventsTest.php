<?php
/***************************************************************
* Copyright notice
*
* (c) 2010 Oliver Klee (typo3-coding@oliverklee.de)
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
 * Testcase for the tx_seminarspaypal_Hoooks_MyEvents class in the
 * "seminarspaypal" extension.
 *
 * @package TYPO3
 * @subpackage tx_seminarspaypal
 *
 * @author Oliver Klee <typo3-coding@oliverklee.de>
 */
class tx_seminarspaypal_Hooks_MyEventsTest extends tx_phpunit_testcase {
	/**
	 * @var tx_seminarspaypal_Hoooks_MyEvents
	 */
	private $fixture;

	/**
	 * @var tx_oelib_testingFramework
	 */
	private $testingFramework;

	public function setUp() {
		$this->testingFramework
			= new tx_oelib_testingFramework('tx_seminarspaypal');
		$this->fixture = new tx_seminarspaypal_Hooks_MyEvents();
	}

	public function tearDown() {
		$this->testingFramework->cleanUp();

		unset($this->fixture, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function foo() {

	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Tests/Hooks/MyEventsTest.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Tests/Hooks/MyEventsTest.php']);
}
?>