<?php
namespace Api\Controller;
use Think\Controller;

// 常量定义
define('SUCCESS_CODE', '000000');               // JAVA接口返回成功CODE
define('SERVER_CONNECT_ERROR_CODE', '000404');  // JAVA接口连接出现异常
define('YY_JHTTP_URL', 'YYJhttpUrl');           // 配置文件中的JAVA接口根URL键

/**
 * 智慧运营平台JAVA接口调用
 *
 * @author zhoushuangsheng
 * @since  1.0 2015/08/24
 */
class YYJhttpController extends Controller
{
    /**
     * 请求JAVA接口,并处理取得的数据
     *
     * @param   array $params JAVA接口的请求参数
     * @param   array $out_arr 返回到终端的数据
     * @param   array $url JAVA接口的请求URL
     * @param   string $list_key JAVA接口返回数据中的list列表键名
     * @return  array   转换后的返回到终端的数据
     */
    public function requestData($params, $out_arr, $url, $list_key = 'list')
    {
        // 请求JAVA接口,并取得数据
        $ret = $this->curl($params, $url);
        // 判断返回结果CODE
        if ($ret['resCode'] === SUCCESS_CODE) {
            $out_arr['error_code'] = 'success';
            $out_arr['error_text'] = '';
        } else {
            $out_arr['error_code'] = $ret['resCode'];
            $out_arr['error_text'] = $ret['errorMess'];
        }

        // 设定返回结果列表
        if (array_key_exists($list_key, $ret)) {
            $out_arr['list'] = $ret[$list_key];
        }

        // 设定返回结果的其它数据
        foreach ($ret as $key => $value) {
            // 以下场合不再设定返回数据
            // 操作成功与否和响应时间数据在终端中无用,所以节省数据流量,不返回
            if ($key === 'resCode'
                || $key === 'errorMess'
                || $key === $list_key
                || $key === 'result'
                || $key === 'resTime'
            ) {
                continue;
            }
            // 返回其它数据
            $out_arr[$key] = $ret[$key];
        }
        return $out_arr;
    }

    /**
     * CURL请求JAVA接口数据
     *
     * @param   array $params JAVA接口的请求参数
     * @param   string $url JAVA接口的请求URL
     * @param   string $method JAVA接口的请求方式
     * @return  json    JAVA接口的返回数据
     */
    private function curl($params, $url = '', $method = 'POST')
    {

        $dateTime = date("ymdhis", time());
        $appVersion = "20150101";
        //ID/KEY     a0b923820dcc509a/a65782ef882ceff4
        $clientId = "a0b923820dcc509a";
        $clientKey = "a65782ef882ceff4";
        $reqToken = md5($clientId . $clientKey . $appVersion . $dateTime);
        //time、reqToken、appVersion、clientId
        //$access_token = array('time:'.$dateTime,'reqToken:'.$reqToken,'appVersion:'.$appVersion,'clientId:'.$clientId);
        $access_token = array();
        $access_token['time'] = $dateTime;
        $access_token['reqToken'] = $reqToken;
        $access_token['appVersion'] = $appVersion;
        $access_token['clientId'] = $clientId;
        // $access_token = array("Authorization"=>$access_token);
        // 头信息
        $header = array(
            'Accept:' . $this->Accept,
            'Content-Type:' . $this->Accept . ';charset=utf-8',
            'Authorization:' . json_encode($access_token),
        );
        // 读取和创建JAVA接口的URL
        $url = C(YY_JHTTP_URL) . $url;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        if (strtoupper($method) === 'POST') {
            // POST请求
            curl_setopt($ch, CURLOPT_POST, 1);
        } else {
            // 其它请求(GET,PUT,DELETE)
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // 执行并接口JAVA接口请求
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            // 服务器连接正常,返回JAVA接口请求数据
            return json_decode($result, true);
        } else {
            // 服务器连接异常,返回提示信息
            return array(
                'resCode' => SERVER_CONNECT_ERROR_CODE,
                'errorMess' => '服务器连接错误。');
        }
    }


    /**
     * CURL请求JAVA接口数据
     *
     * @param   array $params JAVA接口的请求参数
     * @param   string $url JAVA接口的请求URL
     * @param   string $method JAVA接口的请求方式
     * @return  json    JAVA接口的返回数据
     */
    public function omscurl($params, $url = '')
    {
        // 头信息
        $header = array(
            'Accept:application/json',
            'Content-Type:application/json;charset=utf-8',
        );
        // 读取和创建JAVA接口的URL
        $url = C(YYOmsUrl) . $url;
        $ch = curl_init($url);
//        echo $url;
//        echo json_encode($params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // 执行并接口JAVA接口请求
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200) {
            // 服务器连接正常,返回JAVA接口请求数据
            return json_decode($result, true);
        } else {
            // 服务器连接异常,返回提示信息
            return array(
                'resCode' => SERVER_CONNECT_ERROR_CODE,
                'errorMess' => '服务器连接错误。');
        }
    }
}