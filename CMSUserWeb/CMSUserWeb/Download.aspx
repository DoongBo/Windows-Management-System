<%@ Page Title="文件下载" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Download.aspx.cs" Inherits="CMSUserWeb.Download" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
    <h3 style="margin-top:100px;margin-bottom:50px">你需要的课件都在这里</h3>
    <div class="row">
        <%string owner = ""; if(filetable!=null) for (int j = 0; j < filetable.Rows.Count; ){
              owner = filetable.Rows[j]["File_Ownner"].ToString();%>
        <div class="col-md-4" style="padding: 10px">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">上传者：<%=owner %></h3>
                </div>
                <div class="list-group">
                    <%for (int i = j; i < filetable.Rows.Count && filetable.Rows[i]["File_Ownner"].ToString() == owner; i++)
                      {
                          j++;%>
                    <a class="list-group-item" style="min-height:100px" target="_blank" href="http://59.72.212.6/PCM/Public/Upload/<%=filetable.Rows[i]["File_Path"].ToString()%>" title="下载/预览">
                         <h5 class="list-group-item-heading"><%=filetable.Rows[i]["File_Name"] %></h5>
                        <p class="list-group-item-text">&nbsp&nbsp 于&nbsp<%=filetable.Rows[i]["File_Time"].ToString()%>上传</p>
                        <p class="list-group-item-text" style="color:black">&nbsp&nbsp<%=filetable.Rows[i]["File_Other"] %></p>
                    </a>
                    <%} %>
                </div>

            </div>
        </div>
        <%} %>
    </div>
</asp:Content>
