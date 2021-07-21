<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Self Service IT</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('/assets/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('/assets/css/nprogress.css');?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('/assets/css/blue.css');?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('/assets/css/bootstrap-progressbar-3.3.4.min.css');?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('/assets/css/jqvmap.min.css');?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('/assets/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">
	<!-- PNotify -->
    <link href="<?php echo base_url('/assets/css/pnotify.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/pnotify.buttons.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/pnotify.nonblock.css');?>" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url('/assets/images/icon.png');?>" />
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/assets/css/dashboard.css');?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
	  <img src="<?php echo base_url('/assets/images/spinner.gif');?>" id="gif" style="position:fixed;z-index:1050;top:50%;left:50%;margin-top:-100px;margin-left:-100px;width:200px;display:block;visibility:hidden">
      <div class="login_wrapper">
        <div class="form login_form">
          <section class="login_content">
            <form method="post" id="form_login_a" action="<?php echo site_url('/Login');?>">
              <h4>Login</h4>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div class="left">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Remember Me</label>
              </div>
              <div>
                <input type="submit" class="btn btn-primary" name='login' value='Login'>
              </div>

              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>
  </body>
  <!-- PNotify -->
  <script src="<?php echo base_url('/assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('/assets/js/pnotify.js');?>"></script>
    <script src="<?php echo base_url('/assets/js/pnotify.buttons.js');?>"></script>
    <script src="<?php echo base_url('/assets/js/pnotify.nonblock.js');?>"></script>
  <!-- PNotify -->
    <script>
      $(document).ready(function() {
      $('#form_login_a').submit(function(e) {
		$('<div class="modal-backdrop" style="opacity:0.8"></div>').appendTo(document.body);
		$('#gif').css('visibility', 'visible');
		return true;
	});
      <?php 
      if(isset($_GET['error'])){
      echo '
        new PNotify({
          title: "Warning",
          type: "alert",
          text: "Username or Password Incorrect!",
          nonblock: {
              nonblock: true
          },
          addclass: "red",
          styling: "bootstrap3"
        });
		';
		}
		if(isset($_GET['success'])){
      echo '
        new PNotify({
          title: "Session Cleared",
          type: "info",
          text: "",
          nonblock: {
              nonblock: true
          },
          addclass: "dark",
          styling: "bootstrap3"
        });
		';
		}
		?>
      });
    </script>
    <!-- /PNotify -->
</html>
