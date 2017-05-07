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
	<div id="tb">
		<select id="types" class="easyui-combobox">
        	<option value="u_num">报名序号</option>
            <option value="question">选题</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
	<table id="dg"></table>
</body>
<script type="text/javascript" src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">
	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getdownload');?>",
			method: 'post',
			title: '报名信息',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'u_num',title:'报名序号',width:40},
				{field:'question',title:'选题',width:50},
				{field:'file1',title:'论文',width:50},
				{field:'file2',title:'数据',width:50},
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
	function doSearch(){
		$('#dg').datagrid('load', { 
		 	"types": $('#types').combobox('getValue'), 
			"searchs": $('#searchs').val() 
		}); 
    }
</script>
</html>