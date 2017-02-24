<?php 
include ("navbar.php");

$user_n = 0;
$comments_n = 0;

?>

<script src="../jscript/view_profile.js"></script>

<main>

	<div class="container">

		<div class="row-fluid">
			<div class="span12 admin-header">

				<h1><?php echo $username;?> </h1>


			</div>
		</div>


		<div class="row-fluid">
			<div class="span12 user-info">
				<h3 style="margin: 0px !important;"><p style="margin: 0px !important;"><?php echo $user['name'];?> <?php echo $user['lastname'];?></p></h3>

				<h4 >Total Articles: <?php echo count ($articles);?></h4>
				<h4 >Total Comments: <?php echo count ($comments);?></h4>
			</div>
		</div>






		<div class="row">
			<div class="span12 wrapper-options">

				<h4> <span class="fa fa-newspaper-o"> </span>  ARTICLES</h4>


				<table class="table table-bordered table-striped table-hover div-table">
					<thead>
						<tr>
							<th>author</th>
							<th>title</th>
							<th>description</th>
							<th>topic</th>
							<th>date</th>
							<th><span class="fa fa-heart"></span></th>
							<th><span class="fa fa-search"></span></th>
							<th><span class="fa fa-commenting"></span></th>

							<?php if ($username == $_SESSION['login_user']) { ?>
							<th>&nbsp;</th>	

							<?php } ?>

						</tr>
					</thead>

					<?php foreach ($articles as $article) { ?>

					<tr>
						<td><?php echo $article['author']; ?></td>
						<td><a href="<?php echo $role; ?>?action=show_article&new_id=<?php echo $article['newId']; ?>" name = "new_id"><?php echo $article['title']; ?></a></td>
						<td><?php echo $article['description']; ?></td>
						<td style="text-align: center;"><?php echo get_topic_by_id($article['topic'])['topicName']; ?></td>
						<td><?php echo $article['date']; ?></td>
						<td style="text-align: center;"><?php echo $article['likes']; ?></td>
						<td style="text-align: center;"><?php echo $article['views']; ?></td>
						<td style="text-align: center;"><?php echo count(get_comments_for_article($article['newId'])); ?></td>
						<?php if ($username == $_SESSION['login_user']) { ?>

						<td style="text-align: center;"><a href="#" name="new_id">
							<span id="<?php echo $article['newId'];?>" class="rmv fa fa-remove" style=" font-size: 20px;" ></span>
						</a></td>

						<?php } ?>
						
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
							<?php if ($username == $_SESSION['login_user']) { ?>

							<th>&nbsp;</th>

							<?php } ?>

						</tr>
					</thead>

					<?php foreach ($comments as $comment) { ?>

					<tr>
						<td><?php echo $comment['author']; ?></td>
						<td><a href="<?php echo $role; ?>?action=show_article&new_id=<?php echo $article['newId']; ?>" name = "new_id"><?php echo get_article($comment['newId'])['title']; ?></a></td>
						<td><?php echo $comment['text']; ?></td>
						<td><?php echo $comment['votes']; ?></td>
						<td><?php echo $comment['date']; ?></td>
						<?php if ($username == $_SESSION['login_user']) { ?>

						<td style="text-align: center;"><a href="#" name="comment_id">
							<span id="c <?php echo $comment['commentId'];?>" class="rmv-comment fa fa-remove" style=" font-size: 20px;" ></span>
						</a></td>

						<?php } ?>
						
					</tr>
					
					<?php } ?>

				</table>

			</div>


		</div>



	</div>


	<script>

	</script>


</main>