<?php 
/* @var $model frontend\models\Employee  */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Update your details: <?php echo $model['last_name']; ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'first_name'); ?>
<?php echo $form->field($model, 'last_name'); ?>
<?php echo $form->field($model, 'middle_name'); ?>

<?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>


<?php $form = ActiveForm::end(); ?>