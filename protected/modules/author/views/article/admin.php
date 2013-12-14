<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	Yii::t('AuthorModule.admin', 'Articles')=>array('admin'),
	Yii::t('AuthorModule.admin', 'Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('author', 'Create article'), 'url'=>array('create'), 'icon' => 'file black',),
);
?>

<div class="page-header">
  <h1><?php echo Yii::t('AuthorModule.admin', 'Articles') ?> <small><?php echo Yii::t('AuthorModule.admin', 'Manage') ?></small></h1>
</div>

<?php
				$issues = array();
				$issue_model = new Issue;
				$criteria = new CDbCriteria();
				$criteria->condition = '`isOpened` = 1';
				$criteria->order = '`id` DESC';
				$tmp = $issue_model->findAll($criteria);
				foreach ($tmp as $item) {
					$issues[$item->id] = $item->number . '/' . $item->year;
				}
				
				?>
<div id="main">
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'article-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        //'template'=>"{items}{pager}",
	'columns'=>array(
			/*array('header'=>Yii::t('author', 'Issue'), 'value'=>'Issue::model()->findByPk(ArticleAdv::model()->findByPk($data->id)->issue_id)->number',
			'filter' => $issues),*/
			array('name' => 'issue_id', 'value' => 'Issue::model()->findByPk($data->advanced->issue_id)->number', 'header'=>Yii::t('author', 'Issue'), 'filter' => $issues),
            array('name'=>'title', 'header'=>Yii::t('admin', 'Title')),
            array('name'=>'url', 'header'=>Yii::t('admin', 'Url')),
            array('name' => 'created', 'header' => Yii::t('admin', 'Created')),
            array(
                'name'=>'status', 
                'type'=>'html',
                'header'=>Yii::t('admin', 'Status'), 
                'value'=>'($data->status == 1) ?  "<span class=\"glyphicon glyphicon-eye-open\"/>" : "<span class=\"glyphicon glyphicon-eye-close\"/>"',
                'filter' => array(
                    '0' => Yii::t('author', 'Draft'),
                    '1' => Yii::t('author', 'Published'),
                    '2' => Yii::t('author', 'Pending'),
                    '3' => Yii::t('author', 'Awaiting correction')),

            ),
            array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 40px'),
                    'template'=>'{update}{delete}',
		),
	)
)); ?></div>