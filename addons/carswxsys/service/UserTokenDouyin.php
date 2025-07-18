<?php

namespace addons\carswxsys\service;

use addons\carswxsys\lib\enum\ScopeEnum;
use addons\carswxsys\lib\exception\TokenException;
use addons\carswxsys\lib\exception\WeChatException;
use addons\carswxsys\model\User;
use addons\carswxsys\service\Curl as CurlService;
use think\Exception;


/**
 * 微信登录
 */
class UserTokenDouyin extends Token
{
    protected $code;
    protected $nickname;
    protected $avatar;
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $curlService;


    function __construct($code, $nickname, $avatar)
    {
        $this->code = $code;
        $this->nickname = $nickname;
        $this->avatar = $avatar;
        $config = get_addon_config('carswxsys');
        $this->wxAppID = $config['douyinappid'];
        $this->wxAppSecret = $config['douyinappsecret'];
        $login_url = "https://developer.toutiao.com/api/apps/v2/jscode2session";
        $this->curlService = new CurlService();
//        $this->wxLoginUrl = sprintf($login_url, $this->wxAppID, $this->wxAppSecret, $this->code);
        $this->wxLoginUrl = $login_url;
    }


    /**
     * 登陆
     */
    public function get()
    {
        $result = $this->curlService->curl_post($this->wxLoginUrl, [
            'appid'=>$this->wxAppID,
            'secret'=>$this->wxAppSecret,
            'code'=>$this->code,
            'anonymous_code'=>''
        ]);

        file_put_contents(__DIR__.'/login.log', date('Y-m-d H:i:s').'res'.json_encode(array($this->code, $this->wxAppID, $result)).PHP_EOL, FILE_APPEND);

        // 注意json_decode的第一个参数true
        // 这将使字符串被转化为数组而非对象

        $wxResult = json_decode($result, true);


        file_put_contents(__DIR__.'/login.log', date('Y-m-d H:i:s').'request'.json_encode(array($wxResult)).PHP_EOL, FILE_APPEND);

        if (empty($wxResult)) {
            // 为什么以empty判断是否错误，这是根据微信返回
            // 规则摸索出来的
            // 这种情况通常是由于传入不合法的code
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        } else {
            // 建议用明确的变量来表示是否成功
            // 微信服务器并不会将错误标记为400，无论成功还是失败都标记成200
            // 这样非常不好判断，只能使用errcode是否存在来判断
            // $loginFail = array_key_exists('err_no', $wxResult);


            if (!empty($wxResult['err_no'])) {


                //   $this->processLoginError($wxResult);

                return false;

            } else {
                $data = $wxResult['data'];
                return $this->grantToken($data);
            }
        }
    }


    // 判断是否重复获取

    private function grantToken($wxResult)
    {

        $openid = $wxResult['openid'];

        $session_key = $wxResult['session_key'];


        cache('session_key', $session_key, 7200);
        $user = User::getByOpenID($openid);
        if (!$user)
            // 借助微信的openid作为用户标识
            // 但在系统中的相关查询还是使用自己的uid
        {
            $uid = $this->newUser($openid, $this->nickname, $this->avatar);
        } else {
            $uid = $user->id;
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    // 处理微信登陆异常
    // 那些异常应该返回客户端，那些异常不应该返回客户端
    // 需要认真思考

    private function newUser($openid, $nickname = '', $avatar = '')
    {

        $user = User::create(['openid' => $openid, 'nickname'=>$nickname, 'avatarUrl'=>$avatar]);


        return $user->id;
    }

    // 写入缓存

    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }

    // 颁发令牌

    private function saveToCache($wxResult)
    {
        $key = self::generateToken($wxResult);
        $value = json_encode($wxResult);
        $expire_in = 7200;
        $result = cache($key, $value, $expire_in);

        if (!$result) {
            throw new TokenException(['msg' => '服务器缓存异常', 'errorCode' => 10005]);
        }
        return $key;
    }

    private function duplicateFetch()
    {
        //TODO:目前无法简单的判断是否重复获取，还是需要去微信服务器去openid
        //TODO: 这有可能导致失效行为
    }

    // 创建新用户

    private function processLoginError($wxResult)
    {


        throw new WeChatException(['msg' => $wxResult['errmsg'], 'errorCode' => $wxResult['errcode']]);
    }
}
