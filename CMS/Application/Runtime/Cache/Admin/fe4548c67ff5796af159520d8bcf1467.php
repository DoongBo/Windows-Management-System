<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/myStyle.css">
</head>

<body>
	<form id="upload" action="<?php echo U('upload1');?>" method="post" enctype="multipart/form-data">
        	<input class="easyui-filebox" name="file"/>
        	<input class="easyui-linkbutton" type="submit" value="导入" />
	</form>
    <img src="/CMS/Public/Upload/studuty.jpg" style="width:100%">
<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
</body>
</html>