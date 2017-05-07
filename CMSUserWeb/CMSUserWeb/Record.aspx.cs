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
    public partial class Record : System.Web.UI.Page
    {
        public static string username;
        public static string usernum;
       public  DataTable table_signrecord=new DataTable();
       public static string userdept = "";
       public static string userclass = "";
       public static string nowterm = "";
       
       public DataTable usertable = new DataTable();
       
        protected void Page_Load(object sender, EventArgs e)
        {
            
            if (Session["UserNum"] == null || Session["UserNum"].ToString() == "")
            {
                Response.Write("<script>window.location.href='../Account/SignPage.aspx?PageUrl=Record.aspx';</script>");
                return;
            }
            string startterm, endterm;
            DataTable termtable = SqlHelper.ExecuteDataTable("select Term_Name,Term_StartDate,Term_EndDate from t_term where datediff(Term_StartDate,now())<=0 and datediff(Term_EndDate,now())>=0");
            if (termtable!=null&&termtable.Rows.Count > 0)
            {
                nowterm = termtable.Rows[0]["Term_Name"].ToString();
                startterm = termtable.Rows[0]["Term_StartDate"].ToString();
               
                endterm = termtable.Rows[0]["Term_EndDate"].ToString();
                try
                {
                    startterm = Convert.ToDateTime(startterm).ToString("yyyy-MM-dd");
                    endterm = Convert.ToDateTime(endterm).ToString("yyyy-MM-dd");
                }
                catch
                {

                }
            }
            else
            {
                startterm = "2017-1-1 0:0:0";
                endterm = "2100-1-1 0:0:0";
            }
            username = Session["UserName"].ToString();
            usernum = Session["UserNum"].ToString();
            string recordseelct = "select Record_PCNum,Record_CourseName,Record_InTime, TIMESTAMPDIFF(MINUTE,Record_InTime,Record_OutTime) as Record_TimeSpan  from t_signrecord  where Record_Num=@Record_Num and Record_InTime between @satrttime and @endtime";
            table_signrecord = SqlHelper.ExecuteDataTable(recordseelct, new MySqlParameter("@Record_Num", usernum), new MySqlParameter("@satrttime", startterm), new MySqlParameter("@endtime", endterm));

           
            usertable = SqlHelper.ExecuteDataTable("select User_Dept,User_Class from t_user where User_Num=@User_Num", new MySqlParameter("@User_Num", usernum));
            if (usertable.Rows.Count > 0)
            {
                userdept = usertable.Rows[0]["User_Dept"].ToString();
                userclass = usertable.Rows[0]["User_Class"].ToString();
            }
        }
        
        //protected void mydatagrid_SortCommand(object source, DataGridSortCommandEventArgs e)
        //{
        //    //table = SqlHelper.ExecuteDataTable(cmdtxt);
        //    //studentscount.Text = table.Rows.Count + "";
        //    //string SortExpression = e.SortExpression.ToString();
        //    //string SortDirection = "ASC";
        //    //SortDirection = (mydatagrid.Attributes["SortDirection"].ToString() == SortDirection ? "DESC" : "ASC");
        //    //mydatagrid.Attributes["SortDirection"] = SortDirection;
        //    //DataView dv = table.DefaultView;
        //    //dv.Sort = SortExpression + " " + SortDirection;
        //    //mydatagrid.DataSource = dv.ToTable();
        //    //mydatagrid.DataBind();
        //}
    }
}