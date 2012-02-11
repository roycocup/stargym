<?php 
	$members = Members::model()->findAll(); 
	
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'member_id'); ?>
		<?php echo CHtml::dropDownList('Payments[member_id]', '*', CHtml::listData($members, 'id', 'slug')); ?>
		<?php echo $form->error($model,'member_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extras'); ?>
		<?php //echo $form->textField($model,'extras',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::dropDownList('Payments[extras]', '*', array(''=>'Select one','gym'=>'Gym', 'Single Class'=>'Single Class')); ?>
		<?php echo $form->error($model,'extras'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extras_value'); ?>
		<?php echo $form->textField($model,'extras_value'); ?>
		<?php echo $form->error($model,'extras_value'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->