using WindowsCMS.ClassFile;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Forms;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using Microsoft.Win32;
using System.Text.RegularExpressions;
using System.Windows.Threading;
using CRUDTest1;
using System.Threading;
using System.ComponentModel;
using System.Diagnostics;
using System.Data;
using MySql.Data.MySqlClient; 

namespace WindowsCMS
{
    /// <summary>
    /// PCMOnline.xaml 的交互逻辑
    /// </summary>
    public partial class PCMOnline : Window
    {
        public PCMOnline()
        {
            record = new Record();
            record.isexcit = "-1";
           
            InitializeComponent();
            
        }
        Record record;
        Hook hook = new Hook();//截断alt+space，获取alt+ctrl+o事件
        private void Window_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            this.DragMove();
        }

        private void bt_min_Click(object sender, RoutedEventArgs e)
        {
            this.Visibility = Visibility.Hidden;
        }

       Thread mythread1;
       Thread mythread2;
       bool isclose = false;
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {

            onlinejpg.ToolTip = MessageClass.PCNum;
            this.DataContext = record;
            hook.Hook_Clear();
            hook.Dispose();
            hook.Hook_Start(0);
            InitialTray();

            onlinejpg.ToolTip = MessageClass.PCNum;
            MessageClass.signid = OperateHidden.InsertSignRecord();//插入新记录
            SetConent();
            OperateHidden.UpdateScreen(false);//获取一次 截屏和进程

            mythread1 = new Thread(new ParameterizedThreadStart(ThreadTest1));
            mythread1.IsBackground = true;
            mythread1.Start();
            mythread2 = new Thread(new ParameterizedThreadStart(ThreadTest2));
            mythread2.IsBackground = true;
            mythread2.Start();
            GetNotice();
            
        }
        //private void SetRecord()
        //{
        //    record.isexcit = "-1";
        //    record.timespan = "0";
        //    record.connecttype = "网络已连通";
        //    record.brush = "Green";
        //}
        public DataTable noticetable = new DataTable();
        private void GetNotice()
        {
            string cmdtxt = "select Notice_Id,Notice_Title,Notice_Sender, Notice_Time,Notice_Content  from t_notice  order by Notice_Id desc limit 0,5";
            noticetable = SqlHelper.ExecuteDataTable(cmdtxt);
            dataGrid1.ItemsSource = noticetable.DefaultView;

        }
        OperateHidden opera = new OperateHidden();
        int chose = -1;
        private void ThreadTest1(object message)
        {
            
            //条件满足时，一直执行    
            while (!isclose)
            {
                try
                {
                    if (SqlHelper.OpenConnection())
                    {
                        record.isexcit = "-1";
                        MessageClass.sqlconnect = true;
                        OperateHidden.UpdateSignOutTime(Convert.ToInt32(MessageClass.signid));//更新时间
                        double tipmespan = (Convert.ToDateTime(MessageClass.NowTime) - Convert.ToDateTime(MessageClass.SignTime)).TotalMinutes;
                        record.timespan = "本次登录时长" + Math.Round(tipmespan, 2) + " min";
                        chose=opera.CheckOrder();
                        CheckOrder(chose);
                        CheckHasNew();
                        if (OperateHidden.CheckHasExit())
                        {
                            SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_NowState=1 where PCM_Num='" + MessageClass.PCNum + "'");
                            record.isexcit = "0";

                        }
                        else
                        {
                            record.isexcit = "-1";
                            record.brush = Brushes.Green + "";
                            record.connecttype = "网络已连通";
                        }
                    }
                    else
                    {
                        MessageClass.sqlconnect = false;
                        record.brush = Brushes.Gray + "";
                        record.connecttype = "网络未连通";

                    }
                }
                catch { }
           

                Thread.Sleep(3000);
            }

        }
        private void CheckOrder(int chose)
        {
            switch(chose)
            {
                case 1: record.isexcit = "lock"; break;
                case 2: record.isexcit = "closelock"; break;
                case 3: record.isexcit = "shutdumn"; break;
                case 4: record.isexcit = "teacher"; break;
                case 5: record.isexcit = "closeteacher"; break;
                default:break;
            }
        }
        private static LockScreen lockform = new LockScreen();
        private static TeacherScreen teacherscreen = new TeacherScreen();
        private static ShutMessage shutwin = new ShutMessage();
        private void ThreadTest2(object message)
        {

            //条件满足时，一直执行    
            while (!isclose)
            {

                OperateHidden.Monitor_SMON();
                OperateHidden.UpdateScreen(false);
                Thread.Sleep(300000);
            }

        }
        public void CheckHasNew()
        {
            string i = SqlHelper.ExecuteDataTable("select User_HasNew from t_user where User_Num=@UserNum", new MySqlParameter("UserNum", MessageClass.UserNum)).Rows[0][0].ToString();
            if (i == "0")
            { }
            else
            {
                record.isexcit = "newnotice";
            }
        }
        private void SetConent()
        {
           
            label_usenum.Content = MessageClass.UserNum;
            label_username.Content = MessageClass.UserName;
            label_course.Content = MessageClass.Course;
           

        }

