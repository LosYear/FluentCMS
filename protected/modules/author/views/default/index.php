<?php
/* @var $this DefaultController */
$this->breadcrumbs=array(
	$this->module->id,
);
$this->renderPartial('sidebar', array('menu'=>$this->menu));
?>
<div id="main">
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>
</div>