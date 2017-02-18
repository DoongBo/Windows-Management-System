<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<title>机房计算机管理系统</title>
	<link rel="stylesheet" type="text/css" href="/PCM/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/myStyle.css">     
</head>
<body>  
<div class="easyui-layout" fit="true">

	<div data-options="region:'north'" style="height:80px;background-color:#E0ECFF;background-image:url(/PCM/Public/Image/admin_logo.png); background-repeat:no-repeat">
    	<div style="position:absolute; right:10px; bottom:5px">你好：<?php echo ($type); echo ($name); ?><a href="<?php echo U('logout');?>" id="logout" class="easyui-linkbutton" style="margin-left:10px"data-options="iconCls:'icon-cancel'">注销</a></div>
    </div>
	<div data-options="region:'south'" style="height:40px; background-color:#E0ECFF; text-align:center; line-height:35px">
    	版权所有 © 2016数值计算及软件开发实践基地
    </div>
    <div data-options="region:'west',split:false" style="width:200px;font-size:20px">
        <div class="easyui-accordion" data-options="multiple:false,fit:true">
            <div title="实时监控" data-options="iconCls:'icon-edit'" style="overflow:auto;padding:10px;">
                <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-picture_edit'" style="width:100%" onclick="addTab('机器状态','<?php echo U('JFGL/detial');?>')">机器状态</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-search'" style="width:100%" onclick="addTab('在线学生','<?php echo U('JFGL/history');?>')">在线学生</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-search'" style="width:100%" onclick="addTab('未在线学生','<?php echo U('JFGL/history');?>')">未在线学生</a>
                </div>
            </div>
            <div title="统计报表" data-options="iconCls:'icon-edit'" style="padding:10px;">
                <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mail'" style="width:100%" onclick="addTab('按课程统计','<?php echo U('XXGL/message');?>')">按课程统计</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mail'" style="width:100%" onclick="addTab('按机房统计','<?php echo U('XXGL/notice');?>')">按机房统计</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mail'" style="width:100%" onclick="addTab('按学生统计','<?php echo U('XXGL/reply');?>')">按学生统计</a>
                </div>
            </div>
            <div title="消息管理" data-options="iconCls:'icon-print'" style="padding:10px;">
                <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mail'" style="width:100%" onclick="addTab('通知管理','<?php echo U('XXGL/message');?>')">通知管理</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mail'" style="width:100%" onclick="addTab('工作日志','<?php echo U('XXGL/notice');?>')">工作日志</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-mail'" style="width:100%" onclick="addTab('学生反馈','<?php echo U('XXGL/reply');?>')">学生反馈</a>
                </div>
            </div>
            <div title="我的课程" data-options="iconCls:'icon-email_edit'" style="padding:10px;">
                <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-email_edit'" style="width:100%" onclick="addTab('机房预约','<?php echo U('KCGL/course');?>')">机房预约</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-email_edit'" style="width:100%" onclick="addTab('上传课件','<?php echo U('KCGL/order');?>')">上传课件</a>
                </div>
            </div>
            <div title="查看课表" data-options="iconCls:'icon-save'" style="padding:10px;">
                <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-save'" style="width:100%" onclick="addTab('机房排课表','<?php echo U('WJGL/files');?>')">机房排课表</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-save'" style="width:100%" onclick="addTab('学生值班表','<?php echo U('WJGL/files');?>')">学生值班表</a>
                </div>
            </div>
            <div title="高级权限" data-options="iconCls:'icon-lock'" style="padding:10px;">
                <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-user_edit'" style="width:100%" onclick="addTab('机房机器信息','<?php echo U('GJQX/room');?>')">机房机器信息</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-user_edit'" style="width:100%" onclick="addTab('上课学生信息','<?php echo U('GJQX/student');?>')">上课学生信息</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-user_edit'" style="width:100%" onclick="addTab('授课教师信息','<?php echo U('GJQX/teacher');?>')">授课教师信息</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-redo'" style="width:100%" onclick="addTab('教师课程审核','<?php echo U('GJQX/verify');?>')">教师课程审核</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-user_edit'" style="width:100%" onclick="addTab('学生管理员信息','<?php echo U('GJQX/manager');?>')">学生管理员信息</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-redo'" style="width:100%" onclick="addTab('学生管理员日志','<?php echo U('GJQX/verify');?>')">学生管理员日志</a>
                    <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-redo'" style="width:100%" onclick="addTab('学生管理员值班','<?php echo U('GJQX/verify');?>')">学生管理员值班</a>
                </div>
            </div>
        </div>
    </div>
	<div data-options="region:'center'">
		<div id="tt" class="easyui-tabs" style="width:100%;height:100%;">
		</div>	
	</div>
</div>
<script type="text/javascript" src="/PCM/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/PCM/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/PCM/Public/Js/easyui-lang-zh_CN.js"></script>
<script>
function addTab(title, url){
	if ($('#tt').tabs('exists', title)){
		$('#tt').tabs('select', title);
	} else {
		var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:99%;"></iframe>';
		$('#tt').tabs('add',{
			title:title,
			content:content,
			closable:true
		});
	}
}	

</script>
    
</body>
</html>