        private void Window_Closing(object sender, System.ComponentModel.CancelEventArgs e)
        {
            if (!MessageClass.canclose)
            {
                this.Visibility = Visibility.Hidden;
                e.Cancel = true;//使软件无法关闭
            }
            else
            {
                System.Windows.Application.Current.Shutdown();
            }
        }

        private void Window_KeyDown(object sender, System.Windows.Input.KeyEventArgs e)//防止alt+f4关闭
        {
            if(e.KeyStates == Keyboard.GetKeyStates(Key.F4) && Keyboard.Modifiers == ModifierKeys.Alt)
            {
               
                e.Handled = true;
            }
        }
   
        #region 设置系统托盘
        /// <summary>
        /// 设置系统托盘
        /// </summary>
        private System.Windows.Forms.NotifyIcon notifyIcon = null;
        private void InitialTray()
        {
            //设置托盘的各个属性
            notifyIcon = new System.Windows.Forms.NotifyIcon();
            notifyIcon.BalloonTipText = "在线服务...";
            notifyIcon.Icon = new System.Drawing.Icon(System.Windows.Forms.Application.StartupPath + "/Icon/online.ico");
            notifyIcon.Text = "机房在线";
            notifyIcon.Visible = true;
            notifyIcon.MouseClick += new System.Windows.Forms.MouseEventHandler(notifyIcon_MouseClick);

            System.Windows.Forms.MenuItem main = new System.Windows.Forms.MenuItem("显示主界面");
            main.Click += main_Click;
            System.Windows.Forms.MenuItem notice = new System.Windows.Forms.MenuItem("广而告之");
            notice.Click += new EventHandler(notice_Click);
            System.Windows.Forms.MenuItem record = new System.Windows.Forms.MenuItem("我的使用记录");
            record.Click += new EventHandler(record_Click);
            System.Windows.Forms.MenuItem download = new System.Windows.Forms.MenuItem("下载课程课件");
            download.Click += new EventHandler(download_Click);
            System.Windows.Forms.MenuItem order = new System.Windows.Forms.MenuItem("查看机房排课");
            order.Click += new EventHandler(order_Click);
            System.Windows.Forms.MenuItem softdev = new System.Windows.Forms.MenuItem("软件研发中心论坛");
            softdev.Click += new EventHandler(softdev_Click);
            System.Windows.Forms.MenuItem leader = new System.Windows.Forms.MenuItem("软件基地网址导航");
            leader.Click += new EventHandler(leader_Click);
            System.Windows.Forms.MenuItem signout = new System.Windows.Forms.MenuItem("注销");
            signout.Click += new EventHandler(signout_Click);
            System.Windows.Forms.MenuItem shutpower = new System.Windows.Forms.MenuItem("关机");
            shutpower.Click += new EventHandler(shutpower_Click);
            //关联托盘控件
            System.Windows.Forms.MenuItem[] childen = new System.Windows.Forms.MenuItem[] { main, notice, record, download, order,leader, signout, shutpower };
            notifyIcon.ContextMenu = new System.Windows.Forms.ContextMenu(childen);

            //窗体状态改变时候触发
            this.StateChanged += new EventHandler(SysTray_StateChanged);
        }
        void main_Click(object sender, EventArgs e)
        {
            this.Visibility = Visibility.Visible;
            this.WindowState = WindowState.Normal;
        }
        private void notice_Click(object sender, EventArgs e)
        {
            FindWeb(0);
        }
        private void record_Click(object sender, EventArgs e)
        {
            FindWeb(1);
        }
        private void download_Click(object sender, EventArgs e)
        {
            FindWeb(2);
        }
        private void order_Click(object sender, EventArgs e)
        {
            FindWeb(3);
        }
        private void softdev_Click(object sender, EventArgs e)
        {
            FindWeb(5);
        }
        private void leader_Click(object sender, EventArgs e)
        {
            FindWeb(6);
        }
        private void signout_Click(object sender, EventArgs e)
        {
            //注销
            MessageClass.canclose = true;
            this.Close();
        }
        private void shutpower_Click(object sender, EventArgs e)
        {
            //关机
            shutwin.Show();
        }
        private void FindWeb(int i)
        {
            try { 
         
            string httpurl = "";
         
                switch (i)
                {
                    case 0: httpurl = "http://59.72.194.42:81/Notice.aspx"; break;
                    case 1: httpurl = "http://59.72.194.42:81/Record.aspx"; break;
                    case 2: httpurl = "http://59.72.194.42:81/Download.aspx"; break;
                    case 3: httpurl = "http://59.72.194.42:81/RoomOrder.aspx"; break;
                    case 5: httpurl = "http://59.72.212.6/luntan/portal.php"; break;
                    case 6: httpurl = "http://59.72.194.42:81/"; break;
                    default: break;
                }
                System.Diagnostics.Process.Start(httpurl);
            
            }
            catch { }
        }
        /// <summary>
        /// 鼠标单击
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void notifyIcon_MouseClick(object sender, System.Windows.Forms.MouseEventArgs e)
        {
            //如果鼠标左键单击
            if (e.Button == MouseButtons.Left)
            {
                if (this.Visibility == Visibility.Visible)
                {
                    this.Visibility = Visibility.Hidden;
                }
                else
                {
                    this.Visibility = Visibility.Visible;
                    this.Activate();
                }
            }
        }

