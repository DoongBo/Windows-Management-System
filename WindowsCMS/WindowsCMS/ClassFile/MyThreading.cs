using CRUDTest1;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows;

namespace WindowsCMS.ClassFile
{
    class MyThreading
    {
        Thread myThread;
        public bool boolRun = true;

        public MyThreading()
        {

            //实例化子线程
            myThread = new Thread(new ParameterizedThreadStart(ThreadTest));
            //启动子线程
            myThread.IsBackground = true;
            myThread.Start();

        }
        private void ThreadTest(object message)
        {

            //条件满足时，一直执行    
            while (boolRun)
            {
                if (!SqlHelper.OpenConnection())
                {
                    MessageClass.sqlconnect = false;
                   
                }
                else
                {
                    MessageClass.sqlconnect = true; ;

                }
                //子线程休眠5s，与timer的定时触发功能类似
                Thread.Sleep(100);
            }

        }

    }
}
