<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>机器使用状态监控</title>
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/easyui.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/easyui/icon.css">
    <link rel="stylesheet" type="text/css" href="/CMS/Public/Css/myStyle.css">
</head>

<body>
    <div>
        <div style="margin:20px;">

            <table style="width:100%;">
                <tr>
                    <td>
                   
                    <div id="dg"> 
                    
                            <select name="room" id="room" style="width:80px;" panelheight="50" >
                                <option value="all" id="all" onClick="showall()">所有机房</option>
                                 <?php if(is_array($roomnames)): $i = 0; $__LIST__ = $roomnames;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$room): $mod = ($i % 2 );++$i;?><option id="<?php echo ($room["PCM_RoomName"]); ?>option" value="<?php echo ($room["PCM_RoomName"]); ?>" onClick="doLook('<?php echo ($room["PCM_RoomName"]); ?>')"><?php echo ($room["PCM_RoomName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                 
                            
                            </select>
                        
                        </div>
                        <br />
                        <ul id="parentUl"></ul>
                    </td>
                    <td><a href="#" class="easyui-linkbutton" id="btnbrush" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" onclick="ScreenJpg()" title="刷新所有截屏与进程">全部刷新</a></td>
                    <td><a href="#" class="easyui-linkbutton"  onClick="ScreenLock()"  id="scroff"
                     data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" 
                     title="关闭已选机房所有电脑屏幕"><label  id="scrlabel">一键锁屏</label></a></td>
                     
                    <td><a href="#" class="easyui-linkbutton"    onClick="PowerOff()"
                    data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'"
                     title="关闭已选机房所有计算机">一键关机</a></td>
                    <td><a href="#" class="easyui-linkbutton"   onClick="ScreenPlay()" 
                    data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top'" 
                    id="scroplay" 
                    title="在本机房所有计算机演示教师屏幕"><label id="playlabel">屏幕演示</label></a></td>
                    <td>
                    <ul  id="count">
                    </ul>
                    </td>
                    
                </tr>
            </table>
        </div>
        <hr />
    </div>

    <div id="rooms"  class="easyui-layout">
    </div>
    
    <script type="text/javascript" src="/CMS/Public/Js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/CMS/Public/Js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/CMS/Public/Js/easyui-lang-zh_CN.js"></script>
    <script>
	function showall()
	{
		 var ul=document.getElementById("room").getElementsByTagName("option");
 			 setTimeout(function(){
			 doLook(ul.item(1).value);
			 },1
			 );
			 setTimeout(function(){
			 doLook(ul.item(2).value);
			 },1
			 ); setTimeout(function(){
			 doLook(ul.item(3).value);
			 },1
			 ); setTimeout(function(){
			 doLook(ul.item(4).value);
			 },1
			 ); setTimeout(function(){
			 doLook(ul.item(5).value);
			 },1
			 ); setTimeout(function(){
			 doLook(ul.item(6).value);
			 },1);
		
		 
	}
	$(function(){
		$('#dg').ready(function(e) {
         showall();
        });
	});
        function addElementLi(rooname) {
          var ul = document.getElementById("parentUl");
            var chos =rooname; 
            var has=document.getElementById(chos+"uperli");
            if(has==null){
                //添加 li
				var uperli=document.createElement("span");
				uperli.setAttribute("id",chos+"uperli");
                var li = document.createElement("a");
                //设置 li 属性，如 id
                li.setAttribute("id", chos+"li");
                li.setAttribute("onclick","removeelement()");
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
				uperli.appendChild(li);
				
                ul.appendChild(uperli);
			}
           
        }
		function removeelement()
		{
			var name=event.srcElement.parentNode.id;
			var roomname=name.substring(0,4);
			
			var e = document.getElementById(roomname+'uperli');
	 		e.parentNode.removeChild(e);
			var el = document.getElementById(roomname+'h1');
	 		el.parentNode.removeChild(el);
			var ell = document.getElementById(roomname+'table');
	 		ell.parentNode.removeChild(ell);
			var ul=document.getElementById("count");
			var countul=document.getElementById(roomname+"count");
			ul.removeChild(countul);
		}
	
		function addElemnetTable( name,  data)
		{
			
			var div = document.getElementById("rooms");
			var h1=document.createElement("h1");
			h1.setAttribute("id",name+"h1");
			h1.setAttribute("style","color:white;font-size:60px;text-align:center;background-image:url(/CMS/Public/Image/cccc2.jpg); background-repeat:no-repeat");
			h1.innerHTML=name;
			div.appendChild(h1);
			
			var dive=document.createElement("div");
			dive.setAttribute("data-options","region:'north'");
			var table=document.createElement("table");
			table.setAttribute("id",name+"table");
			table.setAttribute("width","100%");

			var date1=new Date($.ajax({async: false}).getResponseHeader("Date")).getTime();

			var row=0,col=0;
			var count=0,sum=data.length;
			for(var L1=0;L1<data.length;L1++) {
				
				var newArr = data[L1];
				var pcnum=newArr["PCM_Num"].split("_")[1];
   				var rowname=pcnum.split("-")[0];
				if(col==pcnum.split("-")[1])
				continue;
				col=pcnum.split("-")[1];
				if(rowname!=row)
				{
					row=rowname+"_"+name;
					var tre1=document.createElement("tr");
					tre1.setAttribute("id",row+"tre1");
					table.appendChild(tre1);
					
					
					var tre2=document.createElement("tr");
					tre2.setAttribute("id",row+"tre2");
					table.appendChild(tre2);
					
					
					var tre3=document.createElement("tr");
					tre3.setAttribute("id",row+"tre3");
					table.appendChild(tre3);
					
					
					dive.appendChild(table);
					div.appendChild(dive);
				}
				
				var td1=document.createElement("td");
				
				var img=document.createElement("img");
				var td3=document.createElement("td");
				var usenumname=document.createElement("a");
			
				
				if(newArr["PCM_LastTime"]!=null)
				{
				
					
					var date2=new Date(newArr["PCM_LastTime"].replace(/-/g,'/')).getTime();
					var datespan=date1-date2;
					
					if(parseInt(datespan)>1000*3||parseInt(datespan)<1000*3*(-1))
					{
						usenumname.innerHTML="";
						img.setAttribute("src","http://59.72.212.7/CMS/Public/Image/poweroff.jpg");
					}
					else
						{
							count++;
								usenumname.innerHTML=newArr["User_Name"]+", &nbsp "+newArr["PCM_Course"]+"<br/>"+newArr["PCM_UserNum"];
								usenumname.innerHTML=date1;
							img.setAttribute("src","http://59.72.212.7/CMS/Public/Upload/Screen/"+newArr["PCM_ScreenJpgsrc"]);
							
						}
				}
				else 
				{
					img.setAttribute("src","http://59.72.212.7/CMS/Public/Upload/poweroff.jpg");
				}
				img.setAttribute("style","max-width:150px");
				img.setAttribute("width","100%");
				img.setAttribute("height","100px");
				img.setAttribute("title",newArr["PCM_AppRecord"]);
				td1.appendChild(img);
				var thistre=document.getElementById(row +"tre1");
				thistre.appendChild(td1);
				
				var td2=document.createElement("td");
				var pcnum=document.createElement("a");
				pcnum.innerHTML=newArr["PCM_Num"];
				td2.appendChild(pcnum);
				var thistre=document.getElementById(row +"tre2");
				thistre.appendChild(td2);
							
				
				td3.appendChild(usenumname);
				
				var thistre=document.getElementById(row +"tre3");
				thistre.appendChild(td3);
				}
				addcount(name,sum,count);
		}
		function addcount(roomname,sum,count)
		{
			var ul=document.getElementById("count");
			var li=document.createElement("li");
			li.setAttribute("id",roomname+"count");
			li.innerHTML="机房"+roomname+"共有机器："+sum+"台，在线：<a href='#"+roomname+"h1'>"+count+"</a>&nbsp 台";
			ul.appendChild(li);
		}
        function doLook(roomname) {
			var ul = document.getElementById("parentUl");
            var chos =roomname; 
            var has=document.getElementById(chos+"uperli");
            if(has==null){
				addElementLi(roomname);
				$.post("<?php echo U('gotmathion');?>",
				{
					room:roomname
				},function(data){
					addElemnetTable(roomname,  data);
				});
				
			}
			
		}
        function update()
		{
			
			var ul=document.getElementById("parentUl").getElementsByTagName("a");
			var count=[];
			for(var i=0;i<ul.length;i++)
			{
				var roomname=ul[i].id.substring(0,4);
				count[i]=roomname;
			}
			
			for(var i=0;i<count.length;i++)
			{
				var roomname=count[i].substring(0,4);
				
				var e = document.getElementById(roomname+'uperli');
	 			e.parentNode.removeChild(e);
				var el = document.getElementById(roomname+'h1');
	 			el.parentNode.removeChild(el);
				var ell = document.getElementById(roomname+'table');
	 			ell.parentNode.removeChild(ell);
				var ul=document.getElementById("count");
				var countul=document.getElementById(roomname+"count");
				ul.removeChild(countul);
			}
			
			for(var i=0;i<count.length;i++)
			{
				var roomname=count[i].substring(0,4);
				
				 var ull = document.getElementById("parentUl");
				var uperli=document.createElement("span");
				uperli.setAttribute("id",roomname+"uperli");
                var li = document.createElement("a");
                //设置 li 属性，如 id
				
                li.setAttribute("id", roomname+"li");
                li.setAttribute("onclick","removeelement()");
                li.setAttribute("data-options", "iconCls:'icon-cancel'");
                li.setAttribute("group","");
                li.setAttribute("style","margin-left:10px;");
                li.setAttribute("class", "easyui-linkbutton l-btn l-btn-small"); 
                li.innerHTML = roomname;
                var span=document.createElement("span");
                span.setAttribute("id",roomname+"span");
                span.setAttribute("class","l-btn-left l-btn-icon-left");
                var spanchild1=document.createElement("span");
                spanchild1.setAttribute("class","l-btn-text l-btn-empty");
                span.appendChild(spanchild1);
                var spanchild2=document.createElement("span");
                spanchild2.setAttribute("class","l-btn-icon icon-cancel");
				
                span.appendChild(spanchild2);

                li.appendChild(span);
				uperli.appendChild(li);
                ull.appendChild(uperli);
				
			}
			
			
			if(count.length>0)
				{
				setTimeout(function(){
				var roomname=count[0].substring(0,4);
				$.post("<?php echo U('gotmathion');?>",
				{
					room:roomname
				},function(data){
					
  				addElemnetTable(roomname,  data);
				});
				},1000
				);
				
			 	setTimeout(function(){
					var roomname=count[1].substring(0,4);
					$.post("<?php echo U('gotmathion');?>",
					{
						room:roomname
					},function(data){
						
					addElemnetTable(roomname,  data);
					});
					},1
				);}
				if(count.length>1){
				setTimeout(function(){
					var roomname=count[2].substring(0,4);
					$.post("<?php echo U('gotmathion');?>",
					{
						room:roomname
					},function(data){
						
					addElemnetTable(roomname,  data);
					});
					},1
				);}
				if(count.length>2){
				setTimeout(function(){
					var roomname=count[3].substring(0,4);
					$.post("<?php echo U('gotmathion');?>",
					{
						room:roomname
					},function(data){
						
					addElemnetTable(roomname,  data);
					});
					},1
				);}
				if(count.length>3){
				setTimeout(function(){
					var roomname=count[4].substring(0,4);
					$.post("<?php echo U('gotmathion');?>",
					{
						room:roomname
					},function(data){
						
					addElemnetTable(roomname,  data);
					});
					},1
				);}
				if(count.length>4){
				setTimeout(function(){
					var roomname=count[5].substring(0,4);
					$.post("<?php echo U('gotmathion');?>",
					{
						room:roomname
					},function(data){
						
					addElemnetTable(roomname,  data);
					});
					},1
				);
				}
				if(count.length>5){
					setTimeout(function(){
					var roomname=count[6].substring(0,4);
					$.post("<?php echo U('gotmathion');?>",
					{
						room:roomname
					},function(data){
						
					addElemnetTable(roomname,  data);
					});
					},1
				);
				}
			
			ScrollToControl('btnbrush');
		}
        function ScreenJpg() {
			if(window.confirm('刷新操作将解除屏幕锁定和教师演示，是否继续？')){
			var ul=document.getElementById("parentUl").getElementsByTagName("a");
			for(var i=0;i<ul.length;i++)
			{
			var roomname=ul[i].id.substring(0,4);
			 $.post("<?php echo U('ScreenJpg');?>",
                {
                    room: roomname,
                }
                );
			}
			setTimeout(function(){
			update();
			},1000
			);
			}
        }
		function ScreenLock()
		{
			var label=document.getElementById("scrlabel");
			var btn=document.getElementById("scroff");
			var text=label.innerHTML;
			
			if(text=="一键锁屏"){
				if(window.confirm('你确定锁定当前选定机房所有屏幕？')){
					btn.setAttribute("title","可一键打开当前已选机房所有电脑屏幕");
					label.innerHTML="一键开屏";
					var ul=document.getElementById("parentUl").getElementsByTagName("a");
					for(var i=0;i<ul.length;i++)
					{
					var roomname=ul[i].id.substring(0,4);
					 $.post("<?php echo U('ScreenLock');?>",
						{
							room: roomname,
						}
						);
					}
				}
			}else{
					btn.setAttribute("title","关闭已选机房所有计算机");
					label.innerHTML="一键锁屏";
					var ul=document.getElementById("parentUl").getElementsByTagName("a");
					for(var i=0;i<ul.length;i++)
					{
					var roomname=ul[i].id.substring(0,4);
					 $.post("<?php echo U('ScreenLockOpen');?>",
						{
							room: roomname,
						}
						);
					}
			}

		}
		function ScreenPlay()
		{
			var label=document.getElementById("playlabel");
			var btn=document.getElementById("scroplay");
			var text=label.innerHTML;
			alert("2017年上线，敬请期待！");
			return;
			if(text=="屏幕演示"){
				if(window.confirm('你确定在当前选定机房重演示教师屏幕？')){
						btn.setAttribute("title","一键关闭当前已选机房所有屏幕演示");
						label.innerHTML="关闭演示";
						var ul=document.getElementById("parentUl").getElementsByTagName("a");
						for(var i=0;i<ul.length;i++)
						{
						var roomname=ul[i].id.substring(0,4);
						 $.post("<?php echo U('ScreenPlayOpen');?>",
							{
								room: roomname,
							}
							);
						}
				}
			}else{
				 if(window.confirm('你确定关闭屏幕演示？')){
						btn.setAttribute("title","在本机房所有计算机演示教师屏幕");
						label.innerHTML="屏幕演示";
						var ul=document.getElementById("parentUl").getElementsByTagName("a");
						for(var i=0;i<ul.length;i++)
						{
						var roomname=ul[i].id.substring(0,4);
						 $.post("<?php echo U('ScreenPlayOff');?>",
							{
								room: roomname,
							}
							);
						}
				}
			}
		}
		
		function PowerOff()
		{
			if(window.confirm('你确定关闭当前选定机房所有计算机？')){
				var ul=document.getElementById("parentUl").getElementsByTagName("a");
			for(var i=0;i<ul.length;i++)
			{
			var roomname=ul[i].id.substring(0,4);
			 $.post("<?php echo U('PowerOff');?>",
                {
                    room: roomname,
                }
                );
			}
				}
		}
		function elementPosition(obj) {
		  var curleft = 0, curtop = 0;
		  if (obj.offsetParent) {
		   curleft = obj.offsetLeft;
		   curtop = obj.offsetTop;
		   while (obj = obj.offsetParent) {
		    curleft += obj.offsetLeft;
		    curtop += obj.offsetTop;
		   }
		  }
		  return { x: curleft, y: curtop };
		}
		function ScrollToControl(id)
		{
		 var elem = document.getElementById(id);
		 var scrollPos = elementPosition(elem).y;
		 scrollPos = scrollPos - document.documentElement.scrollTop;
		 var remainder = scrollPos % 50;
		 var repeatTimes = (scrollPos - remainder) / 50;
		 ScrollSmoothly(scrollPos,repeatTimes);
		 window.scrollBy(0,remainder);
		}
		var repeatCount = 0;
		var cTimeout;
		var timeoutIntervals = new Array();
		var timeoutIntervalSpeed;
		function ScrollSmoothly(scrollPos,repeatTimes)
		{
		 if(repeatCount < repeatTimes)
		 {
		 window.scrollBy(0,50);
		 }
		 else
		 {
		 repeatCount = 0;
		 clearTimeout(cTimeout);
		 return;
		 }
		repeatCount++;
		cTimeout = setTimeout("ScrollSmoothly('"+scrollPos+"','"+repeatTimes+"')",10);
		}
		 setInterval("update()",5*60*1000);//1000为1秒钟 
    </script>
</body>
</html>