<%@ Page Title="重置密码" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="ResetPassword.aspx.cs" Inherits="CMSUserWeb.Account.ResetPassword" Async="true" %>

<asp:Content runat="server" ID="BodyContent" ContentPlaceHolderID="MainContent">
    <h2><%: Title %>.</h2>
    <p class="text-danger">
        <asp:Literal runat="server" ID="ErrorMessage" />
    </p>

    <div class="form-horizontal">
        <h4>输入新密码，忘记原密码请联系管理员</h4>
        <hr />

        <div class="form-group">
            <asp:Label runat="server" AssociatedControlID="Account" CssClass="col-md-2 control-label">你的学号</asp:Label>
            <div class="col-md-10">
                <asp:TextBox runat="server" ID="Account" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="Account"
                    CssClass="text-danger" ErrorMessage="“你的学号”字段是必填字段。" />
            </div>
        </div>
        <div class="form-group">
            <asp:Label runat="server" AssociatedControlID="OldPas"  CssClass="col-md-2 control-label">原有密码</asp:Label>
            <div class="col-md-10">
                <asp:TextBox runat="server" ID="OldPas" CssClass="form-control" TextMode="Password" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="OldPas"
                    CssClass="text-danger" ErrorMessage="“原有密码”字段是必填字段。" />
            </div>
        </div>
        <div class="form-group">
            <asp:Label runat="server" AssociatedControlID="Password" CssClass="col-md-2 control-label">新的密码</asp:Label>
            <div class="col-md-10">
                <asp:TextBox runat="server" ID="Password" TextMode="Password" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="Password"
                    CssClass="text-danger" ErrorMessage="“新的密码”字段是必填字段。" />
            </div>
        </div>
        <div class="form-group">
            <asp:Label runat="server" AssociatedControlID="ConfirmPassword" CssClass="col-md-2 control-label">确认密码</asp:Label>
            <div class="col-md-10">
                <asp:TextBox runat="server" ID="ConfirmPassword" TextMode="Password" CssClass="form-control" />
                <asp:RequiredFieldValidator runat="server" ControlToValidate="ConfirmPassword"
                    CssClass="text-danger" Display="Dynamic" ErrorMessage="“确认密码”字段是必填字段。" />
                <asp:CompareValidator runat="server" ControlToCompare="Password" ControlToValidate="ConfirmPassword"
                    CssClass="text-danger" Display="Dynamic" ErrorMessage="密码和确认密码不匹配。" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <asp:Button runat="server" OnClick="Reset_Click" Text="重置" CssClass="btn btn-default" />
            </div>
        </div>
    </div>
</asp:Content>
