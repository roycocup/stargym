<?php
$this->breadcrumbs=array(
	'Payments',
);

$this->menu=array(
	array('label'=>'Create Payments', 'url'=>array('create')),
	array('label'=>'Manage Payments', 'url'=>array('admin')),
);
?>

<h1>Late Payers</h1>


<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_latePayers',
));
?>