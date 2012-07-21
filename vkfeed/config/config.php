<?php
/*---------------------------------------------------------------------------------------
 *	author: Artemev Yurii
 *	livestreet version: 0.4
 *	plugin: vkfeed
 *	version: 1.2
 *	author site: http://artemeff.ru/
 *--------------------------------------------------------------------------------------*/

$config=array();

/**
 * Тип отправки сообщений
 * vote - при голосовании за топик
 * add - при добавлении топика
 *
 * При типе vote, настройте параметр vote_rating!
 */
$config['type'] = 'vote';
$config['vote_rating'] = '___module.blog.index_good___'; // Рейтинг, при котором отправляется сообщение на стенку, по умолчанию равен рейтингу попадания топика на главную

$config['wall'] = '-123456'; // ID пользователя или группы. ID группы начинается со знака -, например '-123'. ID пользователя пишется без всяких знаков, просто '456'
$config['from_group'] = 1; // Публиковать от имени группы?

/**
 * Логирование запросов к API
 */
$config['log'] = true;
$config['log_file'] = '___path.root.server___/logs/vkfeed.log';

/**
 * Шаблон для публикации на стенку
 *
 * %topic_title%	- заголовок топика
 * %topic_text%	- текст топика
 * %topic_date%	- дата публикации
 * %author%			- автор топика
 * %blog_title%	- название блога, в котором опубликован топик
 */
$config['pattern'] = '%blog_title% / %topic_title% / %author% / %topic_text%';
/**
 * Дополнения к шаблонам
 */
$config['date_format'] = 'H:i d.m.Y'; // Формат даты при использовании в шаблоне %topic_date%

$config['appId'] = 'xxxxxxx'; // Application ID
$config['appSecret'] = 'xxxxxxxxxxxx'; // Security key

$config['file'] = '___sys.cache.dir___vkfeed_token.txt'; // Путь до файла с токеном

/**
 *	Служебные настройки
 */
Config::Set('router.page.vkfeed', 'PluginVkfeed_ActionVkfeed');

return $config;

?>