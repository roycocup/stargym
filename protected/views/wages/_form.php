<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wages-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'teacher_id'); ?>
		<?php echo $form->dropDownList($model,'teacher_id', CHtml::listData(Teachers::model()->findAll(),'id','first_name'),array('empty'=>'Select a teacher')); ?>
		<?php echo $form->error($model,'teacher_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payed'); ?>
		<?php echo $form->checkbox($model,'payed'); ?>
		<?php echo $form->error($model,'payed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'set_date'); ?>
		<?php $this->widget( 'ext.EJuiTimePicker.EJuiTimePicker', array(
				'model' => $model, 
				'attribute' => 'set_date',
				)); 
		?>
		<?php echo $form->error($model,'set_date'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->