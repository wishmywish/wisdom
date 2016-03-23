<?php
/**
 * php socket模拟post\get请求
 */
function sock_post($url, $post, $str = '') {
    if(!($socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP ))) return '-2000';
	// option seting
	$rcvtime ['sec'] = 3;
	$rcvtime ['usec'] = 0;
	socket_set_option ( $socket, SOL_SOCKET, SO_RCVTIMEO, $rcvtime );
	
	if(!($connect = socket_connect ( $socket, $url, $post ))) return '-2001';
	
	// 向服务端发送数据
	$str .= "\r\n";
	$length = strlen ( $str );
	while ( true ) {
		$sent = socket_write ( $socket, $str, $length) or die ( "Write failed\n" );
		if ($sent === false) {
			break;
		}
		// Check if the entire message has been sented
		if ($sent < $length) {
			$str = substr ( $str, $sent );
			$length -= $sent;
		} else {
			break;
		}
	}
	
	// 接受服务端返回数据
	$res='';
	do{
        $buf = @socket_read($socket,4,PHP_BINARY_READ);
        $res .=$buf;
    }while($buf!='');
	if(isset($_GET['debugInfo'])){
		dump('++++++++++++++++++++++++++++++++');
		dump("socket_read error: ");
		dump($res);
		$errorcode = socket_last_error();
		dump($errorcode);
		$errormsg = socket_strerror($errorcode);
		dump($errormsg);
		dump('-------------------------------');
	}
	
	// 关闭
	socket_close ( $socket );
	return $res;
}
//返回SOCKET错误信息
function reSocketInfo($errorcode){
    switch ($errorcode){
        case '-2000':
            $eInfo = '创建SOCKET服务失败，请联系管理员';
            break;
        case '-2001':
            $eInfo = '连接SOCKET服务失败，请联系管理员';
            break;
    }
    return $eInfo;
}
