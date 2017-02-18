<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电工杯数学建模竞赛报名系统</title>
    <link href="/djb/Public/Css/bootstrap.min.css" rel="stylesheet">
    <link href="/djb/Public/Css/bootstrapValidator.min.css" rel="stylesheet">
</head>
<body>
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:100px;">
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
                    <form class="form-horizontal" id="form1" role="form">
                        <div class="form-group">
                        	<label for="password" class="col-sm-4 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                          	<div class="col-sm-8">
                            	<input type="password" class="form-control" id="password" name="password" placeholder="新密码">
                            </div>
                    	</div>
                        <div class="form-group">
                        	<label for="repassword" class="col-sm-4 control-label">确认密码</label>
                          	<div class="col-sm-8">
                            	<input type="password" class="form-control" id="repassword" name="repassword" placeholder="确认密码">
                            </div>
                    	</div>            
                    </form>
                 </div>
                 <div class="modal-footer">                   
                    <button type="button" id="register1" class="btn btn-primary">
                       确定
                    </button>
                 </div>                 
              </div>
        	</div>
        </div>
	<script src="/djb/Public/Js/jquery-1.12.4.min.js"></script>
    <script src="/djb/Public/Js/bootstrap.min.js"></script>
    <script src="/djb/Public/Js/bootstrapValidator.min.js"></script>
    <script>
	$(document).ready(function(){
		$('#register').modal('show');
		$('#form1').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
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
		}
		});
		$("#register1").click(function(){
			$('#form1').bootstrapValidator('validate');
			var username = "<?php echo ($username); ?>"
			var password = $("#password").val();
			if($('#form1').data('bootstrapValidator').isValid()){
				$.post("<?php echo U('Index/save');?>",
					{
						username:username,
						password:password,
					},function(data){
						if(data==1){
							alert("修改成功！");
							window.location.href="<?php echo U('Index/index');?>";
						}else{
							alert(data);
						}
				});
			}
		});
	});
	</script>
</body>
</html>