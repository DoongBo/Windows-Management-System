<%@ Page Title="机房排课" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="RoomOrder.aspx.cs" Inherits="CMSUserWeb.RoomOrder" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
   <h3></h3>
            <div  style="text-align: center;min-height:400px; margin-left: 15px; margin-right: 15px;">
                <div class="modal-dialog" style="width:1000px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">本学期机房时间安排表，若有变更会发布通知！ </h4>
                        </div>
                        <div class="modal-body">
                            <img src="http://59.72.212.6/PCM/Public/Upload/course.jpg" style="width:100%"/>
                            <h5><small><cite title="Source Title">@<%=DateTime.Now.Year %></cite></small></h5>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
</asp:Content>
