<?php
/*---------------------------------------------------------------------------------------
 *	author: Artemev Yurii
 *	livestreet version: 0.4
 *	plugin: vkfeed
 *	version: 1.2
 *	author site: http://artemeff.ru/
 *--------------------------------------------------------------------------------------*/

class PluginVkfeed_ModuleVkfeed extends Module {		

	/**
	 * Инициализация
	 *
	 */
	public function Init() {		
		return true;
	}
	
	/**
	 * Логирование запросов к API
	 */
	public function Logger($sResult) {
		$sFilename=Config::Get('plugin.vkfeed.log_file');

		if ($oFile=fopen($sFilename, 'a')) {
			fputs($oFile, $sResult);
			fclose($oFile);
		}
	}
	/**
	 * Функция формирования текста
	 */
	public function GenerateText($oTopic) {
		/**
		 * Получаем паттерн
		 */
		$sPattern=Config::Get('plugin.vkfeed.pattern');
		/**
		 * Ищем названия в нем, для замены
		 */
		if (preg_match_all('#%(\w+)%#',$sPattern,$aMatch)) {
			foreach ($aMatch[1] as $i => $sFind) {
				$aReplace[$i]=$this->GetData($sFind, $oTopic);
				$aPattern[$i]="%{$sFind}%";
			}
			return str_replace($aPattern, $aReplace, $sPattern);
		}
		return false;
	}
	
	/**
	 * Получение информации о топике, по переданному паттерну
	 */
	protected function GetData($sRule, $oTopic) {
		switch ($sRule) {
			case 'topic_title':
				$aReturn=$oTopic->getTitle();
				break;

			case 'blog_title':
				$aReturn=$oTopic->getBlog()->getTitle();
				break;

			case 'topic_text':
				$aReturn=strip_tags($oTopic->getText());
				break;

			case 'author':
				$aReturn=$oTopic->getUser()->getLogin();
				break;
				
			case 'topic_date':
				$aReturn=date(Config::Get('plugin.vkfeed.date_format'), strtotime($oTopic->getDateAdd()));
				break;

			default:
    			break;
		}
		return $aReturn;
	}

}
?>