using CRUDTest1;
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
    /// CourseChose.xaml 的交互逻辑
    /// </summary>
    public partial class CourseChose : Window
    {
        public CourseChose()
        {
            InitializeComponent();
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            int command = datagrid.SelectedIndex;
            MessageClass.Course = table.Rows[command]["Course_Name"].ToString();
            this.Close();
        }
        DataTable table = new DataTable();
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            this.datagrid.LoadingRow += new EventHandler<DataGridRowEventArgs>(this.datagrid_loadingrow);
             table = SqlHelper.ExecuteDataTable("select Course_Name,Course_Teacher,Course_Content from t_course where Course_Term IN (select Term_Name from t_term where datediff(Term_StartDate,now())<=0 and datediff(Term_EndDate,now())>=0)");
            datagrid.ItemsSource = table.DefaultView;
            
        }
        private void datagrid_loadingrow(object sender, DataGridRowEventArgs e)
        {
            e.Row.Header = e.Row.GetIndex() + 1;
        }
    }

}
