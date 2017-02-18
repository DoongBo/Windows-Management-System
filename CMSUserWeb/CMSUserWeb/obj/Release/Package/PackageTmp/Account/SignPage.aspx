<%@ Page Language="C#" Title="学生登录" AutoEventWireup="true" CodeBehind="SignPage.aspx.cs" Inherits="CMSUserWeb.SignPage" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title></title>
    <link href="~/Content/bootstrap.css" rel="stylesheet" type="text/css"/>
 <style type="text/css">
#container {
    color: #154BA0;
     background:black;
    filter: Alpha(Opacity=5, Style=0);
   -moz-opacity:0.5;opacity: 0.5;z-index:100;
   position:fixed;
    width:500px;
    z-index:0;
    height:330px; 
}
#container:hover{
    color: #154BA0;
     background:black;
    filter: Alpha(Opacity=2, Style=0);
   -moz-opacity:0.2;opacity: 0.2;z-index:100;
   position:fixed;
    width:500px;
    z-index:0;
    height:330px; 
}

.back{
    z-index:-50;
    width:102%;float:right;margin-top:-10px;margin-right:-10px;
}
.center{ 
    position:fixed; 
    background:#cfd9dc;
    margin:auto; 
    left:0; 
    right:0; 
    top:-80px; 
    bottom:0; 
    width:450px; 
    padding:50px;
    height:380px; 
     z-index:10;
     float:left;
     color:black;
     font-size:15px;
     border: 1px solid transparent;
     border-radius: 5px;
   
}


</style>

</head>
<body>
     <script>
        setTimeout(function () { document.getElementById("hiddiv").style.display = "none"; }, 2000);
        //1000是多久被隐藏，单位毫秒
    </script>

    <form runat="server" >
        <div>
               <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../Default.aspx" class="navbar-brand">网址导航</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
           <ul class="nav navbar-nav">
              <li class="dropdown">
              <a  href="../Notice">广而告知</a>
            </li>
            <li class="dropdown">
              <a  href="../Record">登录记录</a>
            </li>
            <li>
             <a href="../Download">下载文件</a>
            </li>
            <li class="dropdown">
              <a href="../RoomOrder">机房排课 </a>
            </li>
              <li>
             <a  href="../Account/feedback.aspx">意见反馈</a>
            </li>

          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <%if(Session["UserNum"]!=null&&Session["UserNum"].ToString()!="") {%>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="username">
                  <%=Session["UserClass"].ToString()+" "+  Session["UserName"].ToString() %>
                  <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="username"  style="width:100px">
                <li><a href="../Account/LogOut.aspx">注销</a></li>
              </ul>
                <%}else{ %>
                <a class="dropdown-toggle"  href="../Account/SignPage.aspx" id="sign">登录</a>
                <%} %>
            </li>
          </ul>

        </div>
      </div>
    </div>
        </div>
        <div id="container" style="height: 102%; width: 102%; margin-left: -10px; margin-top: -10px">
        </div>
        <div class="center">
            <h4 style="color:#0094ff;margin-bottom:30px">学生登录</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table style="width:100%">
                        <tr>
                            <td>
                                账户：
                            </td>
                            <td>
                                <asp:TextBox ID="txt_account" runat="server" CssClass="form-control"></asp:TextBox>
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
                                <asp:TextBox runat="server" ID="txt_psd" CssClass="form-control" TextMode="Password"></asp:TextBox>
                            </td>
                        </tr>
                    </table>
                    </div>
            </div>
            <div runat="server" id="hiddiv" visible="false" style="color:red;margin-left:80px">
                                        对不起，账户或密码错误！
             </div>
            <a href="ResetPassword.aspx" style="color:black;font-size:12px;margin-bottom:10px;">修改密码</a>
            <asp:Button runat="server" ID="btn_Sign" CssClass="btn btn-primary btn-lg" OnClick="btn_Sign_Click" style="float:left;width:350px;" Text="登(SIGN IN)录"/>

        </div>
        

        <div>
            <img src="../JPG/backjpeg.jpg" class="back" />
        </div>
    </form>
</body>
</html>
