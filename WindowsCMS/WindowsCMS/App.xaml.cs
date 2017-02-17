using CRUDTest1;
using WindowsCMS.ClassFile;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Runtime.InteropServices;
using System.Threading.Tasks;
using System.Windows;

namespace WindowsCMS
{
    /// <summary>
    /// App.xaml 的交互逻辑
    /// </summary>
    public partial class App : Application
    {
       
         private void Application_Exit(object sender, ExitEventArgs e)
         {
             if (SqlHelper.OpenConnection())
             {
                 SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_NowState=0 where PCM_Num='" + MessageClass.PCNum + "'");
                 SqlHelper.ExecuteNonQuery("update t_signrecord set Record_HasExit=1 where Record_Id="+MessageClass.recordid);
             }
            
         }
      
    }
}
