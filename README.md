# Yii 2.0 Telegram Log Target #

Yii 2.0 telegram log target, sends selected log messages to the specified telegram chats or channels

## Installation ##

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require -vv --prefer-dist airani/yii2-telegram-log
```

or add below line to the require section of composer.json file and then run `php composer.phar update -vv --prefer-dist --profile`

```
"airani/yii2-telegram-log": "*"
```

## How To Use ##

 You should set (telegram bot token)[https://core.telegram.org/bots#botfather] and chatId in your config file like below code:
```
'log' => [
    'targets' => [
        [
            'class' => 'airani\log\TelegramTarget',
            'levels' => ['error'],
            'botToken' => '123456:abcde', // bot token secret key
            'chatId' => '123456', // chat id or channel username with @ like 12345 or @channel
        ],
    ],
],
```

## Changelog ##

### 1.0 ###
* First version
