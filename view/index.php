<?php require "header.php"; ?>

<h1>Привет, мир!</h1>
<div class="container">
    <div class="row">
        <?php foreach($allBooks as $book): /** @var Book $book */ ?>
        <div class="col-lg-4" href="?page=book&id=<?=$book->id?>">
            <?php if($book->picture): ?>
                <img class="img-circle" src="/upload/<?=$book->picture?>" style="width: 140px; height: 140px;">
            <?php endif ?>
            <h2><?=$book->name?></h2>
            <p><a class="btn btn-default" href="?page=book&id=<?=$book->id?>" role="button">Подробнее »</a></p>
        </div><!-- /.col-lg-4 -->
        <?php endforeach; ?>
    </div>
</div>

<?php require "footer.php"; ?>
