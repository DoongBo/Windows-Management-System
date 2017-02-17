<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>最新动态</title>
    <link href="/djb/Public/Css/bootstrap.min.css" rel="stylesheet">
    <link href="/djb/Public/Css/bootstrapValidator.min.css" rel="stylesheet">
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
                        <li class="active"><a href="<?php echo U('Lwsc/index');?>">论文上传</a></li>
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
               	<div class="panel-heading">论文上传</div>
               	<div class="panel-body">
                <form class="form-horizontal" id="form" enctype="multipart/form-data" method="post" action="<?php echo U('upload');?>">
                    <div class="form-group">
                        <label class="col-sm-5  control-label">题目:</label>
                        <div class="col-sm-2">
                        	<div class="radio">
                                <label>
                                    <input type="radio" name="question" value="A"> 题目A
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="question" value="B"> 题目B
                                </label>
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-5  control-label">类型:</label>
                        <div class="col-sm-2">
                        	<div class="radio">
                                <label >
                                    <input type="radio" name="type" value="论文"> 论文
                                </label>
                            </div>
                        	<div class="radio">
                                <label >
                                    <input type="radio" name="type" value="数据"> 数据
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-offset-3 control-label">文件上传：</label>
                        <div class="col-sm-6">
                            <input type="file" name="file" id="inputfile">
                            <p class="help-block">上传的文件类型为rar或zip</p>	
                        </div>
                    </div>
                        <div class="col-sm-offset-5">
                        <button type="submit" class="btn btn-primary">上传</button>
                        </div>
                 </form>
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
    <script>
    $(document).ready(function(){
		$('#form').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			question: {
				validators: {
					notEmpty: {
						message: ' '
					}
				}
			},
			type: {
				validators: {
					notEmpty: {
						message: ' '
					}
				}
			},
			file: {
                validators: {
					notEmpty: {
						message: '请选择文件'
					},
                    file: {
                        extension: 'rar,zip',
                        message: '文件类型不对'
                    }
                }
            }
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
	});
    </script>
</body>
</html>