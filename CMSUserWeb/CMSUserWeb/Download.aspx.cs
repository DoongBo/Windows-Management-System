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
    public partial class Download : System.Web.UI.Page
    {
        public DataTable filetable;
        protected void Page_Load(object sender, EventArgs e)
        {
            
            filetable = SqlHelper.ExecuteDataTable("select File_Id,File_Name, File_Path,File_Ownner,File_Time,File_Other from t_file order by File_Ownner,File_Time desc");
            
          

        }
    }
   
}