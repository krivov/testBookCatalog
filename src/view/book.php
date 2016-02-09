<?php require "header.php"; ?>

<?php
/** @var Book $book */
/** @var Author[] $authors */
?>

<div class="container">
    <h1>Книга: <?=$book->name?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?php if($book->picture): ?>
                <img class="img-circle" src="/upload/<?=$book->picture?>" style="width: 140px; height: 140px;">
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?=$book->date?>
        </div>
    </div>

    <h2>Авторы:</h2>
    <div class="row">
        <div class="col-lg-12">
            <?php foreach($authors as $author):?>
                <div class="row">
                    <b><?=$author->lastname?> <?=$author->firstname?> <?=$author->middlename?></b>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
