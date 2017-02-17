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
                        <li class="active"><a href="<?php echo U('Zxdt/index');?>">最新动态</a></li>
                        <li><a href="<?php echo U('Jsbm/index');?>">竞赛报名</a></li>
                        <li><a href="<?php echo U('Xxcx/index');?>">信息查询</a></li>
                        <li><a href="<?php echo U('Lwsc/index');?>">论文上传</a></li>
                		<li><a href="<?php echo U('Zxlt/work');?>">在线论坛</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                       	<li style="display:none" id="sname"><a href="#"><?php echo ($username); ?></a></li>
                        <li class="top_right"><a href="#register" data-toggle="modal">注册</a></li>
                        <li class="top_right"><a href="#login" data-toggle="modal">登录</a></li>
                    </ul>   
                </div>
            </div>
        </nav>
        
        
        
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:100px;">
           <div class="modal-dialog modal-sm">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                       注册
                    </h4>
                 </div>
                 <div class="modal-body">
                    <form class="form-horizontal" id="form1" role="form">
                    	<div class="form-group">
                        	<label for="username" class="col-sm-4 control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
                          	<div class="col-sm-8">
                            	<input type="text" class="form-control" id="username" name="username" placeholder="e-mail">
                            </div>
                    	</div>
                        <div class="form-group">
                        	<label for="password" class="col-sm-4 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                          	<div class="col-sm-8">
                            	<input type="password" class="form-control" id="password" name="password" placeholder="密码">
                            </div>
                    	</div>
                        <div class="form-group">
                        	<label for="repassword" class="col-sm-4 control-label">确认密码</label>
                          	<div class="col-sm-8">
                            	<input type="password" class="form-control" id="repassword" name="repassword" placeholder="确认密码">
                            </div>
                    	</div>
                       <div class="form-group">
                        	<label class="col-sm-4 control-label">组&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</label>
                            <div class="col-sm-8">
                                <div class="radio">
                                    <label><input type="radio" name="groups" value="1">本科生</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="groups" value="2">研究生</label>
                                </div>
                            </div>
                    	</div>                       
                    </form>
                 </div>
                 <div class="modal-footer">                   
                    <button type="button" id="register1" class="btn btn-primary">
                       注册
                    </button>
                 </div>
                                  
                    
                 
              </div>
        	</div>
        </div>
        
        
        
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:100px;">
           <div class="modal-dialog modal-sm">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                       登录
                    </h4>
                 </div>
                 <div class="modal-body">
                    <form class="form-horizontal" id="form2" role="form">
                    	<div class="form-group">
                        	<label for="username" class="col-sm-4 control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
                          	<div class="col-sm-8">
                            	<input type="text" class="form-control" id="username1" name="username" placeholder="e-mail">
                            </div>
                    	</div>
                        <div class="form-group">
                        	<label for="password" class="col-sm-4 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                          	<div class="col-sm-8">
                            	<input type="password" class="form-control" id="password1" name="password" placeholder="密码">
                            </div>
                    	</div>
                        <div class="form-group">
                        	<label for="status" class="col-sm-4 control-label">身&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;份</label>
                            <div class="col-sm-8">
                            	<div class="radio">
                            		<label><input type="radio" name="status" value="1" checked> 用&nbsp;&nbsp;&nbsp;&nbsp;户</label>
                            	</div>
                            	<div class="radio">
                            		<label><input type="radio" name="status" value="2"> 管理员</label>
                               	</div>
                          	</div>
                    	</div>
                        <div class="form-group">
                        	<div class="col-sm-6">
                            	<img class="img-responsive" alt="验证码" src="<?php echo U('Index/setverify');?>" title="点击刷新" onclick="this.src=this.src+'?'+Math.random();">
                            </div>           
   							<div class="col-sm-6">
                            	<input type="text" class="form-control" id="verify" name="verify" placeholder="验证码">
                            </div>
                    	</div>
                 	</form>
               	 </div>
                 <div class="modal-footer">
                 	 <button type="button" class="btn btn-primary">
                       忘记密码
                    </button>                   
                    <button type="button" id="login1" class="btn btn-primary">
                       登录
                    </button>
                 </div>
              </div>
        	</div>
        </div>
        
        <div class="modal fade" id="forget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:100px;">
           <div class="modal-dialog modal-sm">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                       重置密码
                    </h4>
                 </div>
                 <div class="modal-body">
                    <form class="form-horizontal" id="form3" role="form">
                    	<div class="form-group">
                        	<label for="username" class="col-sm-4 control-label">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
                          	<div class="col-sm-8">
                            	<input type="text" class="form-control" id="username2" name="username" placeholder="e-mail">
                            </div>
                    	</div>
                 	</form>
               	 </div>
                 <div class="modal-footer">      
                    <button type="button" id="reset" class="btn btn-primary">
                       重置
                    </button>
                 </div>
              </div>
        	</div>
        </div>
                
    </header>
