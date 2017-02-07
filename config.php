<?php
return [
	'id' => 'certified',
	'class' => 'humhub\modules\certified\Module',
	'namespace' => 'humhub\modules\certified',
	'events' => [
		[
			'class' => \humhub\widgets\TopMenu::className(),
			'event' => \humhub\widgets\TopMenu::EVENT_INIT,
			'callback' => ['humhub\modules\certified\Events', 'onTopMenuInit'],
		],
		[
			'class' => humhub\modules\admin\widgets\AdminMenu::className(),
			'event' => humhub\modules\admin\widgets\AdminMenu::EVENT_INIT,
			'callback' => ['humhub\modules\certified\Events', 'onAdminMenuInit']
		],
	],
];
?>

