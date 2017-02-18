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
 	<table id="dg" ></table>
    <div id="tb">
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doSee()" >详情</a>	
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a>
	</div>
    <div id="win" class="easyui-window" style="padding:10px; width:600px; height:400px" title="详情"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form" method="post">
           	<div id="artical" style="margin-bottom:10px">
            </div>
    		<script id="container" name="content" type="text/plain"></script>
    		<input type="hidden" name="id">
            <div style="text-align:center; margin-top:5px">
           		<a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">回复</a>
            </div>
            <div>
            	<table id="reply" border="1" width="550px"></table>
            </div>	
     	</form>	     
        
    </div>
 
	<script type="text/javascript" src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="/djb/Public/Js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/djb/Public/Js/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="/djb/Public/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/djb/Public/Ueditor/ueditor.all.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('container',{
    		toolbars: [
        		['fullscreen', 'source', 'undo', 'redo', 'bold','indent','italic','underline','strikethrough','fontborder','fontfamily','fontsize','simpleupload','justifyleft','justifyright','justifycenter','justifyjustify','forecolor','attachment','imagecenter']
    		],
    		autoHeightEnabled: true,
    		autoFloatEnabled: true
		});
	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getartical');?>",
			method: 'post',
			title: '论坛管理',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			columns:[[
				{field:'title',title:'主题',width:80},
				{field:'u_username',title:'发言人',width:40},
				{field:'time',title:'时间',width:40},
			]],
			onHeaderContextMenu: function(e, field){
				e.preventDefault();
				if (!cmenu){
					createColumnMenu();
				}
				cmenu.menu('show', {
					left:e.pageX,
					top:e.pageY
				});
			}
		});
	});
	var cmenu;
	function createColumnMenu(){
		cmenu = $('<div/>').appendTo('body');
		cmenu.menu({
			onClick: function(item){
				if (item.iconCls == 'icon-ok'){
					$('#dg').datagrid('hideColumn', item.name);
					cmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-empty'
					});
				} else {
					$('#dg').datagrid('showColumn', item.name);
					cmenu.menu('setIcon', {
						target: item.target,
						iconCls: 'icon-ok'
					});
				}
			}
		});
		var fields = $('#dg').datagrid('getColumnFields');
		for(var i=0; i<fields.length; i++){
			var field = fields[i];
			var col = $('#dg').datagrid('getColumnOption', field);
			cmenu.menu('appendItem', {
				text: col.title,
				name: field,
				iconCls: 'icon-ok'
			});
		}
	}
	function doDelete(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.post("<?php echo U('delete');?>",
				{
					id:row.id,
				},function(data){
					if(data==1){
						$.messager.alert('提示','删除成功!','info');
						$('#dg').datagrid('load'); 
					}else{
						alert(data);
					}
			});
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
    }
	function doSee(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.post("<?php echo U('see');?>",
				{
					id:row.id,
				},function(data){
					$('#artical').html(row.content);
					$('#reply').html(data);
					$('#form').form('load',{
						id:row.id
					});	
					$('#win').window('open');
				
			});
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
	}
	function doSave(){
		$('#form').form('submit', {
    		url:"<?php echo U('save');?>",
    		success:function(data){
				if(data==1){
					$('#win').window('close');
					$.messager.alert('提示','回复成功!','info');
					$('#dg').datagrid('load'); 
				}else{
					$.messager.alert('提示','回复失败!','info');
				}
    		}
		});
			
	}
    
</script>
</body>
</html>