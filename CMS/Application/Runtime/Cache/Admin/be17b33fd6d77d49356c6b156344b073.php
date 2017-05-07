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
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" onclick="doEdit()" >编辑</a>	
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="doDelete()" >删除</a>
		<select id="types" class="easyui-combobox">
        	<option value="PCM_Num">机器号</option>
        	<option value="PCM_RoomName">机房名</option>
        	<option value="PCM_Mac">计算机MAC地址</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="编辑"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form" method="post">
            <table>
            	<tr>
                    <td>机器号:</td>
                    <td><input class="easyui-textbox" type="text" name="PCM_Num"></input></td>
                </tr>
            	<tr>
                    <td>机房名:</td>
                    <td>
                    	<label><input type="radio" name="PCM_RoomName" value="C303">C303</input></label>&nbsp;&nbsp;
                    	<label><input type="radio" name="PCM_RoomName" value="C305">C305</input></label>
                    </td>
                </tr>
                <tr>
                    <td>计算机MAC地址:</td>
                    <td><input class="easyui-textbox" type="text" name="PCM_Mac"></input></td>
                </tr>
            </table>
            <input type="hidden" name="PCM_Id"></input>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a></div>
    </div>
    		

<script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript">

	$(function(){
		$('#dg').datagrid({
			url: "<?php echo U('getpcmessage');?>",
			method: 'post',
			title: '机房信息',
			iconCls: 'icon-save',
			fit: true,
			fitColumns: true,
			singleSelect: true,
			pagination:true,
			pageSize:20,
			toolbar:"#tb",
			rownumbers:true,
			columns:[[
				{field:'PCM_Num',title:'机器号',width:40},
				{field:'PCM_RoomName',title:'机房名',width:40},
				{field:'PCM_Mac',title:'计算机MAC地址',width:80},
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
			$.post("<?php echo U('pcdelete');?>",
				{
					PCM_Id:row.PCM_Id ,
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
				PCM_Num:row.PCM_Num,
				PCM_RoomName:row.PCM_RoomName,
				PCM_Mac:row.PCM_Mac, 
				PCM_Id:row.PCM_Id

			});				
		}else{
			$.messager.alert('提示','没有选中项!','info');
		}
	}
	function doSave(){
		$('#form').form('submit', {
    		url:"<?php echo U('pcsave');?>",
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