<?php
$this->breadcrumbs=array(
	'Wages',
);


?>

<h1>Wages coming up</h1>

<?php 

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
 

//print_r($teachers); die;
?>
