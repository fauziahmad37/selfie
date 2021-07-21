<!DOCTYPE html> 
<html lang = "en"> 

   <head> 
      <meta charset = "utf-8"> 
      <title>CodeIgniter Email Example</title> 
   </head>
	
   <body> 
      <?php 
         echo $this->session->flashdata('email_sent'); 
      ?> 
		<form id="demo-form2" autocomplete="off" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('/Users/send_mail'); ?>" method="post">

      <input type = "email" name = "email" required /> 
      <input type = "submit" value = "SEND MAIL"> 
	  </form>
		
     
   </body>
	
</html>