using System;
using System.Linq;
using System.Web;
using System.Web.UI;
using Microsoft.AspNet.Identity;
using Microsoft.AspNet.Identity.Owin;
using Owin;
using CMSUserWeb.Models;
using System.Data;
using CRUDTest1;
using MySql.Data.MySqlClient;

namespace CMSUserWeb.Account
{
    public partial class ResetPassword : Page
    {
        protected string StatusMessage
        {
            get;
            private set;
        }

        protected void Reset_Click(object sender, EventArgs e)
        {
            if (Account.Text.ToString().Trim().Length != 13)
            {
                ErrorMessage.Text = "输入学号格式错误！";
                return;
            }
            string account = Account.Text.Trim();
            string psd = OldPas.Text.Trim();
            string confirmpsd=ConfirmPassword.Text.Trim();
            string selectxt = "select User_Num,User_Name，User_Class from t_user where User_Num=@User_Num and User_PSD=MD5(@User_PSD)";
            DataTable selecttable = SqlHelper.ExecuteDataTable(selectxt, new MySqlParameter[] { new MySqlParameter("@User_Num",account), 
                new MySqlParameter("@User_PSD",psd)});
            if (selecttable.Rows.Count > 0)
            {
                if (SqlHelper.ExecuteNonQuery("update t_user set User_PSD=MD5(@User_PSD)", new MySqlParameter("@User_PSD", confirmpsd)) > 0)
                {
                    Response.Write("<script>window.location.href='../Account/ResetPasswordConfirmation.aspx';</script>");
                    return;
                }
                else
                {
                    ErrorMessage.Text = " 修改失败！";
                   
                    return;
                }
 
            }
            ErrorMessage.Text = " 原有密码错误！";

        }
    }
}