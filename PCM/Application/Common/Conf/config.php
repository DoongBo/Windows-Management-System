<?php
return array(
	//'配置项'=>'配置值'
		'TMPL_PARSE_STRING'     => array(
			'__CSS__'			=> __ROOT__.'/Public/Css',		    //CSS目录
			'__JS__'			=> __ROOT__.'/Public/Js',			//JS目录
			'__IMAGE__'			=> __ROOT__.'/Public/Image',		//IMAGE目录
			'__UPLOAD__'        => __ROOT__.'/Public/Upload',		//上传文件目录
			'__FONTS__'        	=> __ROOT__.'/Public/Fonts',		//字体文件目录
		),

	


	'SHOW_PAGE_TRACE'=>false,
	'URL_CASE_INSENSITIVE'=>false,
	'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
    'WEB_PUBLIC_URL'=>__ROOT__.'/Public',   
	
	
	'DB_HOST'   => '59.72.212.6',						       		// 服务器地址
	'DB_NAME'	=> 'DB_PCM',	                           	    	// 数据库名
	'DB_USER'	=> 'PCMMANAGER',						           	    // 用户名
	'DB_PWD'	=> 'rjyfzx',											// 密码
	'DB_PREFIX'	=> 't_',										// 数据库表前缀
	'DB_TYPE'	=> 'mysql',					  					//数据库类型
	

);