<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/myStyle.css">   
</head>
	<div id="win" class="easyui-window" title="修改密码" style="padding:10px" data-options="iconCls:'icon-save',modal:true">
        <form id="form" method="post">
            <table>
            	<tr>
                    <td>原密码:</td>
                    <td><input class="easyui-textbox" type="text" name="password"></input></td>
                </tr>
                <tr>
                    <td>新密码：</td>
                    <td><input class="easyui-textbox" type="text" name="repassword"></input></td>
                </tr>    
            </table>
     	</form>	     
        <div style="text-align:center; margin-top:5px"><a href="#" class="easyui-linkbutton" type="submit" icon="icon-ok" onclick="doSave()">保存</a></div>
    </div>
<body>
</body>
<script type="text/javascript" src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/djb/Public/Js/easyui-lang-zh_CN.js"></script>
<script>	
	function doSave(){
		$('#form').form('submit', {
    		url:"<?php echo U('save');?>",
    		success:function(data){
				if(data==1){					
					$.messager.alert('提示','保存成功!','info');
				}else{
					$.messager.alert('提示','保存失败!','info');
				}
    		}
		});
			
	}
</script>
</html>