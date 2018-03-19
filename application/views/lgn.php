<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login form </title>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
       <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
</head>

<body id=bakchround>
  <body>
<div class="container">
	<section id="content">
    <?php echo form_open('auth/cekLogin'); ?>
      <!-- <form class="" action="<?php// echo base_url(); ?>" method="post" autocomplete="off"> -->

			<h1>Login Form</h1>
			<div>
          <span class="glyphicon glyphicon-user"></span>
				<input type="text" placeholder="Username" required id="username" autoComplete="off" name="username" />
			</div>
			<div>
          <span class="glyphicon glyphicon-lock"></span>
				<input readonly type="password" placeholder="Password" required id="password"  onfocus="this.removeAttribute('readonly');" name="password" autocomplete="off"  />
			</div>
      <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
          <button type="submit" name="button" class="btn btn-warning btn-lg btn-block">Login</button>
        </div>
        <div class="col-md-1">

        </div>
      </div>



		</form><!-- form -->
		<div class="button">
			<a href="#"><?php if(isset($pesan)){
        echo $pesan;
      } ?></a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>

    <script  src="<?php echo base_url('assets/js/index.js');?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript">

    </script>
</body>
</html>
