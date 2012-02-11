<?php
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Teachers', 'url'=>array('index')),
	array('label'=>'Manage Teachers', 'url'=>array('admin')),
);
?>

<h1>Create Teachers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>