<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'EXSA - Exhibition & Event Association of South Africa',

	// preloading 'log' component
	'preload'=>array('bootstrap','log'),
    //'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
    //'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'application.modules.admin.models.*',
	),

	'modules'=>array(
		'admin', //super admin module
        'company',
        // uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
                'bootstrap.gii', // since 0.9.1
            ),
		),
		
	),

	// application components
	'components'=>array(
        'clientScript' => array(
        
                // disable default yii scripts
                'scriptMap' => array(
                    'jquery.js'     => false,
                    'jquery.min.js' => false,
                    'jquery-ui.min.js' => false,
                    'jquery-ui-i18n.min.js'=>false,
                    'bootstrap-transition.js'=>false,
                    'jquery.color.js'=>false,
                    'bootstrap-tooltip.js'=>false,
                    'jquery.Jcrop.min.js'=>false,
                    'jquery.yiilistview.js'=>false,
                    'jquery.ba-bbq.js'=>false,
                    //'bootstrap-popover.js'=>false,
                    //'bootstrap-alert.js'=>false,
                    
                )
                ),
	'swiftMailer' => array(
            'class' => 'ext.swiftMailer.SwiftMailer',
        ),
        'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl'=>array('/member/login'),
		),
        'email'=>array(
        'class'=>'application.extensions.email.Email',
        'delivery'=>'php', //Will use the php mailing function.  
        //May also be set to 'debug' to instead dump the contents of the email into the view
        ),
		
        //load component bootstrap
        'bootstrap'=>array(
            'class'=>'ext.bootstrap.components.Bootstrap', 
        ),
        //load image manipulation component
        'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            //'params'=>array('directory'=>'/opt/local/bin'),
        ),
        'file'=>array(
        'class'=>'application.extensions.file.CFile',
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'caseSensitive'=>false, 
			'rules'=>array(
            'admin'=>'admin/login',
            'admin/dashboard'=>'admin/login/dashboard',
            'admin/logout'=>'admin/login/logout',
            'company/logout'=>'company/login/logout',
            'contact'=>'site/contact',
            'about'=>'content/about',
            'terms-and-conditions'=>'content/terms',
            'privacy-policy'=>'content/privacy',
            'news-guidelines'=>'content/newsGuidelines',
            'membership'=>'content/membership',
            '<pages:about|membership>/<slug>'=>'content/subpages/subpage/<slug>',
            'advertise'=>'content/advertise',
            'contract'=>'content/contract',
            'map'=>'find/map',
            'download/filename/<filename>'=>'site/download/filename/<filename>',
            'feed'=>'site/feed',
			'special-feed'=>'site/feed',
			'news-feed'=>'site/newsfeed',
			'jobs-feed'=>'site/jobsfeed',
            'sitemap.xml'=>'site/sitemap',
            'find'=>'find/index',
            'signup'=>'signup/index',
            'confirm'=>'signup/confirm',
            'confirm/<code>' => 'signup/confirm/code/<code>',
            'search'=>'search/index',
            'gii'=>'gii',
            'emailtosubscriber'=>'emailtosubscriber/index',
            
            //'confirmation/hash/<hash>'=>'member/confirmation/<hash>',
            'clubs/'=>'clubs/index',
            'clubs/create'=>'clubs/create',
            'clubs/details'=>'clubs/details',
            'clubs/unfollow'=>'clubs/unfollow',
            'clubs/follow'=>'clubs/follow',
            'clubs/type/<match>'=>'clubs/type/match/<match>',
            'clubs/type'=>'clubs/type',
            'clubs/<slug>'=>'clubs/details/slug/<slug>',
            
            'events/'=>'events/index',
            
            'directory/contact'=>'directory/contact',
            'directory/countContact'=>'directory/countContact',
            'directory/organisers'=>'directory/index/filter/organisers',
            'directory/venues'=>'directory/index/filter/venues',
            'directory/service-providers'=>'directory/index/filter/service-providers',
            'directory/associate-members'=>'directory/index/filter/associate-members',
            'directory/preview/<slug>'=>'directory/preview/slug/<slug>',
            'directory/service'=>'directory/service',
            'directory/service/<slug>'=>'directory/service/slug/<slug>',
            'directory/service/<slug>/showall'=>'directory/service/slug/<slug>/showall',
            'directory/showall'=>'directory/index/showall',
            'directory/index'=>'directory/index',
            'directory/<slug>'=>'directory/details/slug/<slug>',
            
            'company/news/edit/<slug>'=>'company/news/update/slug/<slug>',
            'company/news/delete/<slug>'=>'company/news/delete/slug/<slug>',
            'company/news'=>'company/news/index',
            
            'company/jobs/edit/<slug>'=>'company/jobs/update/slug/<slug>',
            'company/jobs/delete/<slug>'=>'company/jobs/delete/slug/<slug>',
            'company/jobs'=>'company/jobs/index',
            
            'company/resources/<slug>'=>'company/resources/viewdocs/slug/<slug>',
            
            'news'=>'articles/index',
            'news/showall'=>'articles/index/showall',
            'news/order/<slug>'=>'articles/index/order/<slug>',
            'news/order/<slug>/showall'=>'articles/index/order/<slug>/showall',
            'news/tag/<slug>'=>'articles/index/tag/<slug>',
            'news/tag/<slug>/showall'=>'articles/index/tag/<slug>/showall',
            'news/company/<slug>'=>'articles/index/company/<slug>',
            'news/company/<slug>/showall'=>'articles/index/company/<slug>/showall',
            'news/downloads/<slug>'=>'articles/downloads/docslug/<slug>',
            'news/search'=>'articles/index',
            'news/<slug>'=>'articles/view/slug/<slug>',
            'approve-news/<slug>'=>'articles/approval/slug/<slug>',
            'articles/approve/<slug>'=>'articles/approve/slug/<slug>',
            'articles/reject/<slug>'=>'articles/reject/slug/<slug>',
            'articles/downloads/<slug>'=>'articles/downloads/docslug/<slug>',
            
            'jobs/showall'=>'jobs/index/showall',
            'jobs/search'=>'jobs/index',
            'jobs/province/<slug>'=>'jobs/province/slug/<slug>',
                        
            'page/<id:\d+>'=>'site/index/page/<id>',
            '/showall'=>'site/index/showall',
            
            'events/index'=>'events/index',
            'events/view/<slug>'=>'events/view',
            'events/listRemaining'=>'events/listRemaining',  
            'events/showall'=>'events/index/showall',
            'events/search'=>'events/search',
            'events/search/showall'=>'events/search/showall',
            
            'events/loadTime'=>'events/loadTime',
            
            'dashboard'=>'dashboard/index',
            'profile/<slug>'=>'dashboard/details/slug/<slug>',
            '<controller:\w+>/<id:\d+>'=>'<controller>/view',
			'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            
			),
		),
		
        /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
        */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=gorun',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
            'discardOutput' => false,
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
			
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail' => 'justdoit2045@gmail.com',

        //new fb credential for autopost
        'fb_app_id' => '322888744507902',
        'fb_secret_id' => 'c9107c9b5d930326aafb0116c693fe44',
        'page_id' => '350682401664996',
        'user_access_token' => 'CAAElqmTrGf4BALRrgv28rLaeaPsJd2eSHD2OI3dRhzxSF3XYNV2nPiaxZARAnuK1xoa0aoGSz6gUhn5BDBxDumFRom9tjCHeXQIQvmEShWkaKsf9DfZBhYQfrMJbvh9Ls2BQAXjhvzZCj5FoGOH7mjLomC80A8SRnI5cVGhlv74sdlST681ZCEZCZCFusK2JgZD',

        'twitter_user'=>'exsa_sa',
        'twitter_consumer_key'=>'x5Pn2tUoO4hfF9gD0YQ3MONOG',
        'twitter_consumer_secret'=>'mfWtclbBO6QwkR56dSL0iALSXVytDa7zTCxqJsBUIhrDFRDNNU',
        'twitter_access_token'=>'570850595-kZcUJvWJFatOYcYyMm7V7vlSJ462ir22syZTJC0o',
        'twitter_access_token_secret'=>'XuOShmKfV79CwaWWGJaJgeCXDkRNWJeJoEFoTgBtPH9Gv',

        'ip2location_key' => '8faee27e7591bd3c5a731f98ea92c68f5c93cd37e111558b18abf96f78ec3df6',
        'items_pers_page' => '10',
        'articles_pers_page' => '2',
        'jobs_pers_page'=>'10',
        'defaultCountryId' => '224',
        'image_size' => '10',   //image upload size in MB
        'audio_size' => '10',   //audio upload size in MB
        'doc_size' => '10',   //document upload size in MB
        'site_name'=>'Go Run South Africa'
	),
);