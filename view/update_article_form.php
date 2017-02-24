<main>
	
	<?php
	include("navbar.php");
	?>

	<script>
		$(document).ready(function () {
			$("#title").focus().val($('#title').val());
		});

		content_textarea = "";
		content_title = "";
		title_size= 85;
		max_size = 178;

		function check_length_title(){ 
			countt = document.getElementById("title").value.length;

			if (countt > title_size){ 
				document.getElementById("title").value = content_title;
			}else{ 
				content_title = document.getElementById("title").value;
			} 

		} 

		function check_length(){ 
			count = document.getElementById("description").value.length;

			if (count > max_size){ 
				document.getElementById("description").value = content_textarea;
			}else{ 
				content_textarea = document.getElementById("description").value;
			} 

		} 

		</script>


		<div class="container">

			<div class="row">
				<div class="span2">
					<span class="back">

					</span>
				</div>
			</div>
			<div class="row add-article-container">
				<h2>Edit Article</h2>

				<div class="cancel">
					<form action="<?php echo $role; ?>?action=show_article&new_id=<?php echo $new_id;?>" method="POST">

						<input type="submit" value="Cancel" class="btn btn-danger"><br>
					</form>
				</div>
				<div class="form-group">
					<form action="<?php echo $role;?>" method="POST" >
						<div class='row'>
							<input class="form-input" id="title" type="text" name="title" required placeholder="Title" value="<?php echo htmlentities($title, ENT_QUOTES); ?>" onKeyDown="check_length_title()" onKeyUp="check_length()_title"
							onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete=off		
							><br/>

							<textarea rows="2" name="description" id="description" required size="178" placeholder="Add a description of your article." onKeyDown="check_length()" onKeyUp="check_length()"

							onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete=off  ><?php echo htmlentities($description, ENT_QUOTES); ?></textarea><br/>

							<select name="topic" class="topic" required >
								<?php foreach ($topics as $topicItem) { ?>

								<option value="<?php echo $topicItem['topicId']; ?>"<?php if ($topic == $topicItem['topicId']): ?> selected="selected"<?php endif; ?>>
									<?php echo $topicItem['topicName']; ?>
								</option>

								<?php } ?>


							</select><br/>

							<textarea id="content_article" rows="20" name="content" ><?php echo htmlentities($content, ENT_QUOTES); ?></textarea>
							<br/>

							<span class="uploadImage">
								<input id="uploadFile" placeholder="Choose File" disabled="disabled" />
								<div class="fileUpload btn btn-primary">
									<span>Upload</span>
									<input id="uploadBtn" type="file" class="upload" name="image" />
								</div>

							</span>
							<br />



							<div class='row'>
								<input type="hidden" name="new_id" value="<?php echo $new_id;?>">
								<input type="hidden" name="action" value="update_article">
								<input class='send btn-submit' type="submit" value="Update Article">
							</div>

						</form>
					</div>
				</div>
			</div>



		</main>