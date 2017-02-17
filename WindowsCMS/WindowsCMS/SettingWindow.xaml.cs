using CRUDTest1;
using MySql.Data.MySqlClient;
using WindowsCMS.ClassFile;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Management;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;

namespace WindowsCMS
{
    /// <summary>
    /// SettingWindow.xaml 的交互逻辑
    /// </summary>
    public partial class SettingWindow : Window
    {
        public SettingWindow()//insert
        {
            InitializeComponent();
            SearchAll();
            this.WindowStyle = WindowStyle.None;
            sqltxt = "insert into t_pcmessage(PCM_Num,PCM_RoomName,PCM_Mac,PCM_NowState,PCM_GetNewOpera) values(@PCM_Num,@PCM_RoomName,@PCM_Mac,@PCM_NowState,-1)";
        }
        public SettingWindow(string update)//update
        {
            InitializeComponent();
            SearchAll();
            this.WindowStyle = WindowStyle.ToolWindow;
            sqltxt = "update t_pcmessage set PCM_Num=@PCM_Num,PCM_RoomName=@PCM_RoomName,PCM_NowState=@PCM_NowState where PCM_Mac=@PCM_Mac";
        }
        string sqltxt = "";
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            txtbox_account.Focus();
            
            this.Title = "绑定机号与机房名——管理员登录";
        }
       
       private void SearchAll()
        {

            txtbox_roomname.ToolTip = "请按照以下格式输入，如：C305";
            txtbox_pcnum.ToolTip = "请按照以下格式输入，如：C305_1-1";
          
        }
        private void Sign()//登录
        {
            string account = txtbox_account.Text.Trim();
            string pass = txtbox_pass.Password.Trim();
            if (account.Length <= 0)
            {
                txtbox_account.Focus();
                return ;
            }
            if(pass.Length<=0)
            {
                txtbox_pass.Focus();
                return ;
            }

            if (CheckAccountWithPSD(account, pass))
            {
                this.Title = "绑定机号与机房名——绑定";
                LogPanel.Visibility = Visibility.Collapsed;
                SettingPanel.Visibility = Visibility.Visible;
                SetMacMessage();
                return;
            }
            else
            {
                txtbox_account.Text = "账户或密码错误！";
                txtbox_pass.Password = "";
            }
           
        }
        private bool CheckAccountWithPSD(string account,string password)//数据库中查看管理员用户名和密码是否正确
        {
            string seletxt = "select Mana_Type,Mana_Name from t_manager where Mana_Num= @txtaccount and Mana_PSD=MD5(@txtpsd)";
            DataTable result = SqlHelper.ExecuteDataTable(seletxt, new MySqlParameter[] {
                new MySqlParameter("@txtaccount", account), new MySqlParameter("@txtpsd", password) });
            if(result.Rows.Count<=0)
            return false;
            else
            {
                return true;
            }
        }
        private void SetMacMessage()//获取数据库中本机的信息并显示出来,MessageClass类中存储了这些信息
        {
            txtbox_roomname.Text = MessageClass.RoomName;
            txtbox_pcnum.Text = MessageClass.PCNum;
            txtmac.Content = MessageClass.MacAddress;
        }


        private void txtbox_account_KeyDown(object sender, KeyEventArgs e)
        {
            if(e.Key==Key.Enter)
            {
                Sign();
            }
        }

