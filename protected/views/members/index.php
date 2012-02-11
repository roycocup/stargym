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

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
