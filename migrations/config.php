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
			'class' => \humhub\modules\dashboard\widgets\Sidebar::className(),
			'event' => \humhub\modules\dashboard\widgets\Sidebar::EVENT_INIT,
			'callback' => [ 'humhub\modules\certified\Events', 'onCertifiedSidebarInit'],
		],
	],
];


