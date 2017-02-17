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
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using Microsoft.Win32;
namespace WindowsCMS
{
    /// <summary>
    /// TeacherScreen.xaml 的交互逻辑
    /// </summary>
    public partial class TeacherScreen : Window
    {
        public TeacherScreen()
        {
            InitializeComponent();
        }
      private static  bool canclose = false;
        public static void ChangeClose()
        {
            canclose = true;
        }
        private void Button_Click(object sender, RoutedEventArgs e)
        {
            this.WindowState = WindowState.Minimized;
        }

        private void Window_Closing(object sender, System.ComponentModel.CancelEventArgs e)
        {
            if (!canclose)
                e.Cancel = true;
            else
            {
                hook.Hook_Clear();
                hook.Dispose();
            }
        }
        Hook hook = new Hook();
        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            hook.Hook_Start();
        }

        private void Window_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            this.DragMove();
        }
      
    }
}
