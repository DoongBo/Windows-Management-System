using CRUDTest1;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Providers.Entities;
using System.Web.SessionState;
namespace CMSUserWeb.Account
{
    /// <summary>
    /// ReDirector 的摘要说明
    /// </summary>
    public class ReDirector : IHttpHandler, IRequiresSessionState
    {

        public void ProcessRequest(HttpContext context)
        {
            //try
            //{
                context.Response.ContentType = "text/plain";
                string account = context.Request["Account"].ToString();
                string selectxt = "select User_Num,User_Name，User_Class from t_user where User_Num=@User_Num";
                DataTable selecttable = SqlHelper.ExecuteDataTable(selectxt, new MySqlParameter[] { new MySqlParameter("@User_Num", account) });
                if (selecttable.Rows.Count > 0)
                {
                    context.Session["UserNum"] = selecttable.Rows[0]["User_Num"].ToString();
                    context.Session["UserName"] = selecttable.Rows[0]["User_Name"].ToString();
                    context.Session["UserClass"] = selecttable.Rows[0]["User_Class"].ToString();
                    context.Session.Timeout = 10;
                    string url = context.Request["PageUrl"].ToString();
                    context.Response.Redirect("../"+url.Trim());
                    return;
                }
                else
                {
                    context.Response.Redirect("../Account/SignPage.aspx");
                }
            //}
            //catch {
            //    context.Response.Redirect("/");
            //}
        }

        public bool IsReusable
        {
            get
            {
                return false;
            }
        }
    }
}