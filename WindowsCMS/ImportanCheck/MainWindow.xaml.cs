using Microsoft.Win32;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Timers;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace ImportanCheck
{
    /// <summary>
    /// MainWindow.xaml 的交互逻辑
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
            Start();

        }
        Timer timer = new Timer(1000);
        private void Start()
        {
            timer.Elapsed += new System.Timers.ElapsedEventHandler( Check); //到达时间的时候执行事件；   
            timer.AutoReset = true;   //设置是执行一次（false）还是一直执行(true)；   
            timer.Enabled = true;     //是否执行System.Timers.Timer.Elapsed事件；   
            timer.Start();
        }
        private void Check(object source, System.Timers.ElapsedEventArgs e)
        {
            try
            {

                Process[] ps = Process.GetProcessesByName("WindowsCMS");
                if (ps==null||ps.Length <= 0)
                {

                    string info = "";
                    RegistryKey Key;
                    Key = Registry.LocalMachine;//win8 win10
                    RegistryKey myreg = Key.OpenSubKey(@"SOFTWARE\Wow6432Node\Microsoft\Windows\CurrentVersion\Run");
                    if (myreg == null)
                    {
                        //win7
                        myreg = Key.OpenSubKey(@"SOFTWARE\Microsoft\Windows\CurrentVersion\Run");
                    }
                    info = myreg.GetValue("PCM").ToString();
                    System.Diagnostics.Process.Start(info);
                }
                else if (ps.Length>1)
                {
                    ps[1].Close();
                    
                }
            }catch(Exception ex){
               //
            }
        }
    }
}
