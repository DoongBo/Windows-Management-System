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
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doEdit()" >编辑</a>	
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a>
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="编辑"  data-options="iconCls:'icon-save',modal:true,closed:true,fit:true">
        <form id="form" method="post">
           	<div style="padding:20px; text-align:center">
    			标题：<input class="easyui-textbox" style="width:300px" type="text" name="title">
    			时间：<input class="easyui-textbox" type="text" name="time" value="<?php echo ($date); ?>">
    		</div>
    		<script id="container" name="content" type="text/plain"></script>
    		<input type="hidden" name="id">
            <div style="text-align:center; margin-top:5px">
           		<a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a>
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
			url: "<?php echo U('getnews');?>",
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
				{field:'title',title:'标题',width:40},
				{field:'time',title:'时间',width:80},
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
	function doEdit(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#win').window('open');
			$('#form').form('load',{
				title:row.title,
				time:row.time, 
				id:row.id
			});	
			ue.setContent(row.content);
			
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