<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
	<link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/djb/Public/Css/myStyle.css">   
</head>
	<div id="win" class="easyui-window" title="章程控制" style="padding:10px" data-options="iconCls:'icon-save',modal:true">
        <form id="form" method="post">
            <table>
            	<tr>
                    <td>开始报名:</td>
                    <td>
                    	<label><input type="radio" name="sign" value="1">开启</input></label>&nbsp;&nbsp;
                    	<label><input type="radio" name="sign" value="0">关闭</input></label>
                    </td>
                </tr>
                <tr>
                    <td>修改信息:</td>
                    <td>
                    	<label><input type="radio" name="modify" value="1">开启</input></label>&nbsp;&nbsp;
                    	<label><input type="radio" name="modify" value="0">关闭</input></label>
                    </td>
                </tr>
                <tr>
                    <td>上传论文:</td>
                    <td>
                    	<label><input type="radio" name="upload" value="1">开启</input></label>&nbsp;&nbsp;
                    	<label><input type="radio" name="upload" value="0">关闭</input></label>
                    </td>
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
	$('#form').form('load',{
				sign:"<?php echo ($sign); ?>",
				upload:"<?php echo ($upload); ?>",
				modify:"<?php echo ($modify); ?>"
			});				
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