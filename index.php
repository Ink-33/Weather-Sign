<?php
header('Content-type: image/PNG');//设置文件头
include 'function.php';//加载include.php
$im = imagecreatefrompng('sign-40.png'); 
$weekarray=array('日','一','二','三','四','五','六'); //先定义一个数组

//获取来路IP
    //$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];//使用Cloudflare请去掉本行注释，其它CDN请查阅CDN提供商的文档
    $ip = $_SERVER['REMOTE_ADDR'];//若使用上一行配置请注释本行

//调用数统计
    $fileName = 'showcounter.txt';
    $max= 9;
    if (!is_file($fileName)) {
       touch('showcounter.txt
    ');
        $file = fopen($fileName, 'rb+');
        fwrite($file, 1);
        fclose($file);
        return ;
    } else {
        $file = fopen($fileName, 'r');
        $content = fread($file,$max);
        fclose($file);
        $file = fopen($fileName, 'w');
        $content++;
        fwrite($file, $content);
        fclose($file);
    }

//调用量输出
    $count = file_get_contents($fileName);

//获取当前url
    $url = $_SERVER['HTTP_REFERER']; //获取完整的来路URL
    $str = str_replace('https://','',$url); //去掉http://
    $strdomain = explode('/',$str);  // 以“/”分开成数组
    $wangzhi = $strdomain[0];//取第一个“/”以前的字符
    $url ='https://api.ip.sb/geoip/'.$ip; 
        $data1 = get_curl($url);
        $data = json_decode($data1, true);
        $city = $data['city'];
        $region = $data['region'];
        $country = $data['country'];
    
    //向ip接口发起查询
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE)) {
        $post = $ip;// ipv4直接向天气接口提交
        }
        else {
        $lon = $data['longitude'];
        $lat = $data['latitude'];
        $post = $lon.','.$lat;// ipv6提交经纬度
        }

//获取天气数据
    //配置
        $secret = '';//在''中填写你在和风天气申请的Appkey
        $heusername = '';//在''中填写你在和风天气申请key对应的Username
    $t = time();
    $params = array('location' => $post,'username' => $heusername,'t' => $t);
    $sign = getSignature($params, $secret);
    $allrequest = 'location='.$post.'&username='.$heusername.'&t='.$t.'&sign='.$sign;
    $weaurl = 'https://free-api.heweather.net/s6/weather/now?'.$allrequest;
    $rawdata = get_curl($weaurl);
    $weadata = json_decode($rawdata ,$assoc=true);
    $HeWeather6 = $weadata['HeWeather6'];
    $o = $HeWeather6['0'];
    $now = $o['now'];
    $tmp = $now['tmp'];
    $fl = $now['fl'];
    $tmp = $now['tmp'];
    $fl = $now['fl'];
    $cond_txt = $now['cond_txt'];
    $hum = $now['hum'];
    $wind_dir = $now['wind_dir'];
    $wind_sc = $now['wind_sc'];
    $wind_spd = $now['wind_spd'];
    $pcpn = $now['pcpn'];
    $vis = $now['vis'];
    $cloud = $now['cloud'];

//定义颜色
    $black = ImageColorAllocate($im, 0,0,0);//定义黑色的值
    $red = ImageColorAllocate($im, 255,0,0);//红色
    $aqua = ImageColorAllocate($im, 1,184,255);//水色
    $muse = ImageColorAllocate($im, 233, 80, 175);//缪色
    $fav = ImageColorAllocate($im, 0,150,255);//好康的
    $font = 'yydzst.ttf';//加载字体

//输出
    imagettftext($im, 17, 0, 10, 35, $muse, $font,'来自'.$country.''.$region.''.$city.'的朋友');
    imagettftext($im, 16, 0, 10, 72, $muse, $font, '今天是'.date('Y年n月j日').' 星期'.$weekarray[date('w')]);//当前时间添加到图片
    imagettftext($im, 16, 0, 10, 104, $muse, $font,'气温'.$tmp.'℃，体感温度'.$fl.'℃，相对湿度'.$hum.'%');
    imagettftext($im, 16, 0, 10, 140, $muse, $font,'风向'.$wind_sc.'，风力'.$wind_sc.'，风速'.$wind_spd.'km/h');
    imagettftext($im, 16, 0, 10, 175, $muse, $font,'降水量'.$pcpn.'，能见度'.$vis.'km，云量'.$cloud);
    imagettftext($im, 14, 0, 10, 205, $fav, $font,'感谢访问'.$wangzhi.',签名已被调用'.$count.'次'); 
    ImageGif($im);
    ImageDestroy($im);
?>