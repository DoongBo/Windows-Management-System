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
		<select id="types" class="easyui-combobox">
       		<option value="Record_PCNum">机器号</option>
            <option value="Record_RoomName">机房名</option>
            <option value="Record_InTime">登录时间</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
   
    		

<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">

	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('gethistory');?>",
			method: 'post',
			title: '机器使用历史',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'Record_RoomName',title:'机房名',width:10},
				{field:'Record_PCNum',title:'机器号',width:20},
				{field:'Record_CourseName',title:'课程名',width:20},
				{field:'Record_Num',title:'学号',width:30},
				{field:'Record_Name',title:'姓名',width:20},
				{field:'Record_InTime',title:'登录时间',width:30},
				{field:'Record_OutTime',title:'登出时间',width:30},
				{field:'Record_RecordMHTsrc',title:'详情',width:20},
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
</body>
</html>