<?php require "header.php"; ?>

<?php
/** @var Book $book */
?>

<div class="container">
    <h1>
        Книга: <?=htmlspecialchars($book->name)?>
        <a href="/?page=addedit&id=<?=$book->id;?>" class="btn btn-primary">Редактировать</a>
        <a href="/?page=delete&id=<?=$book->id;?>" class="btn btn-danger">Удалить</a>
    </h1>

    <div class="row">
        <div class="col-lg-12">
            <?php if($book->picture): ?>
                <img class="img-circle" src="/upload/<?=$book->picture?>" style="width: 140px; height: 140px;">
            <?php endif ?>
        </div>
    </div>
    <?php if ($book->date): ?>
    <div class="row">
        <div class="col-lg-6">
            <?=date("d.m.Y", strtotime($book->date))?>
        </div>
    </div>
    <?php endif; ?>

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
