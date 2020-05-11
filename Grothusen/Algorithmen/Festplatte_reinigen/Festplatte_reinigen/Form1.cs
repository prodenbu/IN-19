using System;
using System.IO;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Festplatte_reinigen
{
    public partial class Form1 : Form
    {
        

        public Form1()
        {
            InitializeComponent();
            
        }

        private void button1_Click(object sender, EventArgs e)
        {
            
            folderBrowserDialog2.ShowDialog();


            treeView1.Nodes.Add(dirfind(new DirectoryInfo(folderBrowserDialog2.SelectedPath)));
        }

        private void button2_Click(object sender, EventArgs e)
        {
            
            //DirectoryInfo di = new DirectoryInfo(Pfad);
            //foreach (FileInfo file in di.GetFiles())
            //{
                
            //    treeView1.Nodes.Add(file.Name);   
            //};
        }

        private TreeNode dirfind(DirectoryInfo di)
        {
            //DirectoryInfo di = new DirectoryInfo(directoryInfo.FullName);
            TreeNode baum = new TreeNode(di.Name);
            foreach (DirectoryInfo dir in di.GetDirectories())
            {
                
                
                baum.Nodes.Add(dirfind(dir));
            }
            foreach(FileInfo file in di.GetFiles())
            {
                baum.Nodes.Add(file.Name);
            }
            return baum;
        }
    }
}
