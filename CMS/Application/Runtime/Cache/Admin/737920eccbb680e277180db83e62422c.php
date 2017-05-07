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
 	<table id="dg" ></table>
    <div id="tb">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" onclick="doAdd()" >新建</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doEdit()" >编辑</a>	
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a>
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="新建"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form" method="post">
           	<div style="padding:20px; text-align:center">
    			标题：<input class="easyui-textbox" style="width:300px" type="text" name="title">
    			时间：<input class="easyui-textbox" type="text" name="time" value="<?php echo ($date); ?>">
    		</div>
    		<textarea name="content" style="width:100%; height:300px"></textarea>
            <input type="hidden" name="name" value="<?php echo ($name); ?>">
            <div style="text-align:center; margin-top:5px">
           		<a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a>
            </div>	
     	</form>	     
        
    </div>
    <div id="win1" class="easyui-window" style="padding:10px" title="编辑"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form1" method="post">
           	<div style="padding:20px; text-align:center">
    			标题：<input class="easyui-textbox" style="width:300px" type="text" name="title">
    			时间：<input class="easyui-textbox" type="text" name="time" value="<?php echo ($date); ?>">
    		</div>
    		<textarea name="content" style="width:100%; height:300px"></textarea>
            <input type="hidden" name="name" value="<?php echo ($name); ?>">
    		<input type="hidden" name="id">
            <div style="text-align:center; margin-top:5px">
           		<a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave1()">保存</a>
            </div>	
     	</form>	     
        
    </div>
 
	<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">
	
	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getnotice');?>",
			method: 'post',
			title: '最新公告',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'Notice_Title',title:'标题',width:60},
				{field:'Notice_Content',title:'内容',width:100},
				{field:'Notice_Sender',title:'发布人',width:20},
				{field:'Notice_Time',title:'发布时间',width:40}
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
			$.post("<?php echo U('notice_delete');?>",
				{
					id:row.Notice_Id,
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
	function doAdd(){
		$('#win').window('open');
	}
	function doEdit(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#win1').window('open');
			$('#form1').form('load',{

				title:row.Notice_Title,
				content:row.Notice_Content,
				time:row.Notice_Time, 
				id:row.Notice_Id
			});	
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
	}
	function doSave(){
		$('#form').form('submit', {
    		url:"<?php echo U('notice_save');?>",
    		success:function(data){
				if(data==1){
					$('#win').window('close');
					$.messager.alert('提示','保存成功!','info');
					$('#dg').datagrid('load'); 
				}else{
					$.messager.alert('提示','保存失败!','info');
				}
    		}
		});	
	}
	function doSave1(){
		$('#form1').form('submit', {
    		url:"<?php echo U('notice_save1');?>",
    		success:function(data){
				if(data==1){
					$('#win1').window('close');
					$.messager.alert('提示','保存成功!','info');
					$('#dg').datagrid('load'); 
				}else{
					$.messager.alert('提示','保存失败!','info');
				}
    		}
		});	
	}
    
</script>
</body>
</html>