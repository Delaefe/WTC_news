
<!DOCTYPE html>

<html>
<head>
	<title>WTC NEWS</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	

	<link rel="stylesheet" href="../css/style.css">

	<script src="../jscript/jquery.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>


<body>

<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">

				<div class="navbar navbar-fixed-top navbar-inverse">
					<div class="navbar-inner ">

						<div class="container">

							<a href="<?php echo $role; ?>?action=home" class="brand"> WTC News</a>

							<ul class="nav pull-left">
								<li><a href="<?php echo $role; ?>?action=home">Home</a></li>

								<?php if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") { ?>
								<li><a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $_SESSION['login_user'];?>">Profile</a></li>

								<?php } ?>

							
								<li><a href="<?php echo $role; ?>?action=about_us">About us</a></li>

								<li class="divider-vertical"></li>

								<?php 
								if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") { 
								if ($_SESSION['user_type'] == 2) { ?>
								<li><a href="<?php echo $role; ?>?action=admin_page">Admin</a></li>

								<?php } } ?>							
							</ul>
						<?php if ($_SESSION['login_user'] != NULL && $_SESSION['login_user'] != "") { ?>
							<ul class="nav pull-right">
								<li><a href="<?php echo $role; ?>?action=log_out">Log out</a></li>
							</ul>
						<?php } ?>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
	
	


</body>
</html>