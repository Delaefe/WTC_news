<?php
include ("navbar.php");
?>


<main>

    <div class="container">
        <div class="row-fluid">
            <div class="span12 admin-header">
                <h1>ERROR PAGE </h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12" style="height: 700px;">
                <h2>Ups!.. We've found some error here...</h2>
                <h3><?php echo $error_message; ?></h3>
            </div>
        </div>
    </div>

</main>

<?php
include ("../view/footer.php");
?>