if (document.all){
  document.write('<A HREF="javascript:history.go(0);" onClick="this.style.behavior=\'url(#default#homepage)\';this.setHomePage(\'http://www.YourWebSiteHere.com\');">');
  document.write('<font size="5" color=6699FF face=arial><B>Click Here to Make My Web Page Your Homepage</B></font></a>');
} else {
  document.write('<a href="homepage.php">Make LaunchPages.com Your Home Page.</a>');
}