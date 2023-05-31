<?php
/**
 * Created by PhpStorm.
 * @author ding.jingfei
 * @date 2023-05-31 18:36
 */ 
namespace Pepper\Message\Controller\Inner;

use Famy\Messenger\MessengerClient;
use Pepper\Framework\Checker\StringChecker;
use Pepper\Message\Controller\BaseController;
use Pepper\Message\Lib\Interceptor;
use Pepper\Message\Lib\Tencent\Tim;


/**
 * 示例
 */
class TimController extends BaseController
{

    /**
     * 测试发送h5消息
     */
    public function sendH5MessageAction()
    {
        $sender = $this->getRequest('sender', '');
        $receiver = $this->getRequest('receiver', '');
        Interceptor::ensureNotEmpty($sender, ERROR_PARAM_IS_EMPTY, ['sender']);
        Interceptor::ensureNotEmpty($receiver, ERROR_PARAM_IS_EMPTY, ['receiver']);

        // 发送h5消息【双发】
        $extend = [
            'title'          => 'أنا في الغرفة، هيا لنلعب معًا!',   // 默认阿语
            'desc'           => 'أنا في الغرفة، هيا لنلعب معًا!',    // 默认阿语
            'url'            => 'https://dev-games.famy.ly/web/LiveRoomPetGameV2/index.html',
            'languages'      => [
                'zh' => '我在房间等你，一起来玩吧！',
                'en' => "I'll wait in the room for you to play!",
                'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
            ],
            'desc_languages' => [
                'zh' => '我在房间等你，一起来玩吧！',
                'en' => "I'll wait in the room for you to play!",
                'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
            ]
        ];
        // 8462256
        $result = MessengerClient::sendH5CustomMsgToUser($sender, $receiver, 'h5', $extend);
        var_dump($result);
        die;
    }

    /**
     * 腾讯云的IM系统通知消息
     */
    public function sendSystemMessageAction(){

        $type = $this->getRequest('type', '');
        $receiver = $this->getRequest('receiver', '');
        Interceptor::ensureNotEmpty($type, ERROR_PARAM_IS_EMPTY, ['type']);
        Interceptor::ensureNotEmpty($receiver, ERROR_PARAM_IS_EMPTY, ['receiver']);

        // 腾讯云的IM系统通知消息
        if( $type == 311 ){  //        311 文字卡片
            $extend = [
                'title' => "الغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًا",  // 默认阿语
                'desc' => 'الغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًاالغرفة، هيا لنلعب معًا--الغرفة، هيا لنلعب معًا',  // 默认阿语
                "jumpUrl" => ' kato://kato.world/goto/live?liveid=13857',
                'languages' => [        // 表示title
                    'zh' => '我在房间等你，一起来玩吧！',
                    'en' => "I'll wait in the room for you to play!",
                    'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
                ],
                'desc_languages' => [   // 表示content
                    'zh' => '我在房间等你，一起来玩吧！',
                    'en' => "I'll wait in the room for you to play!",
                    'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
                ]
            ];
        }elseif ( $type == 312){  // 312 图片卡片
            $extend = [
                'desc' => 'أنا في الغرفة، هيا لنلعب معًا!أنا في الغرفة، هيا لنلعب معًا!أنا في الغرفة، هيا لنلعب معًا!أنا في الغرفة، هيا لنلعب معًا!',    // 默认阿语
                'imageUri' => "https://pic.ntimg.cn/file/20210520/29049043_161342063109_2.jpg",
                "jumpUrl" => ' kato://kato.world/goto/live?liveid=13857',
                'languages' => [
                    'zh' => '我在房间等你，一起来玩吧！',
                    'en' => "I'll wait in the room for you to play!",
                    'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
                ]
            ];
        }elseif ($type == 313){  // 313 文本和标题
            $extend = [
                'title'   => "我是313的消息标题",
                'languages' => [
                    'zh' => '我在房间等你，一起来玩吧！',
                    'en' => "I'll wait in the room for you to play!",
                    'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
                ],
                'desc'   => "文本内容文本内容文本内容文本内容文本内容--摘要简介",
                'desc_languages' => [
                    'zh' => '我在房间等你，一起来玩吧！',
                    'en' => "I'll wait in the room for you to play!",
                    'ar' => 'أنا في الغرفة، هيا لنلعب معًا!',
                ]
            ];
        }

        $tim = MessengerClient::sendNoticeToUser('1', $receiver, $type, '【通知】', $extend, 86400);
        var_dump($tim);die;
    }

}