        private void txtbox_pass_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Enter)
            {
                Sign();
            }
        }
        private bool IsthePCNUmExis(string pcunm,string pcmac)
        {
            int count = Convert.ToInt32(SqlHelper.ExecuteScalar("select count(PCM_Num) from t_pcmessage where PCM_Num=@PCM_Num and PCM_Mac !=@PCM_Mac", new MySqlParameter("@PCM_Num", pcunm), new MySqlParameter("@PCM_Mac", pcmac)));
            if (count > 0)
                return true;
            else return false;
        }

        private void bt_setting_Click(object sender, RoutedEventArgs e)
        {
            // 向数据库中根据MAC地址更新信息
            if (txtbox_roomname.Text.Trim() != "" && txtbox_pcnum.Text.Trim() != "" && txtmac.Content.ToString() != "")
            {
                if (txtbox_roomname.Text.Trim() != MessageClass.RoomName || txtbox_pcnum.Text.Trim() != MessageClass.PCNum)
                {
                    string[] pcnumsplit = txtbox_pcnum.Text.Trim().Split('_');
                    if (pcnumsplit.Length <= 1)
                    {
                        MessageBox.Show("机器编号格式不正确，请按指定格式输入，如：C305_1-1","格式错误");
                        return;
                    }
                    string[] pcnumsplits=pcnumsplit[1].Split('-');
                    if (pcnumsplits.Length <= 1 || pcnumsplits[1]=="")
                    {
                        MessageBox.Show("机器编号格式不正确，请按指定格式输入，如：C305_1-1", "格式错误");
                        return;
                    }
                        
                    if (IsthePCNUmExis(txtbox_pcnum.Text.Trim(), MessageClass.MacAddress))
                    {
                        if (MessageBox.Show("机号" + txtbox_pcnum.Text.Trim() + "已绑定,是否重新绑定？", "提示", MessageBoxButton.YesNo) == MessageBoxResult.Yes)
                        {
                            SqlHelper.ExecuteNonQuery("delete  from t_pcmessage where PCM_Mac=@PCM_Mac", new MySqlParameter("@PCM_Mac", MessageClass.MacAddress));
                            MessageClass.RoomName = txtbox_roomname.Text.Trim();
                            MessageClass.PCNum = txtbox_pcnum.Text.Trim();
                            sqltxt = "update t_pcmessage set PCM_Mac=@PCM_Mac,PCM_RoomName=@PCM_RoomName,PCM_NowState=@PCM_NowState where PCM_Num=@PCM_Num";
                            SqlHelper.ExecuteNonQuery(sqltxt, new MySqlParameter("@PCM_Num", MessageClass.PCNum),
                             new MySqlParameter("@PCM_RoomName", MessageClass.RoomName), new MySqlParameter("@PCM_Mac", MessageClass.MacAddress)
                             , new MySqlParameter("@PCM_NowState", 1));

                            this.Close();

                        }
                        else return;
                    }
                    else
                    {
                        MessageClass.RoomName = txtbox_roomname.Text.Trim();
                        MessageClass.PCNum = txtbox_pcnum.Text.Trim();
                        SqlHelper.ExecuteNonQuery(sqltxt, new MySqlParameter("@PCM_Num", MessageClass.PCNum),
                    new MySqlParameter("@PCM_RoomName", MessageClass.RoomName), new MySqlParameter("@PCM_Mac", MessageClass.MacAddress)
                    , new MySqlParameter("@PCM_NowState", 1));

                        this.Close();

                    }

                }
            }
            //sqltxt = "update T_PCMessage set PCM_Num=@PCM_Num,PCM_RoomName=@PCM_RoomName where PCM_Mac=@PCM_Mac";PCM_NowState
           
        }

        private void bt_sign_Click(object sender, RoutedEventArgs e)
        {
            Sign();
        }

        private void txtbox_account_GotFocus(object sender, RoutedEventArgs e)
        {
            if(txtbox_account.Text=="账户或密码错误！")
            {
                txtbox_account.Text = "";
            }
        }

        private void txtbox_roomname_TextChanged(object sender, TextChangedEventArgs e)
        {
            txtbox_pcnum.Text = txtbox_roomname.Text + "_";
        }

      

        private void txtbox_pcnum_KeyUp(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Enter)
                bt_setting_Click(sender, e);
            else
            {
                txtbox_pcnum.Text = txtbox_pcnum.Text.ToString().ToUpper();
                txtbox_pcnum.Select(txtbox_pcnum.Text.Length, 0);
            }
        }

        private void txtbox_roomname_KeyUp(object sender, KeyEventArgs e)
        {
            txtbox_roomname.Text = txtbox_roomname.Text.ToString().ToUpper();
            txtbox_roomname.Select(txtbox_roomname.Text.Length, 0);
        }
    }
}
