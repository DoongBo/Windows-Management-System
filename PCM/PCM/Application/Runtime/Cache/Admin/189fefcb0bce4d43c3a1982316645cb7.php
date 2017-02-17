<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>机器使用状态监控</title>
    <link rel="stylesheet" type="text/css" href="/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/Public/Css/myStyle.css">
</head>

<body>
    <div>

        <div style="margin:20px;">

            <table style="width:50%;">
                <tr>
                    <td>
                        <form id="form" action="<?php echo U('detial');?>">
                            <select name="room" id="room" style="width:80px;" panelheight="50">
                                <option value="所有" onclick="doLook()">所有机房</option>
                                <option value="C303" onclick="doLook()">C303</option>
                                <option value="C305" onclick="doLook()">C305</option>
                            </select>
                            <a href="#" class="easyui-linkbutton" iconcls="icon-search" onclick="doLook()">添加</a>
                        </form>
                        <br />
                        <ul id="parentUl"></ul>
                    </td>
                    <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" onclick="ScreenJpg()" title="刷新所有截屏与进程">全部刷新</a></td>
                    <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" title="关闭本机房所有电脑屏幕">一键锁屏</a></td>
                    <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" title="关闭本机房所有计算机">一键关机</a></td>
                    <td><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" title="在本机房所有计算机演示教师屏幕">屏幕演示</a></td>
                </tr>
            </table>
        </div>
        <hr />
    </div>

    <?php echo ($room); ?>
    <table border="1">
        <tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,0,9,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td width="120px" height="120px">
                    <img src="/Public/Upload/<?php echo ($vo["PCM_ScreenJpgsrc"]); ?>" width="120" height="90" title="<?php echo ($vo["PCM_AppRecord"]); ?>"><br />
                    <?php echo ($vo["PCM_Num"]); ?><br />
                    <?php echo ($vo["PCM_UserNum"]); ?><br />
                    <?php echo ($vo["User_Name"]); ?>
                </td><?php endforeach; endif; else: echo "" ;endif; ?>
        </tr>
    </table>
    <script type="text/javascript" src="/Public/Js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/Public/Js/easyui-lang-zh_CN.js"></script>
    <script>
        function addElementLi() {
            var ul = document.getElementById("parentUl");
            var chos = document.getElementById("room").value; 
            var has=document.getElementById(chos);
            if(has==null){
                //添加 li
                var li = document.createElement("a");
                //设置 li 属性，如 id
                li.setAttribute("id", chos);
                
                li.setAttribute("data-options", "iconCls:'icon-cancel'");
                li.setAttribute("group","");
                li.setAttribute("style","margin-left:10px;");
                li.setAttribute("class", "easyui-linkbutton l-btn l-btn-small"); 
                li.innerHTML = chos;
                var span=document.createElement("span");
                span.setAttribute("id",chos+"span");
                span.setAttribute("class","l-btn-left l-btn-icon-left");
                var spanchild1=document.createElement("span");
                spanchild1.setAttribute("class","l-btn-text l-btn-empty");
                span.appendChild(spanchild1);
                var spanchild2=document.createElement("span");
                spanchild2.setAttribute("class","l-btn-icon icon-cancel");
                span.appendChild(spanchild2);

                li.appendChild(span);
                ul.appendChild(li);
                
            }
           
        }
        function doLook() {
            { $room="123" }
            addElementLi();
            $('#form').submit();
        }
        function ScreenJpg() {
            $.post("<?php echo U('ScreenJpg');?>",
                {
                    room: "<?php echo ($room); ?>",
                },
                function (data) {
                    if (data == 1) {
                        alert('截屏成功')
                    } else {
                        alert('截屏失败')
                    }
                });
        }

    </script>
</body>
</html>