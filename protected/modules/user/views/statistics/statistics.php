<div class="page-header">
  <h1><?php echo Yii::t('admin', 'Users') ?> <small><?php echo Yii::t('admin', 'Statistics') ?></small></h1>
</div>
<?php
$this->breadcrumbs = array(
    Yum::t('Users') => array('index'),
    Yum::t('Statistics'));

Yum::register('statistics.css');


echo '<table class="statistics table table-striped">';
$f = '<tr><td>%s</td><td> <span class="badge %s"> %s</span></td></tr>';
printf($f, Yum::t('Total users'),'badge-info', $total_users);
printf($f, Yum::t('Active users'), 'badge-success', $active_users);
printf($f, Yum::t('New users registered today'), 'badge-important', $todays_registered_users);
printf($f, Yum::t('Inactive users'), '', $inactive_users);
printf($f, Yum::t('Banned users'), 'badge-inverse', $banned_users);
printf($f, Yum::t('Admin users'), 'badge-warning', $admin_users);
printf($f, Yum::t('Different users logged in today'), 'badge-info', $logins_today);
echo '</table>';
?>
