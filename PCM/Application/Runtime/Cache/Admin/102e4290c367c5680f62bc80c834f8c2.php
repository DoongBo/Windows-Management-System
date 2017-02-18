<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/Public/Css/myStyle.css">
</head>

<body>
	<form id="upload" action="<?php echo U('upload');?>" method="post" enctype="multipart/form-data">
        	<input class="easyui-filebox" name="file"/>
        	<input class="easyui-linkbutton" type="submit" value="导入" />
	</form>
    <img src="/Public/Upload/course.jpg">
<script type="text/javascript" src="/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/Public/Js/easyui-lang-zh_CN.js"></script>
</body>
</html>