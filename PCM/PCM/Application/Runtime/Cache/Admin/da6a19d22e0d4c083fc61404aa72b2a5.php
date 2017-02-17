<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/myStyle.css">   
</head>

<body>
<form action="<?php echo U('getupload');?>" method="post" enctype="multipart/form-data">
        <input class="easyui-filebox" name="file" style="width:200px"/>
        <input class="easyui-linkbutton" type="submit" value="导入" />
</form>
<p>请勿改变表头结构</p>
<script type="text/javascript" src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/easyui-lang-zh_CN.js"></script>
</body>
</html>