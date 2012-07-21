{include file='header.tpl'}

{if !$bOk}
	Для работы плагина нам необходимо авторизоваться вконтакте (получить токен) от имени администратора группы/страницы:<br />
	<a href="http://api.vkontakte.ru/oauth/authorize?client_id={cfg name='plugin.vkfeed.appId'}&scope=offline,wall&redirect_uri={router page='vkfeed'}&response_type=code">Авторизоваться</a>
{else}
	Токен успешно записан, <a href="{router page='vkfeed'}">вернуться</a>.
{/if}

{if !$bToken}
	<br /><br />
	<b>Внимание!</b><br />
	Токен будет записан в файл: <b>{cfg name='plugin.vkfeed.file'}</b><br />
	У папки, в которой находится (или будет находится) токен, должны быть права 777, так-же проверьте наличие файла .htaccess в этой папке.
	Никому не давайте этот ключ!
{else}
	<br /><br />
	Токен записан в файле: <b>{cfg name='plugin.vkfeed.file'}</b>, не забывайте время от времени получать новый токен.
{/if}

{include file='footer.tpl'}