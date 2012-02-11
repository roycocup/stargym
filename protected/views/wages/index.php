<?php
$this->breadcrumbs=array(
	'Wages',
);

$this->menu=array(
	array('label'=>'Create Wages', 'url'=>array('create')),
	array('label'=>'Manage Wages', 'url'=>array('admin')),
);
?>

<h1>Wages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
