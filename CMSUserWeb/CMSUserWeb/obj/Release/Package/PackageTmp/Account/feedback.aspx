<%@ Page Language="C#" AutoEventWireup="true" MasterPageFile="~/Site.Master" CodeBehind="feedback.aspx.cs" Inherits="CMSUserWeb.Account.feedback" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
    <script>
         setTimeout(function () { document.getElementById("hiddiv").style.display = "none";if(<%=hassucc%>==1) window.location = "../Default.aspx"; }, 2000);
        //1000是多久被隐藏，单位毫秒
    </script>
    <div class="row" style="height:600px">
        <h3 id="titletxt" runat="server">我有一些建议或问题</h3>
        <div id="hiddiv">
            <div style="text-align: center; margin: 0 auto; color: blue" runat="server" id="succdiv" visible="false">
                <h4>感谢你的建议，我们已成功接收！</h4>
            </div>
            <div style="text-align: center; margin: 0 auto; color: blue" runat="server" id="errodiv" visible="false">
                <h4>对不起，服务器开小差了，请重新发送！</h4>
            </div>
        </div>
        <asp:Label runat="server" ID="errotxt" ForeColor="Red" Visible="false"></asp:Label>
        <br />
        <label>请输入标题</label><br />
        <asp:TextBox runat="server" AutoCompleteType="Disabled" Height="30px" Width="60%" ID="inputitle" TextMode="MultiLine" CssClass="form-control"></asp:TextBox>
        <br />
        <label>请输入内容</label><br />
        <asp:TextBox runat="server" AutoCompleteType="Disabled" Width="100%" Height="220px" ID="inputcontent" TextMode="MultiLine" CssClass="form-control"></asp:TextBox>
        <br />
        <div class="col-md-4"></div>
        <div class="col-md-2"  style="margin:10px auto;text-align:center">
            <asp:TextBox runat="server" AutoCompleteType="Disabled" ID="inputnum" CssClass="form-control" Width="160px" ReadOnly="true">你的学号</asp:TextBox>
        </div>
        <div class="col-md-2"  style="margin:10px auto;text-align:center">
                        <asp:TextBox runat="server" AutoCompleteType="Disabled" ID="inputname" Width="160px" CssClass="form-control" ReadOnly="true">你的姓名</asp:TextBox>
        </div>
        <div class="col-md-2" style="margin:10px auto;text-align:center">
            <asp:Button runat="server" ID="btaddnotice" OnClick="btn_Click" BackColor="#428bca" ForeColor="White"  CssClass="btn btn-default"   Width="200px" Height="30px" Text="提交" />
        </div>
        
    </div>
</asp:Content>