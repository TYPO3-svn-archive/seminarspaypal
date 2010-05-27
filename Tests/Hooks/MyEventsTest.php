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
	 * @var tx_seminarspaypal_Hooks_MyEvents
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

		$configuration = new tx_oelib_Configuration();
		$configuration->setData(
			array(
				'currency' => 'EUR',
				'email' => 'workshops@example.com',
				'locale' => 'DE',
			)
		);
		tx_oelib_ConfigurationRegistry::getInstance()
			->set('plugin.seminarspaypal', $configuration);
	}

	public function tearDown() {
		$this->testingFramework->cleanUp();

		unset($this->fixture, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForPaidNonFreeRegistrationNotSetsTotalPriceMarker() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(TRUE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.00));

		$template = $this->getMock(
			'tx_oelib_Template', array('setMarker')
		);
		$template->expects($this->never())->method('setMarker');

		$this->fixture->modifyMyEventsListRow($registration, $template);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidFreeRegistrationNotSetsTotalPriceMarker() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(0.00));

		$template = $this->getMock(
			'tx_oelib_Template', array('setMarker')
		);
		$template->expects($this->never())->method('setMarker');

		$this->fixture->modifyMyEventsListRow($registration, $template);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationCopiesTotalPriceMarkerContent() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.00));

		$event = $this->getMock('tx_seminars_Model_Event');
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			'42.00 EUR',
			$template->getSubpart('X')
		);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationSetsCurrencyFromConfiguration() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.99));

		$event = $this->getMock('tx_seminars_Model_Event');
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			'name="currency_code" value="EUR"',
			$template->getSubpart('X')
		);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationSetsEmailFromConfiguration() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.99));

		$event = $this->getMock('tx_seminars_Model_Event');
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			'name="business" value="workshops@example.com"',
			$template->getSubpart('X')
		);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationSetsLocaleFromConfiguration() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.99));

		$event = $this->getMock('tx_seminars_Model_Event');
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			'name="lc" value="DE"',
			$template->getSubpart('X')
		);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationSetsUidFromRegistration() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.99));
		$registration->expects($this->any())->method('getUid')
			->will($this->returnValue(1234));

		$event = $this->getMock('tx_seminars_Model_Event');
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			'name="item_number" value="1234"',
			$template->getSubpart('X')
		);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationSetsSeatsFromRegistration() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.99));
		$registration->expects($this->any())->method('getSeats')
			->will($this->returnValue(4));

		$event = $this->getMock('tx_seminars_Model_Event');
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			' (4)"',
			$template->getSubpart('X')
		);
	}

	/**
	 * @test
	 */
	public function modifyMyEventsListRowForUnpaidNonFreeRegistrationSetsTitleFromEvent() {
		$registration = $this->getMock(
			'tx_seminars_Model_Registration',
			array('isPaid', 'getTotalPrice', 'getUid', 'getSeats', 'getEvent')
		);
		$registration->expects($this->any())->method('isPaid')
			->will($this->returnValue(FALSE));
		$registration->expects($this->any())->method('getTotalPrice')
			->will($this->returnValue(42.99));

		$event = $this->getMock('tx_seminars_Model_Event', array('getTitle'));
		$event->expects($this->any())->method('getTitle')
			->will($this->returnValue('Scream & shout'));
		$registration->expects($this->any())->method('getEvent')
			->will($this->returnValue($event));

		$template = $this->getMock('tx_oelib_Template', array('getMarker'));
		$template->processTemplate(
			'<!--###X###-->###TOTAL_PRICE###<!--###X###-->'
		);
		$template->expects($this->any())->method('getMarker')
			->with('total_price')->will($this->returnValue('42.00 EUR'));

		$this->fixture->modifyMyEventsListRow($registration, $template);

		$this->assertContains(
			'name="item_name" value="Scream &amp; shout (',
			$template->getSubpart('X')
		);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Tests/Hooks/MyEventsTest.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Tests/Hooks/MyEventsTest.php']);
}
?>