
<%@ Page Title="个人登录记录" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Record.aspx.cs" Inherits="CMSUserWeb.Record" %>
<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">
    <script>
        function f()
        {
            var ui = document.getElementById('bar280');
            var width = ui.style.width;
            alert(width+"");
        }
    </script>
   <h6>  <label class="list-group-item active">
    &nbsp&nbsp<%=username %>&nbsp&nbsp<%=usernum %>&nbsp&nbsp<%=userdept %>&nbsp&nbsp<%=userclass %>&nbsp&nbsp<%=nowterm %>
  </label></h6>
    <h4>你本学期在机房的登录记录如下</h4>
    <table class="table table-striped table-hover " onloadstart="f()">
  <thead>
    <tr>
      <th>#</th>
      <th>登录机号</th>
      <th>参与课程</th>
      <th>登录时间</th>
      <th>登录时长(/min)</th>
    </tr>
  </thead>
        <tbody>
            <%if (table_signrecord!=null) %>
            <%for (int i = table_signrecord.Rows.Count - 1; i > 0; i--)
              { %>
            <%if (i % 2 == 0)
              { %>
            <tr class="success">
                <%}
              else
              { %>
            <tr>
                <%} %>
                <td><%=i %></td>
                <td><%=table_signrecord.Rows[i]["Record_PCNum"].ToString() %></td>
                <td><%=table_signrecord.Rows[i]["Record_CourseName"].ToString() %></td>
                <td><%=table_signrecord.Rows[i]["Record_InTime"].ToString() %></td>
                <td><%=table_signrecord.Rows[i]["Record_TimeSpan"].ToString()%>&nbsp&nbsp(<%=Convert.ToInt32(table_signrecord.Rows[i]["Record_TimeSpan"])*2%>/50)
                    <div class="progress"  >
                       <div class="progress-bar" id="bar<%=i %>" style="width: <%=Convert.ToInt32(table_signrecord.Rows[i]["Record_TimeSpan"])*2%>%"></div>
                    </div>
                    </td>
            </tr>

            <% } %>
        </tbody>
</table> 
</asp:Content>
