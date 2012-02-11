<?php
$this->breadcrumbs=array(
	'Members',
);

$this->menu=array(
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h1>Members</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>


<?php
/*
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	//'class'=>'CButtonColumn',
	'columns'=>array(
		'nickname', 
		'first_name', 
		'last_name',
		'email',
		'next_payment_date',
		array(
			'name'=>'Date of Birth',
			'value'=>'date("d M Y", strtotime($data->dob))',
		),
		
	),
));
 */

?>
