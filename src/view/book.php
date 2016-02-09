<?php require "header.php"; ?>

<?php
/** @var Book $book */
?>

<div class="container">
    <h1>Книга: <?=htmlspecialchars($book->name)?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?php if($book->picture): ?>
                <img class="img-circle" src="/upload/<?=$book->picture?>" style="width: 140px; height: 140px;">
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?=htmlspecialchars($book->date)?>
        </div>
    </div>

    <h2>Авторы:</h2>
    <div class="row">
        <div class="col-lg-12">
            <?php foreach($book->authors as $author):?>
                <div class="row">
                    <b><?=htmlspecialchars($author->lastname)?> <?=htmlspecialchars($author->firstname)?> <?=htmlspecialchars($author->middlename)?></b>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
