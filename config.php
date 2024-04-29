<?php
/**
 * 首页视频链接加密密钥(防止get请求获取到真实播放地址)
 * 密钥只支持16位，否则会报错
 */
$video_key = "A42EAC0C2B408472";//密钥只支持16位，否则会报错

$arrAes = [
"str_y" => generateRandStr(16),
];

/**
 * 后台登陆的账号和密码
 * 可用参数说明 - >
 * - admin_user 用户名
 * - admin_pwd 登陆密码
 */
$conf=[
	"admin_user" => "admin",
	"admin_pwd" => "123456",
];

/**
 * 官方解析接口模式
 * 可用参数说明 - >
 * - title 接口名称
 * - url 接口地址 (解析接口,支持自定义对接)
 * - referrer 来路设置 [default默认 : "Origin" | no-referrer匹配模式 | never匹配模式]
 * - 可添加多个json接口随时可切换使用
 */
$parsing = [
        [
        "title" => "官方解析接口一",
        "url" => "http://v.frpkj.com/jx/?url=",     //此接口为您后台自动生成接口url后面填自己的json
        "referrer" => "no-referrer",
        ],[
        "title" => "自定义解析接口二",
        "url" => "https://jx.xmflv.com/?url=",      //url后面填自己的json
        "referrer" => "no-referrer",
        ],[
        "title" => "自定义解析接口三",
        "url" => "https://jx.jsonplayer.com/player/?url=",       //url后面填自己的json
        "referrer" => "no-referrer",
        ],[
        "title" => "蓝光切片一",
        "url" => "https://z1.m1907.top/?jx=",     //url后面填自己的json
        "referrer" => "no-referrer",
        ],[
        "title" => "蓝光切片二",
        "url" => "https://www.playm3u8.cn/jiexi.php?url=",            //url后面填自己的json
        "referrer" => "no-referrer",
        ]
    ];
/**
 * 备用解析接口模式
 * 可用参数说明 - >
 * - title 接口名称
 * - url 接口地址 (解析接口,支持自定义对接)
 * - referrer 来路设置 [default默认 : "Origin" | no-referrer匹配模式 | never匹配模式]
 */
$spare = [
        "title" => "备用解析接口",
        "url" => "",
        "referrer" => "no-referrer",
    ];
/**
 * 原生地址(指的是不靠解析器,就可以解析的地址)
 * - match 匹配规则 [可填域名以及特殊播放地址后缀，不经过解析]
 * - referrer 来路设置 [default默认 : "Origin" | no-referrer匹配模式 | never匹配模式]
 * - 多个原生地址可自行添加
 */
$nativeAddress = [
        [
            "match" => ".m3u8",
            "referrer" => "never",
        ], [
            "match" => ".mp4",
            "referrer" => "never",
        ], [
            "match" => ".flv",
            "referrer" => "never",
        ]
    ];

/**
 * curl请求
 */
    function curl($url, $type = 0, $post_data = '', $ua = '', $cookie = '', $redirect = true)
    {
        // 初始化cURL
        $curl = curl_init();
        // 设置网址
        curl_setopt($curl, CURLOPT_URL, $url);
        // 设置UA
        if (empty($ua) == false) {
            $header[] = 'Referer:' . $_SERVER["HTTP_REFERER"];;
            $header[] = 'User-Agent:' . $_SERVER['HTTP_USER_AGENT'];
        }
        // 设置Cookie
        if (empty($cookie) == false) {
            $header[] = 'Cookie:' . $cookie;
        }
        // 设置请求头
        if (empty($ua) == false or empty($cookie) == false or empty($header) == false) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        // 设置POST数据
        if ($type == 1) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }
        // 设置重定向
        if ($redirect == false) {
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        }
        //允许执行的最长秒数
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        // 过SSL验证证书
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // 将头部作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, false);
        // 设置以变量形式存储返回数据
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // 请求并存储数据
        $return = curl_exec($curl);
        // 分割头部和身体
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
            $return_header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $return_header = substr($return, 0, $return_header_size);
            $return_data = substr($return, $return_header_size);
        }
        // 关闭cURL
        curl_close($curl);
        // 返回数据
        return $return;
    }

    function generateRandStr(int $length = 32): string
    {
        $md5 = md5(uniqid(md5((string)time())) . mt_rand(10000, 9999999));
        return substr($md5, 0, $length);
    }

    return [
        "video_key"=>$video_key,
        "parsing" => $parsing,
        "spare" => $spare,
        "conf" => $conf,
        "nativeAddress" => $nativeAddress,
        "arrAes"=> $arrAes,
    ];
$fun =  new Common();
echo $fun->init($_GET['url'],$conf); 	