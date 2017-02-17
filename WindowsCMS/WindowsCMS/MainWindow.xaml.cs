using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using Microsoft.Win32;
using System.Diagnostics;
using System.Runtime.InteropServices;
using WindowsCMS.ClassFile;
using System.Data;
using CRUDTest1;
using MySql.Data.MySqlClient;
using System.Windows.Threading;
using System.Reflection;
using System.Threading;
using System.ComponentModel;
using System.Data.SqlClient; 

namespace WindowsCMS
{
    /// <summary>
    /// MainWindow.xaml 的交互逻辑
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
            CheckIsOpen();
        }
        RegistryKey key = Registry.LocalMachine.OpenSubKey("SOFTWARE//Microsoft//Windows//CurrentVersion//Run", true);
        Hook hook = new Hook();
        bool isclosed = false;
        private void ThreadTest(object message)
        {

            //条件满足时，一直执行    
            while (!isclosed)
            {
                if (!SqlHelper.OpenConnection())
                {
                    MessageClass.sqlconnect = false;
                    recorde.connecttype = "网络未连通";
                    recorde.forcolor = "Red";
                    recorde.visible = "Collapsed";
                    recorde.time = "本地时间：";
                    recorde.webtime = (DateTime.Now + timediff).ToString();
                }
                else
                {
                    if(!MessageClass.sqlconnect)
                    {
                        MessageClass.sqlconnect = true;
                        MessageClass.CheckMacFromSql();
                    }
                    SetContent();
                }
                Thread.Sleep(1000);
            }

        }
        static record recorde = new record();
         private void SetContent()
        {
            recorde.forcolor = "Green";
            recorde.visible = "Visible";
            recorde.time = "网络时间：";
            recorde.connecttype = "网络已连通";
            recorde.pcnum = MessageClass.PCNum.Replace("_","__");
            recorde.roomame = MessageClass.RoomName;
            recorde.webtime = (DateTime.Now + timediff).ToString();
            
        }
        TimeSpan timediff = TimeSpan.Zero;
       
        Thread mythread ;
        private void BindComBox()
        {
            txtbox_course.Items.Add("课内实验");
            txtbox_course.Items.Add("课外实习");
            txtbox_course.Items.Add("基地培训");
            txtbox_course.SelectedIndex = -1;
        }
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            this.DataContext = recorde;
            BindComBox();
            MessageClass.canclose = false;

            //撤销Windows热键，防止alt+F4关闭软件       
             hook.Hook_Clear();
             hook.Dispose();
            hook.Hook_Start();
            this.Topmost = true;
          

            if (!SqlHelper.OpenConnection())
            {
                MessageClass.sqlconnect = false;
            }
            else
            {
                MessageClass.sqlconnect = true; ;
                
                DateTime webtime = Convert.ToDateTime(SqlHelper.ExecuteScalar("select now()").ToString());
                timediff = webtime - DateTime.Now;
                if (!MessageClass.CheckMacFromSql())//若数据库中没有本台电脑的MAC地址记录
                {
                    SettingWindow win = new SettingWindow();
                    if (win.ShowDialog() != null)
                    {

                    }
                }
                SqlHelper.ExecuteNonQuery("update t_pcmessage set PCM_NowState=1 where PCM_Num='" + MessageClass.PCNum + "'");
                
            }
            mythread = new Thread(new ParameterizedThreadStart(ThreadTest));
            mythread.IsBackground = true;
            mythread.Start();
        }

        private void CheckIsOpen()//如果已经打开了一个本程序，则不再打开
        {
            try
            {

            int count = 0;
            Process[] ps = Process.GetProcesses();//获取计算机上所有进程
            foreach (Process p in ps)
            {
                if (p.MainWindowTitle == "机房计算机管理系统" || p.ProcessName == "WindowsCMS")
                {
                    count++;
                    if (count > 1)
                    {
                        
                        this.Close();
                        break;
                    }
                }
                //(p.ProcessName + "/" + p.MainWindowTitle + "/" + p.StartTime);
            }

            }
            catch { }
        }
        #region
        //private void timer_Tick(object sender, EventArgs e)
        //{
        //    if(!SqlHelper.OpenConnection())
        //    {
        //        connactype = false;
        //        return;
        //    }
        //    else
        //    {
                
        //        SetTextConten();
        //        connactype = true;
        //        bt_setting.Visibility = Visibility.Visible;
        //        return;
        //    }
           

        //}
        //private string _connecttype;
        //public string connecttype
        //{
        //    get { 
        //        return _connecttype;  
        //    }
        //    set
        //    {
        //         if (_connecttype != value)  
        //         {  
        //             _connecttype = value;  
        //             OnPropertyChanged("connecttype");  
        //         }
        //    }
        //}
        //private string _pcnum;
        //public string pcnum
        //{
        //    get
        //    {
        //        return _pcnum;
        //    }
        //    set
        //    {
        //        if (_pcnum != value)
        //        {
        //            _pcnum = value;
        //            OnPropertyChanged("pcnum");
        //        }
        //    }
        //}
        //private string _roomname;
        //public string roomname
        //{
        //    get
        //    {
        //        return _roomname;
        //    }
        //    set
        //    {
        //        if (_roomname != value)
        //        {
        //            _roomname = value;
        //            OnPropertyChanged("roomname");
        //        }
        //    }
        //}
        //private string _nowtime;
        //public string nowtime
        //{
        //    get
        //    {
        //        return _nowtime;
        //    }
        //    set
        //    {
        //        if (_nowtime != value)
        //        {
        //            _nowtime = value;
        //            OnPropertyChanged("nowtime");
        //        }
        //    }
        //}
        //public event PropertyChangedEventHandler PropertyChanged;  
        //public virtual void OnPropertyChanged(string propertyName)
        //{
        //    if (PropertyChanged != null)
        //    {
        //        PropertyChanged(this, new PropertyChangedEventArgs(propertyName));
        //    }
        //} 


        #endregion


        private void txtbox_account_KeyDown(object sender, KeyEventArgs e)
        {
            if(e.Key==Key.Enter)
            {
                Sign();
            }
        }

        private void txtbox_pasd_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Enter)
            {
                Sign();
            }
        }

        private void bt_sign_Click(object sender, RoutedEventArgs e)
        {
            if(txtbox_account.Text.Trim()!="学生学号")
            Sign();
        }
        private void Sign()
        {
            
            string accountnum = txtbox_account.Text.Trim();
            string password = txtbox_pasd.Password.Trim();
            if (txtbox_course.SelectedIndex < 0)
                return;
            if (accountnum == "" || password == "" )
                return;
            else
            {
                if (CheckAccount(accountnum, password))
                {
                    hook.Hook_Clear();
                    hook.Dispose();
                    
                    this.Visibility = Visibility.Collapsed;
                    PCMOnline onlinewin = new PCMOnline();
                    onlinewin.Show();
                    this.Close();
                }
                else
                {
                    txtbox_meaasge.Content = "账户名或密码错误！";
                    txtbox_meaasge.Foreground = Brushes.Red;
                }
                
            }
        }
        private bool CheckAccount(string accountnum,string password)
        {
            if (!SqlHelper.OpenConnection())
            {
                if (accountnum == "666666" && password == "666666")
                {
                    this.Close();
                    return true;
                }
                else return false;
            }
            else
            {
            string selectxt = "select User_Num,User_Name from t_user where User_Num=@User_Num and User_PSD=MD5(@User_PSD)";
            DataTable selecttable = SqlHelper.ExecuteDataTable(selectxt, new MySqlParameter[] { new MySqlParameter("@User_Num",accountnum), 
                new MySqlParameter("@User_PSD",password)});
            if(selecttable.Rows.Count>0)
            {
                MessageClass.UserName = selecttable.Rows[0]["User_Name"].ToString();
                MessageClass.UserNum = selecttable.Rows[0]["User_Num"].ToString();
                MessageClass.Course = txtbox_course.SelectedValue.ToString();
                //为MessageClass赋值
                return true; 
            }
            else
            {
                selectxt = "select User_Num,User_Name from T_User where User_Num=@User_Num";
                selecttable = SqlHelper.SqlExecuteDataTable(selectxt, new SqlParameter[] { new SqlParameter("@User_Num",accountnum)});
                if (selecttable.Rows.Count > 0)
               {
                    MessageClass.UserName = selecttable.Rows[0]["User_Name"].ToString();
                    MessageClass.UserNum = selecttable.Rows[0]["User_Num"].ToString();
                    MessageClass.Course = txtbox_course.SelectedValue.ToString();
                     //为MessageClass赋值
                    return true; 
               }
                else return false;
            }
               
              
            }
        }


        private void bt_shutdown_MouseLeftButtonUp(object sender, MouseButtonEventArgs e)
        {
            ShutMessage shutwin = new ShutMessage();
            shutwin.ShowDialog();
        }

        private void bt_setting_MouseLeftButtonUp(object sender, MouseButtonEventArgs e)
        {
            SettingWindow setwin = new SettingWindow("pudate");
            setwin.ShowDialog();
        }

        private void txtbox_account_GotFocus(object sender, RoutedEventArgs e)
        {
            if (txtbox_account.Text.Trim() == "学生学号")
            {
                txtbox_account.Text = "";
                txtbox_account.Foreground = Brushes.White;
            }
            txtbox_meaasge.Content = "初始密码为 000000";
            txtbox_meaasge.Foreground = Brushes.Gray;
            txtbox_account.SelectAll();
        }

        private void txtbox_pasd_GotFocus(object sender, RoutedEventArgs e)
        {
            if(txtbox_pasd.Password.Length<=0)
                tbl_paswar.Text = "";
            txtbox_meaasge.Content = "初始密码为 000000";
            txtbox_meaasge.Foreground = Brushes.Gray;
            txtbox_pasd.SelectAll();
        }

        private void Window_Closing(object sender, CancelEventArgs e)
        {
            hook.Hook_Clear();
            hook.Dispose();
            isclosed = true;
        }



        private void txtbox_ContChange_TextChanged(object sender, TextChangedEventArgs e)
        {
            if (MessageClass.sqlconnect)
            {
             
                if (MessageClass.PCNum == "")
                {
                    SettingWindow win = new SettingWindow();
                    win.ShowDialog();

                }
            }
        }

        private void gri_input_MouseEnter(object sender, MouseEventArgs e)
        {
            gri_foreground.Opacity = 0.5;
            gri_inputback.Visibility = Visibility.Visible;
        }

        private void lable_title_MouseEnter(object sender, MouseEventArgs e)
        {
            //gri_foreground.Opacity = 0.2;
            //gri_inputback.Visibility = Visibility.Collapsed;
        }

        private void txtbox_account_LostFocus(object sender, RoutedEventArgs e)
        {
            if (txtbox_account.Text.Trim().Length <= 0)
            {
                txtbox_account.Text = "学生学号";
                txtbox_account.Foreground = Brushes.LightGray;
            }
        }

        private void txtbox_pasd_LostFocus(object sender, RoutedEventArgs e)
        {
            if (txtbox_pasd.Password.Length <= 0)
                tbl_paswar.Text = "用户密码";
        }

        private void StackPanel_MouseEnter(object sender, MouseEventArgs e)
        {
            //gri_foreground.Opacity = 0.2;
            //gri_inputback.Visibility = Visibility.Collapsed;
        }

        private void Border_MouseMove(object sender, MouseEventArgs e)
        {
            gri_foreground.Opacity = 0.2;
            gri_inputback.Visibility = Visibility.Collapsed;
        }

        private void Border_MouseLeave(object sender, MouseEventArgs e)
        {
            gri_foreground.Opacity = 0.2;
            gri_inputback.Visibility = Visibility.Collapsed;
        }

        private void txtbox_course_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if(Convert.ToString(txtbox_course.SelectedValue)=="课内实验")
            {
               
                    CourseChose win = new CourseChose();
                    win.ShowDialog();
                    txtbox_course.Items.Add(MessageClass.Course);
                    txtbox_course.SelectedIndex = txtbox_course.Items.Count - 1;
                
            }
            txtbox_pasd.Focus();

        }

        private void txtbox_course_GotFocus(object sender, RoutedEventArgs e)
        {
            if (txtbox_course.IsDropDownOpen==false&&txtbox_course.SelectedIndex<=0)
            txtbox_course.IsDropDownOpen = true;
        }




        #region

        //private void btnShowOpen_Click(object sender, EventArgs e)
        //{
        //    OpenFileDialog open = new OpenFileDialog();
        //    open.Filter = "可执行文件(*.exe)|*.exe";
        //    if (open.ShowDialog() == DialogResult.OK)
        //    {
        //        txtPath.Text = open.FileName;
        //    }
        //}
        
        //private bool runWhenStart(bool started, string exeName, string path)
        //{
        //    RegistryKey key = Registry.LocalMachine.OpenSubKey("SOFTWARE//Microsoft//Windows//CurrentVersion//Run", true);//打开注册表子项
        //    if (key == null)//如果该项不存在的话，则创建该子项
        //    {
        //        key = Registry.LocalMachine.CreateSubKey("SOFTWARE//Microsoft//Windows//CurrentVersion//Run");
        //    }
        //    if (started == true)
        //    {
        //        try
        //        {
        //            key.SetValue(exeName, path);//设置为开机启动
        //            key.Close();
        //        }
        //        catch
        //        {
        //            return false;
        //        }
        //    }
        //    else
        //    {
        //        try
        //        {
        //            key.DeleteValue(exeName);//取消开机启动
        //            key.Close();
        //        }
        //        catch
        //        {
        //            return false;
        //        }
        //    }
        //    return true;
        //}
        //private void btnSet_Click(object sender, EventArgs e)
        //{
        //    if (txtPath.Text == "")//检查是否选择了文件
        //    {
        //        MessageBox.Show("请选择要随计算机一起启动的程序路径！", "消息");
        //        txtPath.Focus();
        //        return;
        //    }
        //    string path = txtPath.Text.Trim();
        //    string exeName = path.Substring(path.LastIndexOf("//") + 1);
        //    if (!File.Exists(path))//检查该文件是否存在
        //    {
        //        MessageBox.Show("文件不存在！", "消息");
        //        txtPath.Text = "";
        //        txtPath.Focus();
        //        return;
        //    }
        //    if (runWhenStart(true, exeName, path))
        //    {
        //        MessageBox.Show("设置成功！", "消息");
        //    }
        //    else
        //    {
        //        MessageBox.Show("设置失败！", "消息");
        //    }
        //}
        //private void btnCancel_Click(object sender, EventArgs e)
        //{
        //    if (txtPath.Text == "")//检查是否选择了文件
        //    {
        //        MessageBox.Show("请选择要撤销随计算机一起启动的程序路径！", "消息");
        //        return;
        //    }
        //    string path = txtPath.Text.Trim();
        //    string exeName = path.Substring(path.LastIndexOf("//") + 1);
        //    if (!File.Exists(path))//检查该文件是否存在
        //    {
        //        MessageBox.Show("文件不存在！", "消息");
        //        txtPath.Text = "";
        //        txtPath.Focus();
        //        return;
        //    }
        //    if (runWhenStart(false, exeName, path))
        //    {
        //        MessageBox.Show("撤销成功！", "消息");
        //    }
        //    else
        //    {
        //        MessageBox.Show("撤销失败！", "消息");
        //    }
        //}
        #endregion

    }
    class record : INotifyPropertyChanged
    {
        public event PropertyChangedEventHandler PropertyChanged;
      
        private string _pcnum;
        public string pcnum
        {
            get
            {
                return _pcnum;
            }
            set
            {
                if (_pcnum != value)
                {
                    _pcnum = value;
                    if(this.PropertyChanged!=null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("pcnum"));
                }
            }
        }
        private string _roomame;
        public string roomame
        {
            get
            {
                return _roomame;
            }
            set
            {
                if (_roomame != value)
                {
                    _roomame = value;
                    if (this.PropertyChanged != null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("roomame"));
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
                    if (this.PropertyChanged != null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("connecttype"));
                }
            }
        }
        private string _webtime;
        public string webtime
        {
            get
            {
                return _webtime;
            }
            set
            {
                if (_webtime != value)
                {
                    _webtime = value;
                    if (this.PropertyChanged != null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("webtime"));
                }
            }
        }
        private string _forcolor;
        public string forcolor
        {
            get
            {
                return _forcolor;
            }
            set
            {
                if (_forcolor != value)
                {
                    _forcolor = value;
                    if (this.PropertyChanged != null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("forcolor"));
                   
                }
            }
        }
        private string _time;
        public string time
        {
            get
            {
                return _time;
            }
            set
            {
                if (_time != value)
                {
                    _time = value;
                    if (this.PropertyChanged != null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("time"));
                }
            }
        }
        private string _visible;
        public string visible
        {
            get
            {
                return _visible;
            }
            set
            {
                if (_visible != value)
                {
                    _visible = value;
                    if (this.PropertyChanged != null)
                    PropertyChanged.Invoke(this, new PropertyChangedEventArgs("visible"));
                }
               
            }
        }
       
    }
}
