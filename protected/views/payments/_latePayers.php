
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nickname')); ?>:</b>
	<?php echo CHtml::encode($data->nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('next_payment_date')); ?>:</b>
	<?php 
		$date = 'Not set yet';
		if (!empty($data->next_payment_date)){
			$d = new DateTime($data->next_payment_date);
			$date = $d->format('d M Y');
		}  
	?>
	<?php echo CHtml::encode($date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('picture_id')); ?>:</b>
	<?php echo CHtml::encode($data->picture_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_payment_id')); ?>:</b>
	<?php echo CHtml::encode($data->last_payment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_payment_id')); ?>:</b>
	<?php echo CHtml::encode($data->next_payment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>