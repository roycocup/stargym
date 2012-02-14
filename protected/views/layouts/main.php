<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/form.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/custom.css" />
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>-->
	
	<!--<?php
		Yii::app()->clientScript->registerScript('mainmenu', "
			$('#mainmenu>li>ul').hide();
			$('#mainmenu>li').mouseover(function(){
				$(this).siblings().find('ul:visible').slideUp(500);
				$(this).find('ul:hidden').slideDown(500);
			});
		", CClientScript::POS_END);
	?>-->
	
	<?php Yii::app()->clientScript->registerScriptFile('/static/js/mainmenu.js',CClientScript::POS_END);?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<ul>
			<li><a href="/site/index">Home</a></li>
			<?php if (!Yii::app()->user->isGuest): ?><li class="mm_item"><a href="/members">Members</a></li><?php endif; ?>
			<?php if (!Yii::app()->user->isGuest): ?><li class="mm_item"><a href="/teachers">Teachers</a></li><?php endif; ?>
			<?php if (!Yii::app()->user->isGuest): ?><li id="mm_wages"><a href="#">Wages</a>
				<ul id="wages_sub1">
					<?php if (!Yii::app()->user->isGuest): ?><li><a href="/wages/create">Pay Wage</a></li><?php endif; ?>
					<?php if (!Yii::app()->user->isGuest): ?><li><a href="/wages/comingup">Wages coming up</a></li><?php endif; ?>
				</ul>
			</li><?php endif; ?>
			<?php if (!Yii::app()->user->isGuest): ?><li id="mm_payments"><a href="#">Payments</a>
				<ul id="payments_sub1">
					<?php if (!Yii::app()->user->isGuest): ?><li><a href="/payments/late">Late Payments</a></li><?php endif; ?>
					<?php if (!Yii::app()->user->isGuest): ?><li><a href="/payments/create">New Payment</a></li><?php endif; ?>
				</ul>
			</li><?php endif; ?>
			<?php if (Yii::app()->user->isGuest): ?><li class="mm_item"><a href="/site/login">Login</a></li><?php endif; ?>
			<?php if (!Yii::app()->user->isGuest): ?><li class="mm_item"><a href="/site/logout">Logout<?php echo ' ('.Yii::app()->user->name.')'; ?></a></li><?php endif; ?>
		</ul>
	</div><!-- mainmenu -->
	
	
	
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <a href="www.rodderscode.co.uk">Rodderscode</a>.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
