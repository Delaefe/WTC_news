<?php 
include ("navbar.php");

$user_n = 0;
$comments_n = 0;

?>

<script src="../jscript/admin.js"></script>




<main>

	<div class="container">

		<div class="row-fluid">
			<div class="span12 admin-header">

				<h1>ADMINISTRATOR </h1>


			</div>
		</div>


		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="span12 stadistics-btn">
						<span class="btn btn-primary" id="menu-toggle">
							<p class="fa fa-bar-chart" >
							</p>
						</span>
						
					</div>
				</div>
			</div>
		</div>
		<!-- /#page-content-wrapper -->

		<div id="wrapper">
			<!-- Sidebar -->
			<div id="sidebar-wrapper">

				<h1>STADISTICS</h1>

				<ul class="nav">
					<li>Total News: <?php echo count ($news);?></li>
					<li>Total Comments in News: <?php echo count ($comments);?></li>
					<li>Total Likes: <?php echo count($likes);?></li>
					<li>Users Registered: <?php echo count ($users);?></li>
				</ul>
			</div>

			<div id="sidebar-wrapper-right">
				<ul class="nav pull-right">					
					<li>General: <?php echo $stadistics[0]; ?></li>
					<li>Economy: <?php echo $stadistics[1]; ?></li>
					<li>Science & Techonlogy: <?php echo $stadistics[2]; ?></li>
					<li>Culture: <?php echo $stadistics[3]; ?></li>
					<li>Sports: <?php echo $stadistics[4]; ?></li>

				</ul>
			</div>




			<!-- /#sidebar-wrapper -->
		</div>


		<div class="row">
			<div class="span12 wrapper-options">
				<h4> <span class="fa fa-group"> </span>  USERS</h4>



				<table class="table table-bordered table-striped table-hover div-table ">

					<thead>
						<tr>
							<th>#</th>
							<th>username</th>
							<th>password</th>
							<th>name</th>
							<th>lastname</th>
							
							<th>bio</th>
							<th><span class="fa fa-newspaper-o"></span></th>
							<th><span class="fa fa-commenting"></span></th>
							<th><span class="fa fa-heart"></span></th>
							<th>&nbsp;</th>	

						</tr>

					</thead>

					<?php foreach ($users as $user) { ?>
					<tr>
						<td style="text-align: center;"><?php echo $user_n+1 ;?></td>
						<td><a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $user['username'];?>" name="username"><?php echo $user['username']; ?></a></td>
						<td><?php echo $user['password']; ?></td>
						<td><?php echo $user['name']; ?></td>
						<td><?php echo $user['lastname']; ?></td>
						<td><?php echo $user['bio']; ?></td>
						<td style="text-align: center;"><?php echo count(get_articles_by_username($user['username'])); ?></td>
						<td style="text-align: center;"><?php echo count(get_comments_by_username($user['username'])); ?></td>
						<td style="text-align: center;"><?php echo count(get_likes_by_username($user['username'])); ?></td>
						<td style="text-align: center;"><a href="#" name="username"><span id="<?php echo $user['username'];?>" class="fa fa-user-times" style=" font-size: 20px; " ></span></a>

						
					</tr>
					
					<?php } ?>

					
				</table>



			</div>


		</div>

		<div class="row">
			<div class="span12 wrapper-options">

				<h4> <span class="fa fa-newspaper-o"> </span>  ARTICLES</h4>


				<table class="table table-bordered table-striped table-hover div-table">
					<thead>
						<tr>
							<th>id</th>
							<th>author</th>
							<th>title</th>
							<th>description</th>
							<th>topic</th>
							<th>date</th>
							<th><span class="fa fa-heart"></span></th>
							<th><span class="fa fa-search"></span></th>
							<th><span class="fa fa-commenting"></span></th>
							<th>&nbsp;</th>	
							<th>&nbsp;</th>					

						</tr>
					</thead>

					<?php foreach ($news as $article) { ?>

					<tr>
						<td><?php echo $article['newId'] ;?></td>
						<td><a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $article['author'];?>" name="username"><?php echo $article['author']; ?></a></td>
						<td><a href="<?php echo $role; ?>?action=show_article&new_id=<?php echo $article['newId']; ?>" name = "new_id"><?php echo $article['title']; ?></a></td>
						<td><?php echo $article['description']; ?></td>
						<td style="text-align: center;"><?php echo get_topic_by_id($article['topic'])['topicName']; ?></td>
						<td><?php echo $article['date']; ?></td>
						<td style="text-align: center;"><?php echo $article['likes']; ?></td>
						<td style="text-align: center;"><?php echo $article['views']; ?></td>
						<td style="text-align: center;"><?php echo count(get_comments_for_article($article['newId'])); ?></td>
						<td style="text-align: center;"><a href="#" name="new_id">
							<span id="<?php echo $article['newId'];?>" class="rmv fa fa-remove" style=" font-size: 20px;" ></span>
							</a></td>


						<td>
							<?php if ($article['frontpage'] == 1) {
								$selected = 'thumb-selected';
							}elseif ($article['frontpage'] == 0) {
								$selected = '';
							} ?>

							<a href="#" name="new_id">
							<span id="<?php echo $article['newId'];?>" class="fa fa-thumb-tack <?php echo $selected; ?>" style=" font-size: 20px;" ></span>
							</a>

						</td>
						
					</tr>
					
					<?php } ?>

				</table>

			</div>


		</div>

		<div class="row">
			<div class="span12 wrapper-options">

				<h4> <span class="fa fa-commenting-o"> </span>  COMMENTS</h4>


				<table class="table table-bordered table-striped table-hover div-table">
					<thead>
						<tr>
							<th>author</th>
							<th>title</th>
							<th>text</th>
							<th><span class="fa fa-thumbs-up"></span></th>
							<th>date</th>
							<th>&nbsp;</th>

						</tr>
					</thead>

					<?php foreach ($comments as $comment) { ?>

					<tr>
						<td><a href="<?php echo $role; ?>?action=view_profile&username=<?php echo $comment['username'];?>" name="username"><?php echo $comment['author']; ?></a></td>
						<td><a href="<?php echo $role; ?>?action=show_article&new_id=<?php echo $article['newId']; ?>" name = "new_id"><?php echo get_article($comment['newId'])['title']; ?></a></td>
						<td><?php echo $comment['text']; ?></td>
						<td><?php echo $comment['votes']; ?></td>
						<td><?php echo $comment['date']; ?></td>
						<td style="text-align: center;"><a href="#" name="comment_id">
							<span id="C<?php echo $comment['commentId'];?>" class="rmv-comment fa fa-remove" style=" font-size: 20px;" ></span>
							</a></td>


						
					</tr>
					
					<?php } ?>

				</table>

			</div>


		</div>



	</div>


	<script>

</script>


</main>