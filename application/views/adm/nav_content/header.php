<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/apple-icon.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/favicon.png');?>">
	<!-- untuk popup -->
	<script src=<?php echo base_url("assets/js/pop_up.js");?> type="text/javascript"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Cv Trans Jogja</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href=<?php  echo base_url("assets/css/bootstrap.min.css"); ?> rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href=<?php echo base_url("assets/css/animate.min.css");?> rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href=<?php echo base_url("assets/css/paper-dashboard.css");?> rel="stylesheet"/>
		<!--  sweet alert-->
		<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert.css'); ?>" >


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=<?php echo base_url("assets/css/demo.css"); ?> rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href=<?php echo base_url("assets/css/themify-icons.css");?> rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    DashBoard
                </a>
            </div>

            <ul class="nav">
                <li class="<?php echo $this->session->userdata('class0'); ?>">
                    <a href="<?php echo base_url().'index.php/nex_page/dashboard';?>">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php echo $this->session->userdata('class1'); ?>">
                    <a href="<?php echo base_url().'index.php/nex_page/pegawai';?>">
                        <i class="ti-user"></i>
                        <p>Data Pegawai</p>
                    </a>
                </li>
								<li class="<?php echo $this->session->userdata('class2');?>">
                    <a href="<?php echo base_url().'index.php/nex_page/jadwal';?>">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <p>Jadwal Pegawai</p>
                    </a>
                </li>
                

                <li class="<?php echo $this->session->userdata('class4');?>">
                    <a href="<?php echo base_url().'index.php/nex_page/setting';?>">
                        <i class="ti-settings"></i>
                        <p>Setting</p>
                    </a>
                </li>

				<li class="active-pro">
                    <a href="<?php echo base_url().'index.php/nex_page/logOut';?>">
                        <i class="ti-export"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
		<div class="main-panel">
				<nav class="navbar navbar-default">
						<div class="container-fluid">
								<div class="navbar-header">
										<button type="button" class="navbar-toggle">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar bar1"></span>
												<span class="icon-bar bar2"></span>
												<span class="icon-bar bar3"></span>
										</button>
										<a class="navbar-brand" href="#">CV. Trans Jogja</a>
								</div>
								<div class="collapse navbar-collapse">
										<ul class="nav navbar-nav navbar-right">

												<li>
															<a href="" data-toggle="modal" data-target="#myModalInfo">
																		<i class="ti-info-alt"></i>
																		<p>Info Jadwals</p>
																		<b class="caret"></b>
															</a>

												</li>
						<li>
														<a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
														</a>
												</li>
										</ul>

								</div>
						</div>
				</nav>
