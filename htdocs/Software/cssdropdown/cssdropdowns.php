<html>
<head>

<style>
/* Style The Dropdown Button */
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>
</head>
<body>
<div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="#">Link 1</a>
            <ul class="nav">
                                    <li class="dropdown active">
                                        <asp:HyperLink ID="hlHome" runat="server" href="Default.aspx">Home</asp:HyperLink>
                                    </li>
                                    <li class="dropdown">
                                        <asp:HyperLink runat="Server" cssClass="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">
                                            Register
                                            <i class="icon-angle-down"></i>
                                        </asp:HyperLink>
                                        <ul class="dropdown-menu">
                                            <li><asp:HyperLink runat="server" ID="hlCreateAccount" href="register.aspx">Create Account</asp:HyperLink></li>
                                            <li><asp:HyperLink runat="Server" href="forgot.aspx" ID="hlForgot">Forgot Credentials ?</asp:HyperLink></li>
                                            <li><asp:HyperLink runat="server" href="blocked.aspx" ID="hlBlockedAccount">Blocked Account</asp:HyperLink></li>
                                            <li><asp:HyperLink ID="hlUnblockAccount" href="unblock.aspx" runat="server">Unblock Account</asp:HyperLink></li>
                                                       

                                                    var selector = '.nav li';

                                                    $(selector).on('click', function(){
                                                        $(selector).removeClass('active');
                                                        $(this).addClass('active');
                                                    });                                        


                                        </ul>
                                    </li>
                                    <li><asp:HyperLink  ID="hlBug" runat="server" href="bug.aspx">Report A Bug</asp:HyperLink></li>
                                    <li><asp:HyperLink ID="hlContact" runat="server" href="contact.aspx">Contact Us</asp:HyperLink></li>
                                </ul>

                             

                                


    <a href="#">Link 2</a>

    <a href="#">Link 3</a>

  </div>

</div>

</body>
</html>