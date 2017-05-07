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
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" onclick="doAdd()" >添加</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doEdit()" >编辑</a>	
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-redo" onclick="doImport()" >导入</a>
		<select id="types" class="easyui-combobox">
        	<option value="User_Num">学号</option>
        	<option value="User_Name">姓名</option>
        	<option value="User_Dept">学院</option>
            <option value="User_Class">班级</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="编辑"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form" method="post">
            <table>
                <tr>
                    <td>姓名:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Name"></input></td>
                </tr>
                <tr>
                    <td>学院:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Dept"></input></td>
                </tr>
                <tr>
                    <td>班级:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Class"></input></td>
                </tr>
            </table>
            <input class="easyui-textbox" type="hidden" name="User_Num"></input>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a></div>
    </div>
    <div id="win1" class="easyui-window" style="padding:10px" title="添加"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form1" method="post">
            <table>
            	<tr>
                    <td>学号:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Num"></input></td>
                </tr>
                <tr>
                    <td>姓名:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Name"></input></td>
                </tr>
                <tr>
                    <td>学院:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Dept"></input></td>
                </tr>
                <tr>
                    <td>班级:</td>
                    <td><input class="easyui-textbox" type="text" name="User_Class"></input></td>
                </tr>
            </table>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave1()">保存</a></div>
    </div>
    <div id="win2" class="easyui-window" style="padding:10px" title="导入信息"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="upload" action="<?php echo U('stuimport');?>" method="post" enctype="multipart/form-data">
        	<input class="easyui-filebox" name="file"/>
        	<a href="#" class="easyui-linkbutton" iconCls="icon-redo" onclick="doUpload()">导入</a>
        </form>
    </div>
    		

<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">

	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getstumessage');?>",
			method: 'post',
			title: '学生',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'User_Num',title:'学号',width:40},
				{field:'User_Name',title:'姓名',width:40},
				{field:'User_Dept',title:'学院',width:40},
				{field:'User_Class',title:'班级',width:80},
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
	function doDelete(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.post("<?php echo U('studelete');?>",
				{
					User_Num:row.User_Num,
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
				User_Num:row.User_Num,
				User_Name:row.User_Name,
				User_Dept:row.User_Dept, 
				User_Class:row.User_Class
			});				
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
	}
	function doAdd(){
		$('#win1').window('open');	
	}
	function doSave(){
		$('#form').form('submit', {
    		url:"<?php echo U('stusave');?>",
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
    		url:"<?php echo U('stusave1');?>",
    		success:function(data){
				if(data==1){
					$('#win').window('close');
					$.messager.alert('提示','添加成功!','info');
					$('#dg').datagrid('load');
				}else if(data==2){
					$.messager.alert('提示','添加失败!该用户已存在','info');
				}else{
					$.messager.alert('提示','添加失败!','info');
				}
    		}
		});
			
	}
	function doImport(){
		$('#win2').window('open');	
	}
	function doUpload(){
		$('#upload').submit();
	}
    
</script>
</body>
</html>