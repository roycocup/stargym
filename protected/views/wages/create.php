<?php
$this->breadcrumbs=array(
	'Wages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Wages', 'url'=>array('index')),
	array('label'=>'Manage Wages', 'url'=>array('admin')),
);
?>

<h1>Create Wages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>