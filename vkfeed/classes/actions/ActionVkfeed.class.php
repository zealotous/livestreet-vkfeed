<?php
/*---------------------------------------------------------------------------------------
 *	author: Artemev Yurii
 *	livestreet version: 0.4
 *	plugin: vkfeed
 *	version: 1.2
 *	author site: http://artemeff.ru/
 *--------------------------------------------------------------------------------------*/

class PluginVkfeed_ActionVkfeed extends ActionPlugin {
	/**
	 * Протектеды
	 */
	protected $oUserCurrent=null;
	/**
	 * Инициализация
	 */
	public function Init() {
		$this->SetDefaultEvent('admin');
		$this->oUserCurrent=$this->User_GetUserCurrent();
		/**
		 * Если ты не админ, на тебе 404
		 */
		if (!($this->oUserCurrent and $this->oUserCurrent->isAdministrator()))
			return parent::EventNotFound();
	}
	/**
	 * Регистрация эвентов
	 */
	protected function RegisterEvent() {
		$this->AddEvent('admin','EventAdmin');
	}
	/**
	 * Реализация экшена
	 */
	public function EventAdmin() {
		/**
		 * Получаем необходимые данные из конфигов
		 */
		$appId=Config::Get('plugin.vkfeed.appId');
		$appSecret=Config::Get('plugin.vkfeed.appSecret');
		$sFile=Config::Get('plugin.vkfeed.file');
		/**
		 * Если в GET-парметрах был передан ключик,
		 * то отправляем еще один запрос серверу
		 * на получение токена, и записываем его в файл
		 */
		if ($iCode=getRequest('code', null, 'get')){
			$sUrl="https://api.vkontakte.ru/oauth/access_token?client_id={$appId}&client_secret={$appSecret}&code={$iCode}";
			$oResponce=json_decode(file_get_contents($sUrl));
			/**
			 * Записываем токен в файл
			 */
			if ($fp=fopen($sFile, 'w')) {
				fputs($fp, $oResponce->access_token);
				fclose($fp);
				Router::Location(Config::Get('path.root.web').'/vkfeed/?b=ok');
			} else {
				die('Can\'t open file: '.$sFile);
			}
		}
		/**
		 * Если токен получен - поздравляем администратора!
		 */
		if (getRequest('b', null, 'get')=='ok')
			$this->Viewer_Assign('bOk', true);
		/**
		 * Проверка наличия файла с токеном
		 */
		if (file_exists(Config::Get('plugin.vkfeed.file')))
			$this->Viewer_Assign('bToken', true);
		/**
		 * Имя шаблона для вывода
		 */
		$this->SetTemplateAction('admin');
	}

}
?>