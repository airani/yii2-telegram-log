<?php
namespace airani\log;

use yii\log\Target;
use yii\base\InvalidConfigException;

/**
 * Yii 2.0 Telegram Log Target
 * TelegramTarget sends selected log messages to the specified telegram chats or channels
 *
 * You should set (telegram bot token)[https://core.telegram.org/bots#botfather] and chatId in your config file like below code:
 * ```php
 * 'log' => [
 *     'targets' => [
 *         [
 *             'class' => 'airani\log\TelegramTarget',
 *             'levels' => ['error'],
 *             'botToken' => '123456:abcde', // bot token secret key
 *             'chatId' => '123456', // chat id or channel username with @ like 12345 or @channel
 *         ],
 *     ],
 * ],
 * ```
 *
 * @author Ali Irani <ali@irani.im>
 */
class TelegramTarget extends Target
{
    /**
     * (Telegram bot token)[https://core.telegram.org/bots#botfather]
     * @var string
     */
    public $botToken;

    /**
     * Destination chat id or channel username
     * @var int|string
     */
    public $chatId;

    /**
     * Check required properties
     */
    public function init()
    {
        parent::init();
        foreach (['botToken', 'chatId'] as $property) {
            if ($this->$property === null) {
                throw new InvalidConfigException(self::className() . "::\$$property property must be set");
            }
        }
    }

    /**
     * Exports log [[messages]] to a specific destination.
     * Child classes must implement this method.
     */
    public function export()
    {
        $bot = new TelegramBot(['token' => $this->botToken]);

        $messages = array_map([$this, 'formatMessage'], $this->messages);

        foreach ($messages as $message) {
            $bot->sendMessage($this->chatId, $message);
        }
    }
}
