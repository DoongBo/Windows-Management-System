using CRUDTest1;
using Microsoft.Win32;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Drawing;
using System.Drawing.Drawing2D;
using System.Drawing.Imaging;
using System.IO;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Runtime.InteropServices;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Interop;
using System.Windows.Media.Imaging;
using WindowsPSR;

namespace WindowsCMS.ClassFile
{
   public class OperateHidden
    {

        private const string path = @"C:\Windows\WinSxS\wow64_microsoft-windows-a..roblemstepsrecorder_31bf3856ad364e35_10.0.14393.0_none_12baa6f9960d2950";//这个path就是你要调用的exe程序的绝对路径
        static string ftpServerIP = "59.72.212.6";
        static string ftpUserID = "ruanjianjidi";
        static string ftpPassword = "ruanjianyanfazhongxin";
        //添加登录记录
        public static string InsertSignRecord()
        {
            //添加登录记录
            SqlHelper.ExecuteNonQuery("update t_signrecord set Record_HasExit=1 where  Record_Num='" + MessageClass.UserNum + "'");
            string recordid = "-1";
           

            string inserttxt = "insert into t_signrecord(Record_Num,Record_Name,Record_InTime,Record_OutTime,Record_CourseName,Record_PCNum,Record_RoomName,Record_HasExit) " +
                            "values(@Record_Num,@Record_Name,now(),now(),@Record_CourseName,@Record_PCNum,@Record_RoomName,0)";
            MySqlParameter[] param = new MySqlParameter[] { new MySqlParameter("Record_Num",MessageClass.UserNum),
                                                            new MySqlParameter("Record_Name",MessageClass.UserName),
                                                            new MySqlParameter("Record_CourseName",MessageClass.Course),
                                                            new MySqlParameter("Record_PCNum",MessageClass.PCNum),
                                                            new MySqlParameter("Record_RoomName",MessageClass.RoomName)
                                                            };
            SqlHelper.ExecuteNonQuery(inserttxt,param);
            recordid = SqlHelper.ExecuteDataTable("select Record_Id from t_signrecord where Record_Num=@Record_Num order by Record_Id desc", new MySqlParameter("@Record_Num", MessageClass.UserNum)).Rows[0][0].ToString();
            MessageClass.recordid = Convert.ToInt32(recordid);
            string signtime =SqlHelper.ExecuteScalar("select now()").ToString();
            SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_NowState=2 ,PCM_Course='"+MessageClass.Course+"',PCM_UserNum='" + MessageClass.UserNum + "' where PCM_Num='" + MessageClass.PCNum + "'");
           
            MessageClass.SignTime = signtime;
            return recordid;
        }
       //更新登录记录的时间
       public static void UpdateSignOutTime(int record_id)
       {
           string updatetxt = "update t_signrecord set Record_OutTime=now() where Record_Id=@Record_Id";
           string update = "update t_pcmessage set PCM_LastTime=now() where PCM_Num =@PCM_Num ";
           SqlHelper.ExecuteNonQuery(updatetxt, new MySqlParameter("@Record_Id",record_id));
           SqlHelper.ExecuteNonQuery(update, new MySqlParameter("@PCM_Num", MessageClass.PCNum));
           string nowtime = SqlHelper.ExecuteScalar("select now()").ToString();
           MessageClass.NowTime = nowtime;
       }
       #region
       /// <summary>
       /// 获取屏幕截屏和进程名，并上传到服务器
       /// </summary>

    
       
       //上传截屏图片和进程名
       private static void UpLoadJpg(string jpgname)
       {
           string filename = System.AppDomain.CurrentDomain.BaseDirectory + "ScreenRecord\\" + jpgname;
           FtpUpDown ftp = new FtpUpDown(ftpServerIP, ftpUserID, ftpPassword);
           string ftppath = ftpServerIP + @"\PCM\Public\Upload";

           bool bol = ftp.Upload(filename, ftppath);
           while (System.IO.File.Exists(filename))
               System.IO.File.Delete(filename);
           //添加操作监控记录
           string oprecord =  "update t_pcmessage set PCM_AppRecord=@PCM_AppRecord,PCM_ScreenJpgsrc=@PCM_ScreenJpgsrc where PCM_Num=@PCM_Num";
           SqlHelper.ExecuteNonQuery(oprecord,
                                           new MySqlParameter("@PCM_Num", MessageClass.PCNum),
                                           new MySqlParameter("@PCM_AppRecord", Monitor_SMON()),
                                           new MySqlParameter("@PCM_ScreenJpgsrc", jpgname)
                                           );
           string insert = "insert into t_scrrecord(Src_SignId,Src_Imagurl) values(@Src_SignId,@Src_Imagurl)";
           SqlHelper.ExecuteNonQuery(insert, new MySqlParameter("Src_SignId", MessageClass.signid), new MySqlParameter("Src_Imagurl", jpgname));

       }
    
