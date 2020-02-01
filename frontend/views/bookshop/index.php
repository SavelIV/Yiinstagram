<?php
/* @var $this yii\web\View */
/*@var $bookList[] frontend\models\Book */
use yii\helpers\Url;
?>
<h1>Книги:</h1>
<br>
<a href="<?php echo Url::to(['create']); ?>" class="btn btn-primary">Добавить книгу</a>
<br><br>
<?php foreach ($bookList as $book): ?>
    <div class="col-md-10">
        <hr>
        <?php foreach ($book->getAuthors() as $author): ?> 
            <p><?php echo $author->first_name . ' ' . $author->last_name; ?></p>
        <?php endforeach; ?>
        <h3>"<?php echo $book->name; ?>"</h3>
        <p><?php echo $book->getDatePublished(); ?></p>
        <p>Издатель: <?php echo $book->getPublisherName(); ?></p>


        <hr>

    </div>
    <?php endforeach;

