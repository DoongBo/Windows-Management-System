using CRUDTest1;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Management;
using System.Text;
using System.Threading.Tasks;

namespace WindowsCMS.ClassFile
{
   public static class MessageClass
    {
       public static string signid = "-1";
       public static bool sqlconnect = false;
       public static bool hasmht = false;
       public static bool canclose = false;
       public static string PCNum = "";
       public static string RoomName = "";
       public static string UserNum = "";
       public static string UserName = "";
       public static string MacAddress= "";
       public static string Course = "";
       public static string SignTime = "";
       public static string NowTime = "";
       public static int recordid = -1;
       public static void  ClearValue()
       { 
         canclose = false;
         PCNum = "";
         RoomName = "";
         UserNum = "";
         UserName = "";
         MacAddress= "";
         Course = "";
         SignTime = "";
         NowTime = "";
         recordid = 0;
       }
       public static bool CheckMacFromSql()//查找数据库中有没有本台电脑的MAC地址记录
       {
           try { 
           string macaddress = GetMacAddress();
           MacAddress = macaddress;
           string selectxt = "select PCM_RoomName,PCM_Num from t_pcmessage where PCM_Mac=@PCM_Mac";
           DataTable selresult = SqlHelper.ExecuteDataTable(selectxt, new MySqlParameter("@PCM_Mac", macaddress));
           if (selresult.Rows.Count<=0)
               return false;
           else
           {
               PCNum = selresult.Rows[0]["PCM_Num"].ToString();
               RoomName = selresult.Rows[0]["PCM_RoomName"].ToString();
               string nowtime = SqlHelper.ExecuteScalar("select now()").ToString();
               NowTime = nowtime;
               return true;
           }
           }
           catch { return false; }
       }
       private static string GetMacAddress()//获取本机MAC地址
       {
           string mac = "";
           try
           {
               ManagementClass mc = new ManagementClass("Win32_NetworkAdapterConfiguration");
               ManagementObjectCollection moc = mc.GetInstances();

               foreach (ManagementObject mo in moc)
                   if ((bool)mo["IPEnabled"] == true)
                   {
                       mac += mo["MacAddress"].ToString() + " ";
                       break;
                   }
           }
           catch 
           {
               

           }
           return mac;

       }


    }
}
