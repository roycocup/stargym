<?php
$this->breadcrumbs=array(
	'Teachers',
);

$this->menu=array(
	array('label'=>'Create Teachers', 'url'=>array('create')),
	//array('label'=>'Manage Teachers', 'url'=>array('admin')),
);
?>

<h1>Teachers</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'columns'=>array(
		'first_name', 
		'last_name',
		'email',
		'phone',
		'facebook',
		'next_wage_date',
		array(
			'class'=>'CButtonColumn',
		),
		),
));
?>
