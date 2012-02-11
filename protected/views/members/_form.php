<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'members-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'nickname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Date of Birth'); ?>
		<?php 
			$timers = TimeHelper::getExtendedTimePicker();
		?>
		<?php 
			$day_selected	= str_replace('0', '',date('d',strtotime($model->dob)));
			$month_selected = str_replace('0', '',date('m',strtotime($model->dob)));
			$year_selected	= date('Y',strtotime($model->dob));
		?>
		<?php echo CHtml::dropDownList('Members[dob_day]',($day_selected)?$day_selected:'*',$timers['days']); ?>
		<?php echo CHtml::dropDownList('Members[dob_month]',($month_selected)?$month_selected:'*',$timers['months']); ?>
		<?php echo CHtml::dropDownList('Members[dob_year]',($year_selected)?$year_selected:1990,$timers['years']); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->