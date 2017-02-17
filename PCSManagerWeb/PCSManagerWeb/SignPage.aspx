<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="SignPage.aspx.cs" Inherits="PCSManagerWeb.SignPage" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title></title>
    <link href="~/Content/bootstrap.css" rel="stylesheet" type="text/css"/>
 <style type="text/css">
#container {
    color: #154BA0;
     background:white;
    filter: Alpha(Opacity=00, Style=0);
   -moz-opacity:0.0;opacity: 0.0;z-index:100;
   position:fixed;
    width:500px;
    z-index:20;
    height:330px; 
}
.back{
    width:102%;float:right;margin-top:-10px;margin-right:-10px;
}
.center{ 
    position:fixed; 
    margin:auto; 
    left:0; 
    right:0; 
    top:0; 
    bottom:0; 
    width:350px; 
    height:150px; 
     z-index:90;
     float:left;
     color:black;
     font-size:20px;
   
}
</style>

</head>
<body>
    <form runat="server">
        <div class="center">
            <h2 style="color:white;margin-top:-50px;margin-left:10px;margin-bottom:50px;">机房管理员登录</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table style="width:100%">
                        <tr>
                            <td>
                                账户：
                            </td>
                            <td>
                                <asp:TextBox runat="server" CssClass="form-control"></asp:TextBox>
                            </td>
                        </tr>
                    </table>
                       
                  </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                <table style="width:100%">
                        <tr>
                            <td>
                                密码：
                            </td>
                            <td>
                                <asp:TextBox runat="server" CssClass="form-control" TextMode="Password"></asp:TextBox>
                            </td>
                        </tr>
                    </table>
                    </div>
            </div>
            <a href="/" style="color:lightblue;font-size:12px;">修改密码</a>
            <a class="btn btn-primary btn-lg" style="float:left;width:350px;" href="#">登(SIGN)录</a>

        </div>
        <div id="container" style="height: 102%; width: 102%; margin-left: -10px; margin-top: -10px">
        </div>

        <div>
            <img src="../JPG/backjpeg.jpg" class="back" />

        </div>
    </form>
</body>
</html>
