using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Configuration;
using System.Data.SqlClient;
using System.Data;
using System.Windows;
using MySql.Data.MySqlClient;
namespace CRUDTest1
{
    public static class SqlHelper
 
    {
        public static readonly string connstr = "server=59.72.212.7;uid=root;password=ruanjianyanfazhongxin;Database=DB_PCM;Charset=utf8;Connect Timeout =3;";
        public static bool  OpenConnection()
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connstr))
                {
                    conn.Open();
                    return true;
                }
            }
            catch
            {
                return false;
            }
        }

        public static int ExecuteNonQuery(string cmdText,
            params MySqlParameter[] parameters)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connstr))
                {
                    conn.Open();
                    return ExecuteNonQuery(conn, cmdText, parameters);
                }
            }
            catch
            {
                return 0;
            }
        }

        public static object ExecuteScalar(string cmdText,
            params MySqlParameter[] parameters)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connstr))
                {
                    conn.Open();
                    return ExecuteScalar(conn, cmdText, parameters);
                }
            }
            catch
            {
                
                return 0;
            }
        }

        public static DataTable ExecuteDataTable(string cmdText,
            params MySqlParameter[] parameters)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connstr))
                {
                    conn.Open();
                    return ExecuteDataTable(conn, cmdText, parameters);
                }
            }catch(Exception e)
            {
                MessageBox.Show(e.Message);
                return null;
            }
        }

        public static DataTable SqlExecuteDataTable(string cmdText,
            params SqlParameter[] parameters)
        {
            try
            {
                using (SqlConnection conn = new SqlConnection("Server=59.72.194.42;uid=sqlManager;password=rjyfzx11.;database=Db_Sign;timeout =10;"))
                {
                    conn.Open();
                    return SqlExecuteDataTable(conn, cmdText, parameters);
                }
            }
            catch (Exception e)
            {
                MessageBox.Show(e.Message);
                return null;
            }
        }

        public static int ExecuteNonQuery(MySqlConnection conn, string cmdText,
           params MySqlParameter[] parameters)
        {
            using (MySqlCommand  cmd = conn.CreateCommand())
            {
                cmd.CommandText = cmdText;
                cmd.Parameters.AddRange(parameters);
                return cmd.ExecuteNonQuery();
            }
        }

        public static object ExecuteScalar(MySqlConnection conn, string cmdText,
            params MySqlParameter[] parameters)
        {
            using (MySqlCommand  cmd = conn.CreateCommand())
            {
                cmd.CommandText = cmdText;
                cmd.Parameters.AddRange(parameters);
                return cmd.ExecuteScalar();
            }
        }

        public static DataTable ExecuteDataTable(MySqlConnection conn, string cmdText,
            params MySqlParameter[] parameters)
        {
            using (MySqlCommand  cmd = conn.CreateCommand())
            {
                cmd.CommandText = cmdText;
                cmd.Parameters.AddRange(parameters);
                using (MySqlDataAdapter adapter = new MySqlDataAdapter(cmd))
                {
                    DataTable dt = new DataTable();
                    adapter.Fill(dt);
                    return dt;
                }
            }
        }
        public static DataTable SqlExecuteDataTable(SqlConnection conn, string cmdText,
            params SqlParameter[] parameters)
        {
            using (SqlCommand cmd = conn.CreateCommand())
            {
                cmd.CommandText = cmdText;
                cmd.Parameters.AddRange(parameters);
                using (SqlDataAdapter adapter = new SqlDataAdapter(cmd))
                {
                    DataTable dt = new DataTable();
                    adapter.Fill(dt);
                    return dt;
                }
            }
        }

        public static object ToDBValue(this object value)
        {
            return value == null ? DBNull.Value : value;
        }

        public static object FromDBValue(this object dbValue)
        {
            return dbValue == DBNull.Value ? null : dbValue;
        }
    }
}
