using CRUDTest1;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace CMSUserWeb
{
    public partial class SignPage : System.Web.UI.Page
    {
        string pageurl = "Default.aspx";
        protected void Page_Load(object sender, EventArgs e)
        {
          
            try
            {
                pageurl = Request["PageUrl"].ToString();
            }
            catch { }

            if ( Session["UserNum"] == null ||  Session["UserNum"].ToString() == "")
            {
                txt_account.Focus();
            }
            else
            {
                Response.Write("<script>window.location.href='../Default.aspx';</script>");
            }
            
        }

        protected void btn_Sign_Click(object sender, EventArgs e)
        {
            string account = txt_account.Text.Trim();
            string psd = txt_psd.Text.Trim();
            if(account.Length<=0||psd.Length<=0)
                return;
            
              string selectxt = "select User_Num,User_Name,User_Class from t_user where User_Num=@User_Num and User_PSD=MD5(@User_PSD)";
            DataTable selecttable = SqlHelper.ExecuteDataTable(selectxt, new MySqlParameter[] { new MySqlParameter("@User_Num",account), 
                new MySqlParameter("@User_PSD",psd)});
            if(selecttable==null)
            {
                hiddiv.Visible = true;
            }
            if(selecttable.Rows.Count>0)
            {
                Session["UserNum"] = selecttable.Rows[0]["User_Num"].ToString();
                Session["UserName"] = selecttable.Rows[0]["User_Name"].ToString();
                Session["UserClass"] = selecttable.Rows[0]["User_Class"].ToString();
                Session.Timeout = 10;
                Response.Write("<script>window.location.href='../" + pageurl + "';</script>");
            }
            else
            {
                hiddiv.Visible = true;
            }
        }
    }
}