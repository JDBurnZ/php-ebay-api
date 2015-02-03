A simple, easy to use class for interfacing with eBay's Developer Network Finding, Shopping and Trading Service APIs in PHP.

Example:

	$app_name = 'XXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; // Enter your app name API credentials here.
	$ebay = new eBay($app_name);
	
	// Perform a FindingService call:
	$search_result = $ebay->finding->findItemsByKeywords(
		array(
			'keywords' => 'Mega Man X SNES', // Your search terms.
			'affiliate.networkId' => '9', // 9 = eBay Partner Network.
			'affiliate.trackingId' => '5337631828', // eBay Partner Network Campaign ID.
			'paginationInput.entriesPerPage' => '3', // Number of results to display on a single page.
			'sortOrder' => 'PricePlusShippingLowest', // Sort, showing lowest priced items first.
			'itemFilter(0).name' => 'ListingType',
			'itemFilter(0).value' => 'AuctionWithBIN', // Only show "Buy It Now" listings.
			'categoryId' => '139973' // Only search the Video Games category
		)
	);
	print_r($search_result);
