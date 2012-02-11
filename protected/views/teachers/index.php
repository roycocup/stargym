<?php
$this->breadcrumbs=array(
	'Teachers',
);

$this->menu=array(
	array('label'=>'Create Teachers', 'url'=>array('create')),
	array('label'=>'Manage Teachers', 'url'=>array('admin')),
);
?>

<h1>Teachers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