        /// <summary>
        /// 窗体状态改变时候触发
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void SysTray_StateChanged(object sender, EventArgs e)
        {
            if (this.WindowState == WindowState.Minimized)
            {
                this.Visibility = Visibility.Hidden;
            }
        }

        #endregion

        private void btresatart_Click(object sender, RoutedEventArgs e)
        {
            SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_NowState=1 where PCM_Num='" + MessageClass.PCNum + "'");
            SqlHelper.ExecuteNonQuery("update t_signrecord set Record_HasExit=1 where Record_Id=" + MessageClass.recordid);
            MessageClass.canclose = true;
            this.Close();
        }



        private void btshutpower_Click(object sender, RoutedEventArgs e)
        {
            MessageClass.canclose = true;
            this.Close();
            
        }
        
        private void txt_order_TextChanged(object sender, TextChangedEventArgs e)
        {
            switch(record.isexcit)
            {
                case "0": MessageClass.canclose = true;
                    this.Close(); break;
                case "newnotice":
                    {
                        Notice notice = new Notice();
                        SqlHelper.ExecuteNonQuery("update t_user set User_HasNew='0' where User_Num =@UserNum", new MySqlParameter("UserNum", MessageClass.UserNum));
                        notice.Show();
                         break;
                    }
                case "lock": //lockform.Topmost = true;
                    lockform.Show(); break;
                case "closelock": 
                        lockform.Topmost = false;
                        LockScreen.BlockInput(false);
                        lockform.Visibility = Visibility.Collapsed;
                    break;
                case "shutdumn":
                    
                    shutwin.Show();
                    break;
                case "teacher": teacherscreen.Show(); break;
                case "closeteacher": if (teacherscreen.IsActive)
                        teacherscreen.Visibility = Visibility.Collapsed; break;
                default: break;

            }
             
        }

        private void btn_record_Click(object sender, RoutedEventArgs e)
        {
            FindWeb(1);
        }

        private void btn_download_Click(object sender, RoutedEventArgs e)
        {
            FindWeb(2);
        }

        private void btn_roomorder_Click(object sender, RoutedEventArgs e)
        {
            FindWeb(3);
        }

        private void btn_softdev_Click(object sender, RoutedEventArgs e)
        {
            FindWeb(5);
        }

        private void btn_lader_Click(object sender, RoutedEventArgs e)
        {
            FindWeb(6);
        }

        private void bt_notice_Click(object sender, RoutedEventArgs e)
        {
            FindWeb(0);
        }

        private void dataGrid1_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            Notice noticwind = new Notice(true, noticetable.Rows[dataGrid1.SelectedIndex]["Notice_Title"].ToString(), noticetable.Rows[dataGrid1.SelectedIndex]["Notice_Content"].ToString(), noticetable.Rows[dataGrid1.SelectedIndex]["Notice_Time"].ToString());
            noticwind.Show();
        }

        private void btmin_Click(object sender, RoutedEventArgs e)
        {
            this.Visibility = Visibility.Collapsed;
        }


       

    }
    class Record : INotifyPropertyChanged
    {
        public event PropertyChangedEventHandler PropertyChanged;
        private string _timespan;
        public string timespan
        {
            get
            {
                return _timespan;
            }
            set
            {
                if (_timespan != value)
                {
                    _timespan = value;
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("timespan"));
                }
            }
        }
        private string _isexcit;
        public string isexcit
        {

            get
            {
                return _isexcit;
            }
            set
            {
                if (_isexcit != value)
                {
                    _isexcit = value;
                    try
                    {
                        PropertyChanged.Invoke(this, new PropertyChangedEventArgs("isexcit"));
                    }
                    catch { }
                }
            }
        }
        private string _connecttype;
        public string connecttype
        {
            get
            {
                return _connecttype;
            }
            set
            {
                if (_connecttype != value)
                {
                    _connecttype = value;
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("connecttype"));
                }
            }
        }
        private string _brush;
        public string brush
        {
            get
            {
                return _brush;
            }
            set
            {
                if (_brush != value)
                {
                    _brush = value;
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("brush"));
                }
            }
        }
       
    }
}
