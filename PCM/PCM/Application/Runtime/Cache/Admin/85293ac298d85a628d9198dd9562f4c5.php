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
    <a href="<?php echo U('excel');?>" class="easyui-linkbutton" iconCls="icon-redo" >导出</a>
		<select id="types" class="easyui-combobox">
        	<option value="num">报名序号</option>
        	<option value="groups">组别</option>
        	<option value="username">邮箱</option>
        	<option value="name1">成员1</option>
       		<option value="class1">班级1</option>
            <option value="tel1">电话1</option>
            <option value="name2">成员2</option>
       		<option value="class2">班级2</option>
            <option value="tel2">电话2</option>
            <option value="name3">成员3</option>
       		<option value="class3">班级3</option>
            <option value="tel3">电话3</option>
            <option value="school">学校</option>
       		<option value="teacher">指导教师</option>
            <option value="address">邮寄地址</option>
            <option value="question">选题</option>
            <option value="award">获奖状况</option>
    	</select>
     	<input id="searchs" class="easyui-textbox">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="doSearch()">查询</a>	
	</div>
    <div id="win" class="easyui-window" style="padding:10px" title="编辑"  data-options="iconCls:'icon-save',modal:true,closed:true">
        <form id="form" method="post">
            <table>
            	<tr>
                    <td>组别:</td>
                    <td>
                    	<label><input type="radio" name="groups" value="本科生">本科生</input></label>&nbsp;&nbsp;
                    	<label><input type="radio" name="groups" value="研究生">研究生</input></label>
                    </td>
                </tr>
                <tr>
                    <td>邮箱:</td>
                    <td><input class="easyui-textbox" type="text" name="username"></input></td>
                </tr>
                <tr>
                    <td> 成员1:</td>
                    <td><input class="easyui-textbox" type="text" name="name1"></input></td>
                </tr>
                <tr>
                    <td>班级1:</td>
                    <td><input class="easyui-textbox" type="text" name="class1"></input></td>
                </tr>
                <tr>
                    <td>电话1:</td>
                    <td><input class="easyui-textbox" type="text" name="tel1"></input></td>
                </tr>
                <tr>
                    <td>成员2:</td>
                    <td><input class="easyui-textbox" type="text" name="name2"></input></td>
                </tr>
                <tr>
                    <td> 班级2:</td>
                    <td><input class="easyui-textbox" type="text" name="class2"></input></td>
                </tr>
                <tr>
                    <td> 电话2:</td>
                    <td><input class="easyui-textbox" type="text" name="tel2"></input></td>
                </tr>
                <tr>
                    <td>成员3:</td>
                    <td><input class="easyui-textbox" type="text" name="name3"></input></td>
                </tr>
                <tr>
                    <td>班级3:</td>
                    <td><input class="easyui-textbox" type="text" name="class3"></input></td>
                </tr>
                <tr>
                    <td>电话3:</td>
                    <td><input class="easyui-textbox" type="text" name="tel3"></input></td>
                </tr>
                <tr>
                    <td>学校:</td>
                    <td><input class="easyui-textbox" type="text" name="school"></input></td>
                </tr>
                <tr>
                    <td>指导教师:</td>
                    <td><input class="easyui-textbox" type="text" name="teacher"></input></td>
                </tr>
                <tr>
                    <td>邮寄地址:</td>
                    <td><input class="easyui-textbox" type="text" name="address"></input></td>
                </tr>
                <tr>
                    <td>选题:</td>
                    <td><input class="easyui-textbox" type="text" name="question"></input></td>
                </tr>
                <tr>
                    <td>获奖状况:</td>
                    <td><input class="easyui-textbox" type="text" name="award"></input></td>
                </tr>
            </table>
            <input type="hidden" name="id"></input>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a></div>
    </div>
    		

<script type="text/javascript" src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/easyui-lang-zh_CN.js"></script>
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
				groups:row.groups,
				username:row.username,
				name1:row.name1, 
				class1:row.class1,
				tel1:row.tel1,
				name2:row.name2,
				class2:row.class2,
				tel2:row.tel2,
				name3:row.name3,
				class3:row.class3,
				tel3:row.tel3,
				school:row.school,
				teacher:row.teacher,
				address:row.address,
				question:row.question,
				award:row.award,
				id:row.id
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