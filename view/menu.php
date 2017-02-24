	

	<div class="row-fluid menu" >

		<div class="span12 ">
			<div class="container">

			<ul class="nav nav-tabs">

				</li>

				<li><a href="<?php echo $role; ?>?action=home">Front Page</a></li>

				<?php foreach ($topics as $topic) { ?>
				<li  id="topics" >
					<a  href="<?php echo $role; ?>?topic_id=<?php echo $topic['topicId']; ?>">
						<span><?php echo $topic['topicName']; ?></span>
					</a>
				</li>
				<?php } ?>

				<li style="border-left: 1px solid blue;"><a href="<?php echo $role; ?>?action=most_popular">Most Popular</a></li>
				<li><a href="<?php echo $role; ?>?action=most_viewed">Most Viewed</a></li>
			</ul>
		</div>
	</div>
</div>