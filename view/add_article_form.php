<main>
	
	<?php
	include("navbar.php");
	?>

<script src="../jscript/add_article.js"></script>



	<div class="container">

		<div class="row">
			<div class="span2">
				<span class="back">

				</span>
			</div>
		</div>
		<div class="row add-article-container">
			<h2>Add Article</h2>

			<div class="cancel">
				<form action="<?php echo $role; ?>" method="POST">
					<input type="hidden" name="action" value="home">
					<input type="submit" value="Cancel" class="btn btn-danger"><br>
				</form>
			</div>
			<div class="form-group">
				<form action="<?php echo $role; ?>" method="POST" >
					<div class='row'>
						<input class="form-input" id="title" type="text" name="title" required placeholder="Title" onKeyDown="check_length_title()" onKeyUp="check_length_title()" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete=off><br/>

						<textarea rows="2" name="description" id="description" required size="178" placeholder="Add a description of your article." onKeyDown="check_length()" onKeyUp="check_length()"  ></textarea><br/>

						<select name="topic" class="topic" required>
							<option value="">Choose topic</option>

							<?php foreach ($topics as $topic) { ?>

							<option value="<?php echo $topic['topicId']; ?>"><?php echo $topic['topicName']; ?></option>

							<?php } ?>

							
						</select><br/>

						<textarea rows="15" name="content" placeholder="Add the content of your article."></textarea>
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
							<input type="hidden" name="author" value="<?php echo $_SESSION['login_user'];?>">
							<input type="hidden" name="action" value="add_article">
							<input class='send btn-submit' type="submit" value="Add Article">
						</div>

					</form>
				</div>
			</div>
		</div>



	</main>