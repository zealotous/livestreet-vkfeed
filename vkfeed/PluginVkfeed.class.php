<?php
/*---------------------------------------------------------------------------------------
 *	author: Artemev Yurii
 *	livestreet version: 0.4
 *	plugin: vkfeed
 *	version: 1.2
 *	author site: http://artemeff.ru/
 *--------------------------------------------------------------------------------------*/

if (!class_exists('Plugin')) {
	die('Hacking attempt!');
}

class PluginVkfeed extends Plugin {

	public function Activate() {
		return true;
	}

	protected $aInherits=array(
		'module'=>array('ModuleTopic', 'ModuleVote')
	);

	public function Init() {
		return true;
	}

}