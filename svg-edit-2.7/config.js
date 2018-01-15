/*globals svgEditor*/

svgEditor.setConfig({

	extPath : baseUrl + '/svg-edit-2.7/extensions/',
	imgPath : baseUrl + '/svg-edit-2.7/images/',
	langPath : baseUrl + '/svg-edit-2.7/locale/',
	extensions : ['ext-server_opensave.js'
	// 'ext-eyedropper.js',
	// 'ext-shapes.js',
	// 'ext-polygon.js',
	// 'ext-star.js'
	],
	//emptyStorageOnDecline: true
	allowedOrigins : [window.location.origin] // May be 'null' (as a string) when used as a file:// URL
});

// svgEditor.loadFromURL(baseUrl + "/upload/logo.svg");
