<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>playVC</title>	
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/plugin.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />		
</head>

<body>
  <div id="wrapper" class="clearfix">
	 <div id="top">
		<div id="header">
			<h1><a href="<?php echo base_url() ?>">playVC</a></h1>
			
			<div id="info">
				<?php  if($this->tank_auth->is_logged_in()): ?>
    				<h4>Welcome <a href="<?php print base_url();?>dashboard"><?php echo $this->tank_auth->get_username();?></a></h4>
    				<p><a href="<?php echo base_url()?>auth/logout" title="Logout">Logout</a></p>
    				<img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower($this->tank_auth->get_usermail()))?>?s=65&d=<?php echo urlencode(base_url()."images/avatar.jpg")?>" alt="avatar" />
				<?php else: ?> 
  					<form action="<?php echo base_url() ?>/auth/login" method="post" accept-charset="utf-8">
  						<div class="field"><label for="login">Email or login</label>
                    	<input type="text" name="login" value="" id="login" maxlength="80" size="30"/></div> 
                    	<div class="field"><label for="password">Password</label> 
                        <input type="password" name="password" value="" id="password" size="30"/></div> 
                    	<div class="field"><input type="checkbox" name="remember" value="1" id="remember" style="margin:0;padding:0"/>
                    	<label for="remember">Remember me</label></div>
                    	<a href="<?php echo base_url() ?>/auth/forgot_password">Forgot password</a>
                    	<a href="<?php echo base_url() ?>/auth/register">Register</a>
                    	<input type="submit" name="submit" value="Let me in"/>
                    </form>
				<?php endif; ?>
				
				
			</div> <!-- #info --> 
					
		</div> <!-- #header -->	
		
		
		<div id="nav">	
	
			<ul class="mega-container mega-grey">
	
				<li class="mega mega-current">
					<a href="<?php echo base_url()?>dashboard" class="mega-link">Portfolio</a>	
				</li>
				
				<li class="mega">
					<a href="<?php echo base_url()?>startups" class="mega-link">StarUps</a>	
				</li>
				
				<li class="mega">
					<a href="<?php echo base_url()?>friends" class="mega-link">Friends</a>	
				</li>
		
				<li class="mega">				
					<a href="javascript:;" class="mega-tab">
						Settings
					</a>
					
					<div class="mega-content mega-menu ">
						<ul>
							<li><a href="sample_gallery.html">Una</a></li>
							<li><a href="sample_reports.html">Dos</a></li>			
							<li><a href="sample_faq.html">Tre</a></li>				
							<li><a href="sample_invoice.html">Cuatro</a></li>	
						</ul>
					</div>						
				</li>
			</ul>
			<div id="search">
			    <form action="<?php print base_url();?>startups/search" method="post">
				<input type="text" name="q_startup" value="" id="q_startup">
            	<input type="submit" value="Startup Search &rarr;" class="btn btn-orange">
			    </form>
			</div>
		</div> <!-- #nav -->

		<div id="content" class="xfluid">
		  <?php echo $content; ?>
		</div>
	</div> <!-- #top -->
	
	
	<div id="footer">
		
		<p>Copyright &copy; 2011 <a href="javascript:;">playVC</a>, all rights reserved.</p>
		
	</div> <!-- #footer -->
	
</div> <!-- #wrapper -->

<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script  type="text/javascript" src="<?php echo base_url(); ?>js/slate/slate.js"></script>
<script  type="text/javascript" src="<?php echo base_url(); ?>js/slate/slate.portlet.js"></script>
<script  type="text/javascript" src="<?php echo base_url(); ?>js/plugin.js"></script>
<script  type="text/javascript" src="<?php echo base_url(); ?>js/application.js"></script>
<script  type="text/javascript" src="<?php echo base_url(); ?>js/highcharts.js"></script>
</body>

</html>