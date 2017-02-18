using CRUDTest1;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace CMSUserWeb
{
    public partial class Notice : System.Web.UI.Page
    {
        protected DataTable table = new DataTable();
        protected string titletxt;
        protected string contenttxt;
        protected string timetxt;
        protected string senderuser;
        protected void Page_Load(object sender, EventArgs e)
        {
            string mesid ="0";
             try{
              mesid=  Request["MesId"].ToString();
             }catch{}

             string selctxt = "select Notice_Title,Notice_Sender, Notice_Time,Notice_Content from t_notice where Notice_Id='" + mesid + "'";
             string cmdtxt = "select Notice_Id,Notice_Title,Notice_Sender, Notice_Time,Notice_Content  from t_notice  order by Notice_Id desc";
            table = SqlHelper.ExecuteDataTable(cmdtxt);
            DataTable noticetable = new DataTable();
            noticetable = SqlHelper.ExecuteDataTable(selctxt);
            if (noticetable.Rows.Count > 0)
            {
                senderuser = noticetable.Rows[0]["Notice_Sender"].ToString();
                titletxt = noticetable.Rows[0]["Notice_Title"].ToString();
                content.Text = noticetable.Rows[0]["Notice_Content"].ToString();
                contenttxt = noticetable.Rows[0]["Notice_Content"].ToString();
                timetxt ="@"+ noticetable.Rows[0]["Notice_Time"].ToString();
            }
            else
            {
                senderuser = table.Rows[0]["Notice_Sender"].ToString();
                titletxt = table.Rows[0]["Notice_Title"].ToString();
                content.Text = table.Rows[0]["Notice_Content"].ToString();
                contenttxt = table.Rows[0]["Notice_Content"].ToString();
                timetxt = "@" + table.Rows[0]["Notice_Time"].ToString();

            }
        }
    }
}