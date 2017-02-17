<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>信息查询</title>
    <link href="/djb/Public/Css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">        
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div style="width:50px; "><img src="/djb/Public/Image/logo.png" class="img-responsive" alt="" /></div>
                </div>
                <div id="navbar" class="collapse navbar-collapse mynavbar" role="navigation" aria-expanded="false">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo U('Index/index');?>">网站首页</a></li>
                        <li><a href="<?php echo U('Zxdt/index');?>">最新动态</a></li>
                        <li><a href="<?php echo U('Jsbm/index');?>">竞赛报名</a></li>
                        <li class="active"><a href="<?php echo U('Xxcx/index');?>">信息查询</a></li>
                        <li><a href="<?php echo U('Lwsc/index');?>">论文上传</a></li>
                		<li><a href="<?php echo U('Zxlt/work');?>">在线论坛</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                         <li id="sname"><a href="#"><?php echo ($username); ?></a></li>
                    </ul>   
                </div>
            </div>
        </nav>                
    </header>
<div id="LG" class="container" style="padding:0px;">
	<div class="row-fluid">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="padding-top:50px">
			<img class="img-rounded img-responsive" src="/djb/Public/Image/logo_3.jpg" />
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<div class="panel panel-primary">
               	<div class="panel-heading">信息查询</div>
               	<div class="panel-body">
                	<form class="form-horizontal" role="form">
                    	<div class="form-group">
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">报名序号：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["num"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">组别：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-1">
                             	<p class="form-control-static"><?php echo ($res["groups"]); ?></p>
                          	</div>
                            <label class="col-xs-4 col-sm-2 col-md-2 control-label">获奖状况：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["award"]); ?></p>
                          	</div>
                       	</div>
                       	<div class="form-group">
                        	<label class="col-xs-12 col-sm-12 col-md-1 col-sm-offset-1">成员1</label>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">姓名：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["name1"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">班级：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["class1"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">电话：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["tel1"]); ?></p>
                          	</div>
                       	</div>
                        <div class="form-group">
                        	<label class="col-xs-12 col-sm-12 col-md-1 col-sm-offset-1">成员2</label>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">姓名：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["name2"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">班级：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["class2"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">电话：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["tel2"]); ?></p>
                          	</div>
                       	</div>
                        <div class="form-group">
                        	<label class="col-xs-12 col-sm-12 col-md-1 col-sm-offset-1">成员3</label>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">姓名：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["name3"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">班级：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["class3"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">电话：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["tel3"]); ?></p>
                          	</div>
                       	</div>
                        <div class="form-group">
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">学校：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-5">
                             	<p class="form-control-static"><?php echo ($res["school"]); ?></p>
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">指导教师：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<p class="form-control-static"><?php echo ($res["teacher"]); ?></p>
                          	</div>
                       	</div>
                        <div class="form-group">
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">邮寄地址：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-9">
                             	<p class="form-control-static"><?php echo ($res["address"]); ?></p>
                          	</div>
                       	</div>
                    </form>    
                       	
                    <div class="text-center">
         				<a href="<?php echo U('modify');?>" class="btn btn-primary">修改</a>
      				</div>
                </div>          
            </div>	
		</div>	
	</div>
</div>
<div class="foot-copyright">
    <div class="container" style="background-color:#CCC">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="copyright">
                    <p class="p1">Copyright©2016 <a>数值计算及软件开发实践基地</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
    <script src="/djb/Public/Js/bootstrap.min.js"></script>
     <script>
    $(document).ready(function(){
		$("#sname").click(function(){
			var r=confirm("确认注销？");
			if(r){
				$.post("<?php echo U('Index/logout');?>",
				function(data){
					if(data==1){
						alert("注销成功！");
						window.location.href="<?php echo U('Index/index');?>";
					}else{
						alert(data);
					}
				});
			}
		})
		var info="<?php echo ($info); ?>";
		if(info==1){
			alert("修改功能已关闭！");
		}
	})
	</script>
    
</body>
</html>