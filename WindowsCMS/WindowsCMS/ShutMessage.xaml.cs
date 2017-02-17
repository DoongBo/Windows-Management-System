using CRUDTest1;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading;
using System.Timers;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using System.Windows.Threading;
using WindowsCMS.ClassFile;

namespace WindowsCMS
{
    /// <summary>
    /// ShutMessage.xaml 的交互逻辑
    /// </summary>
    public partial class ShutMessage : Window
    {
        public ShutMessage()
        {
            InitializeComponent();
            timer.Tick += new EventHandler(timer_Tick);
            timer.Interval = TimeSpan.FromSeconds(1); 
        }
        DispatcherTimer timer = new DispatcherTimer();
        int secondnum = 30;
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            this.Topmost = true;
            timer.IsEnabled = true;
            timer.Start();
            second.Content = secondnum;
        }

        private void Window_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            this.DragMove();
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            secondnum += 30;
        }

        private void Button_Click_1(object sender, RoutedEventArgs e)
        {
          if(MessageBox.Show("确定立即关机？","正在关机",MessageBoxButton.YesNo)==MessageBoxResult.Yes)
            Shut();
        }
        private void Shut()
        {
            if (SqlHelper.OpenConnection())
            {
                SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_NowState=0 where PCM_Num='" + MessageClass.PCNum + "'");
                SqlHelper.ExecuteNonQuery("update t_signrecord set Record_HasExit=1 where Record_Id=" + MessageClass.recordid);
                SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_GetNewOpera=-1 where PCM_Num=@PCM_Num", new MySqlParameter("@PCM_Num", MessageClass.PCNum));
            }
            Process.Start("shutdown.exe", "-s -t 3");
          
        }
        void timer_Tick(object sender, EventArgs e)
        {
            secondnum--;
            second.Content = secondnum;
            if (secondnum <= 0)
                Shut();
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_GetNewOpera=-1 where PCM_Num=@PCM_Num", new MySqlParameter("@PCM_Num", MessageClass.PCNum));
            timer.Stop();
            this.Visibility = Visibility.Collapsed;
        }
      
    }
}
