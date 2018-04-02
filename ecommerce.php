<?php
/**
 * Enhanced Ecommerce Payloads
 * @link https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide?hl=ru (Docs)
 * @link https://github.com/Eldaeron/php-ga-tools (Script)
 *
 */

namespace PhpGaTools;

class EnhancedEcommerce
{
	function purchase($orderId, $revenue, array $products, $affiliation = '', $tax = 0, $shipping = 0, $coupon = false){
		$transaction = array(
			'pa' => 'purchase',		// Product action (purchase). Required.
			'ti' => $orderId,		// Transaction ID. Required.
			'ta' => $affiliation,		// Transaction Affiliation Example "Google Store Online"
			'tt' => $tax,			// Transaction tax.
			'ts' => $shipping,		// Transaction shipping.
			'tr' => $revenue,		// Revenue
			'tcc' => $coupon		// Transaction coupon
		);

		for ($i=0; $i < count($products); $i++) {
			$n = $i+1;
			$transaction["pr{$n}id"] = $products[$i]['id'];			// Product 1 ID. Either ID or name must be set.
			$transaction["pr{$n}nm"] = $products[$i]['name'];		// Product 1 name. Either ID or name must be set.
			$transaction["pr{$n}pr"] = $products[$i]['price'];		// Product 1 Price.
			$transaction["pr{$n}qt"] = $products[$i]['qty'];		// Product 1 quantity.
			$transaction["pr{$n}ca"] = $products[$i]['category'];	// Product 1 category.
			$transaction["pr{$n}br"] = $products[$i]['brand'];	// Product 1 brand.
		}

		return $transaction;
	}
}
