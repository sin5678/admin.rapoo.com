<?php

return [
	'App\Http\Controllers\ArticlesController'	=>
		[
			'title'         => ['search' => "rap_news.title like CONCAT('%', ?, '%')"],
	   	],
	'App\Http\Controllers\NewTypeController'	=>
		[
			'newtypename'   => ['search' => "rap_newtype.NewTypeName like CONCAT('%', ?, '%')"],
	   	],
	'App\Http\Controllers\DocumentTypeController'	=>
		[
			'documenttypename'   => ['search' => "rap_documenttype.DocumentTypeName like CONCAT('%', ?, '%')"],
	   	],
	'App\Http\Controllers\ProductDocumentController'	=>
		[
			'documentname'   => ['search' => "rap_productdocument.DocumentName like CONCAT('%', ?, '%')"],
	   	],
	'App\Http\Controllers\JobController'	=>
		[
			'position'   => ['search' => "rap_joinus.Position like CONCAT('%', ?, '%')"],
	   	],
	'App\Http\Controllers\SupplyController'	=>
		[
			'companyname'   => ['search' => "rap_services.CompanyName like CONCAT('%', ?, '%')"],
			'servicetype'   => ['search' => "rap_services.ServiceType = ?"],
	   	],
	'App\Http\Controllers\ProxyController'	=>
		[
			'companyname'   => ['search' => "rap_proxy.CompanyName like CONCAT('%', ?, '%')"],
		],
	'App\Http\Controllers\SiteSpellController'	=>
		[
			'title'   	=> ['search' => "rap_sitespell.Title like CONCAT('%', ?, '%')"],
			'country'   => ['search' => "rap_sitespelldetail.Language = ?"],
	   	],

];