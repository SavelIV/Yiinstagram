<?php 
/* @var $model frontend\models\Employee  */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1>Welcome to our Company!</h1>

<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'first_name'); ?>
<?php echo $form->field($model, 'last_name'); ?>
<?php echo $form->field($model, 'middle_name'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'birth_date'); ?>
<?php echo $form->field($model, 'city')->dropDownList($model->getCitiesList()); ?>

<?php echo $form->field($model, 'position'); ?>
<?php echo $form->field($model, 'id_code'); ?>
<?php echo $form->field($model, 'hiring_date'); ?>

<?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>


<?php $form = ActiveForm::end(); ?>



