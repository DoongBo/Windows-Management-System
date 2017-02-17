<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/PCM/Public/Css/myStyle.css">    
</head>

<body>
    <table id="dg" ></table>
    <div id="tb">
    <a href="<?php echo U('excel');?>" class="easyui-linkbutton" iconCls="icon-redo" >导出</a>
		<select id="types" class="easyui-combobox">
       		<option value="Record_PCNum">机器号</option>
            <option value="Record_RoomName">机房名</option>
            <option value="Record_InTime">登录时间</option>
            <option value="award">获奖状况</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
   
    		

<script type="text/javascript" src="/PCM/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/PCM/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/PCM/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">

	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getmessage');?>",
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
				{field:'num',title:'报名序号',width:40},
				{field:'groups',title:'组别',width:40},
				{field:'username',title:'邮箱',width:80},
				{field:'name1',title:'成员1',width:50},
				{field:'class1',title:'班级1',width:80},
				{field:'tel1',title:'电话1',width:80},
				{field:'name2',title:'成员2',width:50},
				{field:'class2',title:'班级2',width:80},
				{field:'tel2',title:'电话2',width:80},
				{field:'name3',title:'成员3',width:50},
				{field:'class3',title:'班级3',width:80},
				{field:'tel3',title:'电话3',width:80},
				{field:'school',title:'学校',width:80},
				{field:'teacher',title:'指导教师',width:50},
				{field:'address',title:'邮寄地址',width:100},
				{field:'question',title:'选题',width:50},
				{field:'award',title:'获奖状况',width:50},
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
</html><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
上机详情
</body>
</html>