<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>竞赛报名</title>
    <link href="/djb/Public/Css/bootstrap.min.css" rel="stylesheet">
    <link href="/djb/Public/Css/bootstrapValidator.min.css" rel="stylesheet">
    <link href="/djb/Public/Css/school.css" rel="stylesheet">
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
                        <li class="active"><a href="<?php echo U('Jsbm/index');?>">竞赛报名</a></li>
                        <li><a href="<?php echo U('Xxcx/index');?>">信息查询</a></li>
                        <li><a href="<?php echo U('Lwsc/index');?>">论文上传</a></li>
                		<li><a href="<?php echo U('Zxlt/index');?>">在线论坛</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                       	<li><a><?php echo ($username); ?></a></li>
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
               	<div class="panel-heading">竞赛报名</div>
               	<div class="panel-body">
                	<form class="form-horizontal" id="form" role="form">
                       	<div class="form-group">
                        	<label class="col-xs-12 col-sm-12 col-md-1 col-sm-offset-1">成员1</label>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">姓名：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="name1" name="name1" placeholder="请输入姓名">
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">班级：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="class1" name="class1" placeholder="请输入班级">
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">电话：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="tel1" name="tel1" placeholder="请输入电话">
                          	</div>
                       	</div>
                        <div class="form-group">
                        	<label class="col-xs-12 col-sm-12 col-md-1 col-sm-offset-1">成员2</label>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">姓名：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="name2" name="name2" placeholder="请输入姓名">
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">班级：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="class2" name="class2" placeholder="请输入班级">
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">电话：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control"id="tel2" name="tel2" placeholder="请输入电话">
                          	</div>
                       	</div>
                        <div class="form-group">
                        	<label class="col-xs-12 col-sm-12 col-md-1 col-sm-offset-1">成员3</label>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">姓名：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="name3" name="name3" placeholder="请输入姓名">
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">班级：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="class3" name="class3" placeholder="请输入班级">
                          	</div>
                          	<label class="col-xs-4 col-sm-2 col-md-1 control-label">电话：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="tel3" name="tel3" placeholder="请输入电话">
                          	</div>
                       	</div>
                        <div class="form-group">
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">学校：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-5">
                             	<input type="text" class="form-control" id="school" name="school" placeholder="请选择学校" readonly> 
                                <div id="proSchool" class="provinceSchool">
                                    <div class="title"><span>请选择学校</span></div>
                                    <div class="proSelect">
                                        <select></select>
                                        <span>如没找到选择项，请选择其他手动填写</span>
                                        <input type="text" />
                                    </div>
                                    <div class="schoolList">
                                        <ul></ul>
                                    </div>
                                    <div class="button">
                                        <div class="btn btn-primary button" id="cancel">取消</div>
                                        <div class="btn btn-primary button" id="confirm">确认</div>
                                    </div>
                            	</div>	
                          	</div>
                           
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">指导教师：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-2">
                             	<input type="text" class="form-control" id="teacher" name="teacher" placeholder="请输入指导教师">
                          	</div>
                       	</div>
                        <div class="form-group">
                          	<label class="col-xs-4 col-sm-2 col-md-2 control-label">邮寄地址：</label>
                          	<div class="col-xs-8 col-sm-10 col-md-9">
                             	<input type="text" class="form-control" id="address" name="address" placeholder="请输入邮寄地址">
                          	</div>
                       	</div>   	
                    </form>
                    <div class="text-center">
         				<button id="submit" type="submit" class="btn btn-primary">确认报名</button>
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
    <script src="/djb/Public/Js/school.js"></script>
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
			name1: {
				validators: {
					notEmpty: {
						message: '成员1不能为空'
					},
					stringLength: {
							min: 2,
							max: 4,
							message: '姓名不在2到4位之间'
					}
				}
			},
			class1: {
				validators: {
					notEmpty: {
						message: '班级不能为空'
					},
					stringLength: {
							min: 2,
							max: 30,
							message: '班级不在2到30位之间'
					},
				}
			},
			tel1: {
				validators: {
					notEmpty: {
						message: '电话不能为空'
					},
					stringLength: {
							min: 8,
							max: 11,
							message: '电话不在8到11位之间'
					},
					digits:{
						message: '电话格式不正确'
					},
				}
			},
			name2: {
				validators: {
					stringLength: {
							min: 2,
							max: 4,
							message: '姓名不在2到4位之间'
					}
				}
			},
			class2: {
				validators: {
					stringLength: {
							min: 2,
							max: 30,
							message: '班级不在2到30位之间'
					},
				}
			},
			tel2: {
				validators: {
					stringLength: {
							min: 8,
							max: 11,
							message: '电话不在8到11位之间'
					},
					digits:{
						message: '电话格式不正确'
					},
				}
			},
			name3: {
				validators: {
					stringLength: {
							min: 2,
							max: 4,
							message: '姓名不在2到4位之间'
					}
				}
			},
			class3: {
				validators: {
					stringLength: {
							min: 2,
							max: 30,
							message: '班级不在2到30位之间'
					},
				}
			},
			tel3: {
				validators: {
					stringLength: {
							min: 8,
							max: 11,
							message: '电话不在8到11位之间'
					},
					digits:{
						message: '电话格式不正确'
					},
				}
			},
			school: {
				validators: {
					notEmpty: {
						message: '学校不能为空'
					},
				}
			},
			teacher: {
				validators: {
					stringLength: {
							max: 10,
							message: '指导教师不大于10位'
					},
				}
			},
			address: {
				validators: {
					notEmpty: {
						message: '地址不能为空'
					},
					stringLength: {
							max: 50,
							message: '邮寄地址不大于50位'
					},
				}
			},
		}
		});
		

		
		$("#submit").click(function(){
			$('#form').bootstrapValidator('validate');
			var name1 = $("#name1").val();
			var class1 = $("#class1").val();
			var tel1 = $("#tel1").val();
			var name2 = $("#name2").val();
			var class2 = $("#class2").val();
			var tel2 = $("#tel2").val();
			var name3 = $("#name3").val();
			var class3 = $("#class3").val();
			var tel3 = $("#tel3").val();
			var school = $("#school").val();
			var teacher = $("#teacher").val();
			var address = $("#address").val();
			if($('#form').data('bootstrapValidator').isValid()){
				$.post("<?php echo U('Jsbm/sign');?>",
					{
						name1:name1, 
						class1:class1,
						tel1:tel1,
						name2:name2,
						class2:class2,
						tel2:tel2,
						name3:name3,
						class3:class3,
						tel3:tel3,
						school:school,
						teacher:teacher,
						address:address
					},function(data){
						if(data==1){
							alert("报名成功！");
						}else{
							alert("报名失败！");
						}
				});
			}
		});
		
		
	});
	</script>
</body>
</html>