       //获取截屏
       public static void UpdateScreen(bool update)
       {
           string strurl = System.AppDomain.CurrentDomain.BaseDirectory;
           string dirpath = strurl + "ScreenRecord";
           if (System.IO.Directory.Exists(dirpath))
           {
               
           }
           else
           {
               System.IO.DirectoryInfo directoryinfo = new DirectoryInfo(dirpath);
               directoryinfo.Create();
           }

           BitmapSource image = CopyScreen();
           MemoryStream ms = new MemoryStream();
           BitmapEncoder enc = new BmpBitmapEncoder();
           enc.Frames.Add(BitmapFrame.Create(image));
           enc.Save(ms);
           Bitmap img = new Bitmap(ms);
           ms.Flush();
           ms = new MemoryStream();
           string time=Convert.ToDateTime(MessageClass.NowTime).ToString("yyyyMMdd_HHmm");
           string imgname = time +@"_"+ MessageClass.PCNum + @".jpg";
           if (System.IO.File.Exists(dirpath + "\\" + imgname))
               System.IO.File.Delete(dirpath + "\\" + imgname);
           img.Save(dirpath + "\\" + imgname, System.Drawing.Imaging.ImageFormat.Jpeg);
           ZoomJpg(dirpath+"\\"+imgname,dirpath+@"\\screen_"+imgname);
           UpLoadJpg(@"screen_"+imgname);
           if(update)
           SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_GetNewOpera=-1 where PCM_Num=@PCM_Num", new MySqlParameter("@PCM_Num", MessageClass.PCNum));
       }
       public static void ZoomJpg(string filePath, string filePath_ystp) //压缩图片
       {
           //Bitmap
           Bitmap bmp ;
           //ImageCoderInfo 
           ImageCodecInfo ici ;
           //Encoder
           System.Drawing.Imaging.Encoder ecd ;
           //EncoderParameter
           EncoderParameter ept ;
           //EncoderParameters
           EncoderParameters eptS ;
           try
           {
               using (FileStream fs = new FileStream(filePath, FileMode.Open))
               {
                   bmp = new Bitmap(fs);
                   ici = getImageCoderInfo(@"image/jpeg");
                   ecd = System.Drawing.Imaging.Encoder.Quality;
                   eptS = new EncoderParameters(1);
                   ept = new EncoderParameter(ecd, 10L);
                   eptS.Param[0] = ept;
                   bmp.Save(filePath_ystp, ici, eptS);
                   bmp.Dispose();
                   ept.Dispose();
                   eptS.Dispose();
                 
               }
           }
           catch 
           {
               
           }
           while (System.IO.File.Exists(filePath))
               System.IO.File.Delete(filePath);
       
       }
       private static ImageCodecInfo getImageCoderInfo(string coderType)// 获取图片编码类型信息
       {
           ImageCodecInfo[] iciS = ImageCodecInfo.GetImageEncoders();

           ImageCodecInfo retIci = null;

           foreach (ImageCodecInfo ici in iciS)
           {
               if (ici.MimeType.Equals(coderType))
                   retIci = ici;
           }

           return retIci;
       }

       static BitmapSource CopyScreen()
       {
           using (var screenBmp = new Bitmap((int)SystemParameters.PrimaryScreenWidth, (int)SystemParameters.PrimaryScreenHeight, System.Drawing.Imaging.PixelFormat.Format32bppArgb))
           {
               using (var bmpGraphics = Graphics.FromImage(screenBmp))
               {
                   bmpGraphics.CopyFromScreen(0, 0, 0, 0, screenBmp.Size);
                   return Imaging.CreateBitmapSourceFromHBitmap(
                       screenBmp.GetHbitmap(),
                       IntPtr.Zero,
                       Int32Rect.Empty,
                       BitmapSizeOptions.FromEmptyOptions());
               }
           }

       }
       #endregion
  

       //关机

     private static  TeacherScreen teacherscreen = new TeacherScreen();
   
       //监控进程，并分辨是否违规
       public static string Monitor_SMON()
       {
           string txt = "";
           Process[] ps = Process.GetProcesses();//获取计算机上所有进程
           foreach (Process p in ps)
           {
               try
               {
                   if (p.MainWindowTitle!="")
                   txt += p.MainWindowTitle + ",";
               }
               catch
               {

               }
               
           }
           return txt;
            
       }
       public static bool CheckHasExit()
       {
           string hasexcit = SqlHelper.ExecuteScalar("select Record_HasExit from t_signrecord where Record_Id="+MessageClass.recordid).ToString();
           if(hasexcit=="1")
           {
               return true;
           }
           return false;
       }

       public int CheckOrder()
       {
           string order = SqlHelper.ExecuteScalar("select PCM_GetNewOpera from t_pcmessage where PCM_Num=@PCM_Num", new MySqlParameter("@PCM_Num",MessageClass.PCNum)).ToString();
           if(order=="")
           {
               return -1;
           }
           int chose = Convert.ToInt32(order);

           if(chose==0)
           {
               UpdateScreen(true);
           }
           return chose;
           
       }


    }
}
