<%@ Page Language="C#" AutoEventWireup="true" 
    CodeFile="session.aspx.cs" Inherits="_Default" 
   MasterPageFile="~/MasterPage.master" %>


<asp:Content ID="Content1" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Mockup</a>
            </div>
        </div>
     </div>
     <div class="container body-content">
         <div class="jumbotron">
            <h1>Session Mockup</h1>
            <p class="lead">Test cookie passing between PHP and ASP.Net served pages</p>
            <p class="lead">&nbsp;</p>
            <p class="lead">&nbsp;</p>
            <p>Current Logged In User: <mark><asp:Label runat="server" ID="lbl_UserName" /></mark> </p>
            <p>
                <a href="http://localhost/ioc" class="btn btn-primary btn-lg">I/O Control Homepage</a>
                <a href="http://localhost/ioc/login.php?action=logout" class="btn btn-primary btn-lg">Logout</a>
            </p>
        </div>
     </div>
     <div class="row">
         <div class="col-md-4">
             <p>
                 <asp:Label runat="server" ID="lbl_UserInfo" />
             </p>
         </div>
         <div class="col-md-4">&nbsp</div>
         <div class="col-md-4">&nbsp</div>
     </div>
</asp:Content>

