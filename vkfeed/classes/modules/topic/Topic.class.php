<?php
/*---------------------------------------------------------------------------------------
 *	author: Artemev Yurii
 *	livestreet version: 0.4
 *	plugin: vkfeed
 *	version: 1.2
 *	author site: http://artemeff.ru/
 *--------------------------------------------------------------------------------------*/

class PluginVkfeed_ModuleTopic extends PluginVkfeed_Inherit_ModuleTopic {		

	public function AddTopic($oTopic) {
		$return=parent::AddTopic($oTopic);

		if (Config::Get('plugin.vkfeed.type')=='add') {
			/**
			 * Достаем токен
			 */
			$sFile=Config::Get('plugin.vkfeed.file');
			if (!($sAccessToken=file_get_contents($sFile))) {
				die('Can\'t open file');
			}
			/**
			 * ID стенки
			 */
			$iWallId=Config::Get('plugin.vkfeed.wall');
			/**
			 * Получаем топик (ибо из родителя этой функции передаются не все данные о топике)
			 */
			$oTopic=$this->Topic_GetTopicById($oTopic->getId());
			/**
			 * Формируем текст и ссылку
			 */
			$sText=urlencode($this->PluginVkfeed_ModuleVkfeed_GenerateText($oTopic));
			$sLink=urlencode($oTopic->getUrl());
			$bFromGroup=Config::Get('plugin.vkfeed.from_group');
			/**
			 * Формируем ссылку для запроса
			 */
			$sRequest="https://api.vkontakte.ru/method/wall.post?owner_id={$iWallId}=&access_token={$sAccessToken}&message={$sText}&attachment={$sLink}&from_group={$bFromGroup}";
			/**
			 * Отправляем
			 */
			$oResponce=file_get_contents($sRequest);
			/**
			 * Если включено логирование - записываем
			 */
			if (Config::Get('plugin.vkfeed.log'))
				$this->PluginVkfeed_ModuleVkfeed_Logger($oResponce);
		}
		
		return $return;
	}

}
?>