<div id="LG" class="container" style="padding:0px;">
	<div class="row-fluid">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 " style="padding-top:50px">
			<img class="img-rounded img-responsive" src="/djb/Public/Image/logo_3.jpg" />
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
			<div class="panel panel-primary">
               	<div class="panel-heading">最新动态</div>
               	<table class="table table-hover">
                    <tr><th>标题</th><th>时间 </th></tr>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><a href="<?php echo U('news', array('id' => $vo[id]));?>"><?php echo ($vo["title"]); ?></a></td><td><?php echo ($vo["time"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
            	</table>
                <div class="panel-footer text-center">
                    <ul class="pagination pagination-centered">
                    <?php echo ($page); ?>
                    </ul>
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
    <    <script>
	$(document).ready(function(){
		$('#form1').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			username: {
				validators: {
					notEmpty: {
						message: '邮箱不能为空'
					},
					emailAddress: {
						message: '不是一个正确的邮箱地址'
					}
				}
			},
			password: {
				validators: {
					notEmpty: {
						message: '密码不能为空'
					},
					stringLength: {
							min: 6,
							max: 16,
							message: '密码不在6到16位之间'
					},
					identical: {
						field: 'repassword',
						message: '两次密码输入不一致'
					}
				}
			},
			repassword: {
				validators: {
					notEmpty: {
						message: '确认密码不能为空'
					},
					identical: {
						field: 'password',
						message: '两次密码输入不一致'
					}
				}
			},
			groups: {
				validators: {
					notEmpty: {
						message: '请选择组别'
					}
				}
			},
		}
		});
		$('#form2').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			username: {
				validators: {
					notEmpty: {
						message: '邮箱不能为空'
					},
				}
			},
			password: {
				validators: {
					notEmpty: {
						message: '密码不能为空'
					},
				}
			},
			verify: {
				validators: {
					notEmpty: {
						message: '验证码不能为空'
					}
				}
			},
		}
		});
		$('#form3').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			username: {
				validators: {
					notEmpty: {
						message: '邮箱不能为空'
					},
				}
			},
		}
		});

		
		$("#register1").click(function(){
			$('#form1').bootstrapValidator('validate');
			var username = $("#username").val();
			var password = $("#password").val();
			var groups = $("input[name='groups']:checked").val();
			/**/
			var cc=window.location.href;
			var pp=/^((http)|(https))\:\/\/[^\/]{1,}/;
			var mm=pp.exec(cc);
			/**/
			if($('#form1').data('bootstrapValidator').isValid()){
				$.post("<?php echo U('Index/register');?>",
					{
						username:username,
						password:password,
						groups:groups,
						urls:mm[0]
					},function(data){
						if(data==1){
							alert("验证邮件发送成功，请前往您的邮箱以完成注册！");
						}else if(data==2){
							alert("该邮箱已注册！");
						}else{
							alert(data);
						}
				});
			}
		});
		$("#login1").click(function(){
			$('#form2').bootstrapValidator('validate');			
			var username = $("#username1").val();
			var password = $("#password1").val();
			var status = $("input[name='status']:checked").val();
			var verify = $("#verify").val();
			if($('#form2').data('bootstrapValidator').isValid()){	
				$.post("<?php echo U('Index/login');?>",
					{
						username:username,
						password:password,
						status:status,
						verify:verify
					},function(data){
						if(data==1){
							window.location.href="<?php echo U('Index/index');?>";
						}else if(data==2){
							alert("用户名或密码错误！");
						}else if(data==3){
							window.location.href="<?php echo U('Admin/Index/index');?>";
						}else if(data==4){
							alert("验证码错误！");
						}else{
							alert(data);
						}
				});
			}
		});
		$("#reset").click(function(){
			$('#form3').bootstrapValidator('validate');			
			var username = $("#username2").val();
			var cc=window.location.href;
			var pp=/^((http)|(https))\:\/\/[^\/]{1,}/;
			var mm=pp.exec(cc);
			if($('#form3').data('bootstrapValidator').isValid()){	
				$.post("<?php echo U('Index/forget');?>",
					{
						username:username,
						urls:mm[0]
					},function(data){
						if(data==1){
							alert("不存在该用户！");
						}else if(data==2){
							alert("验证邮件发送成功，请前往您的邮箱以完成重置！");
						}else{
							alert(data);
						}
				});
			}
		});
		var sname="<?php echo ($username); ?>";
		if(sname!=""){
			$("#sname").show();	
			$(".top_right").hide();	
		}
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