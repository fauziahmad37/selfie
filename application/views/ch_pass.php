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
	
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('/assets/css/custom.css');?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo site_url('/Users/chpass');?>">
              <h4>Please Change Your Password First</h4>
              <div>
                <input type="password" class="form-control" name="password" placeholder="New Password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password2" placeholder="Repeat Password" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-primary" name='login' value='Update Password'>
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
      <?php 
      if(isset($_GET['error'])){
      echo '
        new PNotify({
          title: "Warning",
          type: "alert",
          text: "Password Is Not Same",
          nonblock: {
              nonblock: true
          },
          addclass: "red",
          styling: "bootstrap3"
        });
		';
		}
		?>
      });
    </script>
    <!-- /PNotify -->
</html>
