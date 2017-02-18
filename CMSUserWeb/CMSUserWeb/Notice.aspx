
<%@ Page Title="公告" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Notice.aspx.cs" Inherits="CMSUserWeb.Notice" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
    <div style="min-height: 300px">
        <div class="jumbotron">
            <h2>通知详情</h2>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <div class="list-group-item active">
                        所有通知
                    </div>
                    <%if (table.Rows.Count > 0) for (int i = 0; i < table.Rows.Count; i++)
                          { %>
                    <a class="list-group-item" href="Notice.aspx?MesId=<%=table.Rows[i]["Notice_Id"].ToString() %>"><%=table.Rows[i]["Notice_Title"].ToString()+"\t/\t"+Convert.ToDateTime(table.Rows[i]["Notice_Time"].ToString()).ToString("yyyy年MM月dd日") %> </a>
                    <input name="MesId" hidden="hidden" value='<%=table.Rows[i]["Notice_Id"].ToString() %>' />
                    <%} %>
                </div>
            </div>

            <div class="col-md-8" style="text-align: center; margin-left: 15px; margin-right: 15px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><%= titletxt%> </h4>
                        </div>
                        <div class="modal-body">                         
                            <asp:TextBox Height="200" ID="content" AutoCompleteType="Disabled" TextMode="MultiLine" ReadOnly="true" EnableTheming="true" CssClass="form-control" runat="server" BorderWidth="0" Width="100%"></asp:TextBox>
                            <h5><small><%=senderuser %> <cite title="发布时间"><%=timetxt %></cite></small></h5>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</asp:Content>

