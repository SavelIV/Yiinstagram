<?php 
/* @var $model frontend\models\Employee  */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if ($model->hasErrors()) {
    echo '<pre>';
    print_r($model->getErrors());
    echo '</pre>';
}
?>

<h1>Welcome to our Company!</h1>

<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'firstName'); ?>
<?php echo $form->field($model, 'lastName'); ?>
<?php echo $form->field($model, 'middleName'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'birthDate'); ?>
<?php echo $form->field($model, 'city')->dropDownList($model->getCitiesList()); ?>

<?php echo $form->field($model, 'position'); ?>
<?php echo $form->field($model, 'idCode'); ?>
<?php echo $form->field($model, 'hiringDate'); ?>

<?php echo Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>


<?php $form = ActiveForm::end(); ?>



