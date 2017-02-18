<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="/djb/Public/Css/bootstrap.min.css" rel="stylesheet">
<link href="/djb/Public/Css/bootstrapValidator.min.css" rel="stylesheet">
<title>无标题文档</title>
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
                        <li><a href="<?php echo U('Xxcx/index');?>">信息查询</a></li>
                        <li><a href="<?php echo U('Lwsc/index');?>">论文上传</a></li>
                		<li class="active"><a href="<?php echo U('Zxlt/work');?>">在线论坛</a></li>
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
               	<div class="panel-heading">在线论坛</div>               
                <table class="table table-hover">
                    <tr><th>主题</th><th>发言人</th><th>时间 </th></tr>
                    <?php if(is_array($myartical)): $i = 0; $__LIST__ = $myartical;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><a style="color:red" href="/djb/index.php/Home/Zxlt/reply/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td><td><?php echo ($vo["u_username"]); ?></td><td><?php echo ($vo["time"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><a href="/djb/index.php/Home/Zxlt/reply/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td><td><?php echo ($vo["u_username"]); ?></td><td><?php echo ($vo["time"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
                <div class="text-center">
                    <ul class="pagination pagination-centered"> <?php echo ($page); ?></ul>
                </div>
 				<div class="panel-body text-center">
          			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          				<form class="form-horizontal" id="form" role="form" action="<?php echo U('Zxlt/upload');?>">
                 			<div class="form-group">
                 				<label for="title" class="col-sm-2 control-label">主题</label>
                        		<div class="col-sm-8">
                        			<input name="title" type="text" class="form-control" id="title"  placeholder="请输入主题">
                        		</div>
               				</div>
           					<div class="col-sm-12"> 
  								<script id="container" name="content" type="text/plain"></script>
                		   	</div>
 							<button type="submit" class="btn btn-default" style="margin:10px"><span class="glyphicon glyphicon-cloud-upload">提交</span></button>
						</form>               	
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
    <script src="/djb/Public/Js/bootstrapValidator.min.js"></script>
  	<script type="text/javascript" src="/djb/Public/UEditor/ueditor.config.js"></script>
  	<script type="text/javascript" src="/djb/Public/UEditor/ueditor.all.js"></script>
  	<script type="text/javascript">
    var ue = UE.getEditor('container',{
    		toolbars: [
        		['fullscreen', 'source', 'undo', 'redo', 'bold','italic','underline','strikethrough','fontborder','fontfamily','fontsize','simpleupload','justifyleft','justifyright','justifycenter','justifyjustify','forecolor','imagecenter']
    		],
    		autoHeightEnabled: true,
    		autoFloatEnabled: true
		});
	$(document).ready(function(){	
		$('#form').bootstrapValidator({
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				title: {
					validators: {
						notEmpty: {
							message: '主题不能为空'
						},
					}
				},
			}
		});
		
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
	})
  	</script>
</body>
</html>