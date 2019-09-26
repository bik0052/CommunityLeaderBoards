<?php require_once ('../app/views/langConfig.php')?>
<br><br>
<div class="container text-center jumbotron">
    <div>
        <br><br>
        <h1 class="display-3"><?php echo $GLOBALS['lang']['homeTitle'] ?></h1>
        <br><br>
        <h2 class="display-4"><?=Security::sanitise($data['name']) ?></h2>
    </div>
</div>
<br><br>
<?php Utility::getPage('../app/views/footer/footer') ?>