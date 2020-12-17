<?php

/* @var $newsCount [] array */
/* @var $emailsCount [] array */
/* @var $statusesCount [] array */
/* @var $subscribers [] array */
/* @var $noNews [] array */
/* @var $noSubscribers [] array */

?>


<?php echo $newsCount; ?>
<hr>
<?php echo $emailsCount; ?>
<?php foreach ($subscribers as $subscriber): ?>
    <p><?php echo $subscriber['email']; ?></p>
<?php endforeach; ?>
<hr>
<?php echo $statusesCount; ?>
<hr>
<?php if ($noNews != ''): ?>
    <?php echo $noNews; ?>
<?php endif ?>
<?php if ($noSubscribers != ''): ?>
    <?php echo $noSubscribers; ?>
<?php endif ?>




