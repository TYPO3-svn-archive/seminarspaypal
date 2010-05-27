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
	/**
	 * Adds an "add to cart" PayPal button for non-free registrations that have
	 * not been paid for.
	 *
	 * @param tx_seminars_Model_Registration $registration
	 *        the affected registration
	 * @param tx_oelib_Template $template
	 *        the template from which the list row is built
	 */
	public function modifyMyEventsListRow(
		tx_seminars_Model_Registration $registration, tx_oelib_Template $template
	) {
		if ($registration->isPaid() || ($registration->getTotalPrice() == 0.00)) {
			return;
		}

		$configuration = tx_oelib_ConfigurationRegistry::get('plugin.seminarspaypal');

		$originalContent = $template->getMarker('total_price');

		$newContent = $originalContent . '&nbsp;' .
			'<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">' .
			'<div style="display: inline;">' .
			'<input type="hidden" name="cmd" value="_cart" />' .
			'<input type="hidden" name="business" value="' .
				htmlspecialchars($configuration->getAsString('email')) . '" />' .
			'<input type="hidden" name="lc" value="' .
				htmlspecialchars($configuration->getAsString('locale')) . '" />' .
			'<input type="hidden" name="item_name" value="' .
				htmlspecialchars($registration->getEvent()->getTitle()) . ' (' .
				$registration->getSeats() . ')" />' .
			'<input type="hidden" name="item_number" value="' . $registration->getUid() . '" />' .
			'<input type="hidden" name="amount" value="' . $registration->getTotalPrice(). '" />' .
			'<input type="hidden" name="currency_code" value="' .
				htmlspecialchars($configuration->getAsString('currency')) . '" />' .
			'<input type="hidden" name="button_subtype" value="products" />' .
			'<input type="hidden" name="no_note" value="0" />' .
			'<input type="hidden" name="add" value="1" />' .
			'<input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest" />' .
			'<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_cart_LG.gif" ' .
				'name="submit" alt="PayPal - The safer, easier way to pay online." />' .
			'<img alt="" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" />' .
			'</div>' .
			'</form>'
				;

		$template->setMarker('total_price', $newContent);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Hooks/class.tx_seminarspaypal_Hooks_MyEvents.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/seminarspaypal/Hooks/class.tx_seminarspaypal_Hooks_MyEvents.php']);
}
?>