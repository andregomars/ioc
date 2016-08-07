using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class _Default : System.Web.UI.Page
{
    const string IOC_LOGGED_IN_COOKIE = "ioc_looggedin";

    protected void Page_Load(object sender, EventArgs e)
    {
        string username = GetCookie(IOC_LOGGED_IN_COOKIE); 
        Response.Write("username is: " + username);

    }

    public string GetCookie(string cookieName) 
    {
        var cookie = Request.Cookies[cookieName];
        return cookie == null ? null :  cookie.Value;
    }
}