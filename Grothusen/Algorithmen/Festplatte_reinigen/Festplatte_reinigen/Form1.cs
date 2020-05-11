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
        private string Pfad;

        public Form1()
        {
            InitializeComponent();
            
        }

        private void button1_Click(object sender, EventArgs e)
        {
            
            folderBrowserDialog2.ShowDialog();
            Pfad = folderBrowserDialog2.SelectedPath;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            
            DirectoryInfo di = new DirectoryInfo(Pfad);
            foreach (FileInfo file in di.GetFiles())
            {

            };
        }

        private void folderBrowserDialog2_HelpRequest(object sender, EventArgs e)
        {
            
        }
    }
}
