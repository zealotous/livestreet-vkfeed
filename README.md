vkfeed
======

Crosspost from livestreet cms to vk.com user or group wall

Before Start
=============

Check if web server where installed livestreet cms can access to https://api.vk.com:

    # cmd.exe or bash
    ping api.vk.com
    telnet api.vk.com:443
  
And function `get_file_contents` works with http, https uris:

    # get_contens.php
    <?php
      eco file_get_contents('http://ya.ru');

Create Standalone aka Desktop application http://vk.com/editapp?act=create you will need only appId

Very Quick Install
==================
1. install vkfeed
2. put in url your appId
  https://api.vk.com/oauth/authorize?client_id={$appId}&scope=wall,offline&redirect_uri=http%3A//oauth.vk.com/blank.html&response_type=token
3. go to edited url
4. allow access to the wall
5. when redirected to oauth.vk.com/blank.html#access_token=blabalb...
  copy access_token from url and put it to {$livestreet_dir}/tmp/vkfeed_token.txt file
  # !!! don't forget remove line end char
6. Create Your post and it will apear on the wall.

Quick Install
=============

1. copy vkfeed folder to {$livestreet_dir}/plugins/
2. edit vkfeed/config/config.php file
    
    #vkfeed/cofig/config.php
    $config['appId'] = 'YOURAPPID';
    $config['wall'] = '-GROUPID';

3. login on you livestreet site, go to admin and activate vkfeed plugin
4. go to vkfeed settings "http://[yoursite]/vkfeed/", then click link "Авторизоваться"
5. allow access to the wall
6. when redirected to oauth.vk.com/blank.html#access_token=blabalb...
  copy access_token from url and put it to {$livestreet_dir}/tmp/vkfeed_token.txt file
  # !!! don't forget remove line end char
7. Create Your post and it will apear on the wall.