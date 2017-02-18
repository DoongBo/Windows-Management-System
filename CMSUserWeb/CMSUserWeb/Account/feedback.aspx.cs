using CRUDTest1;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace CMSUserWeb.Account
{
    public partial class feedback : System.Web.UI.Page
    {
        protected int hassucc = 0;
        protected void Page_Load(object sender, EventArgs e)
        {

            if (Session["UserNum"] == null || Session["UserNum"].ToString() == "")
            {
                Response.Write("<script>window.location.href='../Account/SignPage.aspx?PageUrl=../Account/feedback.aspx';</script>");
                return;
            }
            inputnum.Text = Session["UserNum"].ToString();
            inputname.Text = Session["UserName"].ToString();
        }

        protected void btn_Click(object sender, EventArgs e)
        {
            if (inputitle.Text.Trim() == "")
            {
                errotxt.Visible = true;
                errotxt.Text = "请输入标题";
                inputitle.Focus();

            }
            else if (inputcontent.Text.Trim() == "")
            {
                errotxt.Visible = true;
                errotxt.Text = "请输入内容";
                inputcontent.Focus();
            }

            else
            {
                errotxt.Text = "";
                errotxt.Visible = false;

                string cmd = "insert into t_message(Message_Sender,Message_UserNum,Message_Title,Message_Content,Message_Time,Message_Type) values(@Message_Sender,@Message_UserNum,@Message_Title,@Message_Content,@Message_Time,0)";
                MySqlParameter[] param = new MySqlParameter[]{ new MySqlParameter("@Message_Sender",inputname.Text.Trim()),new MySqlParameter("@Message_UserNum",inputnum.Text.Trim()),new MySqlParameter("@Message_Title",inputitle.Text.Trim()),
                new MySqlParameter("@Message_Content",inputcontent.Text.Trim()),new MySqlParameter("@Message_Time",DateTime.Now.ToString())};
                if (SqlHelper.ExecuteNonQuery(cmd, param) > 0)
                {
                    succdiv.Visible = true;
                    errodiv.Visible = false;
                    inputname.Focus();
                    hassucc = 1;
                }
                else
                {
                    inputname.Focus();
                    errodiv.Visible = true;
                    succdiv.Visible = false;
                }

            }
        }
    }
}