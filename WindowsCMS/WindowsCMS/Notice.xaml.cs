using CRUDTest1;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
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
using System.Windows.Shapes;
using WindowsCMS.ClassFile;

namespace WindowsCMS
{
    /// <summary>
    /// Notice.xaml 的交互逻辑
    /// </summary>
    public partial class Notice : Window
    {
        bool center = false;
        string titletxt, contenttxt, timetxt;
        public Notice()
        {
            InitializeComponent();
        }
        public Notice(bool boo,string title,string content,string time)
        {
            center = boo;
            this.titletxt=title;
            this.contenttxt = content;
            this.timetxt = time;
            InitializeComponent();
        }
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            string selectnotice="";
            if(center)
            {
                this.WindowStartupLocation = WindowStartupLocation.CenterScreen;
                title.Content = titletxt;
                content.Text = contenttxt;
                time.Content = timetxt;
            }
            else
            {
                this.Left = System.Windows.SystemParameters.PrimaryScreenWidth - 402;
                this.Top = System.Windows.SystemParameters.PrimaryScreenHeight - 240;
                selectnotice = "select Notice_Content,Notice_Title,Notice_Sender,Notice_Time from t_notice order by Notice_Id desc limit 0,1";
                DataTable notictable = SqlHelper.ExecuteDataTable(selectnotice);
                if (notictable != null)
                {
                    DataRow row = notictable.Rows[0];                    
                        title.Content = row["Notice_Title"].ToString();
                        content.Text = row["Notice_Content"].ToString();
                        time.Content = row["Notice_Sender"].ToString() + "\t@\t" + row["Notice_Time"].ToString();
                    
                }
            }
           
           
           
        }

        private void btn_cloase_Click(object sender, RoutedEventArgs e)
        {
           
            this.Close();
        }

        private void Window_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            this.DragMove();
        }
    }
}
