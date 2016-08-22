using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Net;
using System.Text;
using System.IO;

public partial class _Default : System.Web.UI.Page
{
    const string IOC_LOGGED_IN_COOKIE = "ioc_loggedin";
    const string Base_API_URI = "http://localhost:52432/";

    protected void Page_Load(object sender, EventArgs e)
    {
        if(!IsPostBack)
        {
            string username = GetCookie(IOC_LOGGED_IN_COOKIE); 
            lbl_UserName.Text = username;
            
            string userinfo = GetUserInfo(username);
            lbl_UserName.ToolTip = userinfo;
        }
    }

    public string GetCookie(string cookieName) 
    {
        var cookie = Request.Cookies[cookieName];
        return cookie == null ? "N/A" :  cookie.Value;
    }

    public string GetUserInfo(string username)
    {
        string url_userinfo = Base_API_URI + "api/IOCUserInfo?loginName=" + username;

        try
        {
            HttpWebRequest request = (HttpWebRequest) WebRequest.Create(url_userinfo);
            using (WebResponse response = request.GetResponse())
            {
                using (Stream stream = response.GetResponseStream())
                {
                    StreamReader reader = new StreamReader( stream );
                    return reader.ReadToEnd();
                }
            }
        }
        catch (WebException ex)
        {
            return ex.Message;
        }

    }
}