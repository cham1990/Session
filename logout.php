<?php

require_once 'config.php';

?>

<html>
   
   <head>
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
       <?php
if(empty($_SESSION['user_id'])){ ?>
    
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "<?php echo EXEC;?>login.php" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
            </div>
				
         </div>
<?php } else { ?>
          <form action = "<?php echo EXEC;?>logout.php" method = "post">                  
                  <input type = "submit" value = " Logout "/><br />
               </form>
        <div align = "center">
         <img src="images/welcome.jpg">
				
         </div>
          
          
<?php } ?>			
      </div>

   </body>
</html>

