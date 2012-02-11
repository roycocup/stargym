<?php
$this->breadcrumbs=array(
	'Wages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Wages', 'url'=>array('index')),
	array('label'=>'Create Wages', 'url'=>array('create')),
	array('label'=>'View Wages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Wages', 'url'=>array('admin')),
);
?>

<h1>Update Wages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>