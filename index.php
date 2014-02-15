<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Flappy Bird 成绩生成器，数字太大没人信 =.=!</title>
    <style>
        html, body{
            margin  :0;
            padding :0;
        }
    </style>
</head>

<body style="width:320px;">
<?php
if (!empty($_POST['sub'])) {
    $txt = $_POST['con'];
} else {
    $txt = "102";
}
$filename = './' . $txt . '.jpg';

if (file_exists($filename) == false) {

    $im = imagecreatefromjpeg("./img/bg.jpg");

    if ($txt >= 10 && $txt < 20) {
        $medal = imagecreatefromjpeg("./img/bronze.jpg");
        imagecopy($im, $medal, 126, 384, 0, 0, 99, 102);
        imagedestroy($medal);
    } elseif ($txt >= 20 && $txt < 30) {
        $medal = imagecreatefromjpeg("./img/silver.jpg");
        imagecopy($im, $medal, 126, 384, 0, 0, 99, 102);
        imagedestroy($medal);
    } elseif ($txt >= 30 && $txt < 40) {
        $medal = imagecreatefromjpeg("./img/gold.jpg");
        imagecopy($im, $medal, 126, 384, 0, 0, 99, 102);
        imagedestroy($medal);
    } elseif ($txt >= 40) {
        $medal = imagecreatefromjpeg("./img/platinum.jpg");
        imagecopy($im, $medal, 126, 384, 0, 0, 99, 102);
        imagedestroy($medal);
    }

    for ($i = 1; $i <= strlen($txt); $i++) {
        $txt0 = substr($txt, -$i, 1);
        if ($txt0 == 1) {
            score($txt0, 504 - (($i - 1) * 35), $im);
        } else {
            score($txt0, 494 - (($i - 1) * 35), $im);
        }

    }

    imagejpeg($im, $txt . ".jpg");
    imagedestroy($im);

}

function score($t, $x, $im)
{
    $color = imagecolorallocate($im, 254, 254, 254);
    $color2 = imagecolorallocate($im, 2, 2, 2);
    $size = 36;
    $font = "./04B_19__.TTF";
    $y = 408;
    $yy = 93;
    $z = 3;
    imagettftext($im, $size, 0, $x - $z, $y - $z, $color2, $font, $t);
    imagettftext($im, $size, 0, $x + $z, $y - $z, $color2, $font, $t);
    imagettftext($im, $size, 0, $x - $z, $y + $z, $color2, $font, $t);
    imagettftext($im, $size, 0, $x + $z, $y + $z, $color2, $font, $t);
    imagettftext($im, $size, 0, $x, $y, $color, $font, $t);

    imagettftext($im, $size, 0, $x - $z, $y - $z + $yy, $color2, $font, $t);
    imagettftext($im, $size, 0, $x + $z, $y - $z + $yy, $color2, $font, $t);
    imagettftext($im, $size, 0, $x - $z, $y + $z + $yy, $color2, $font, $t);
    imagettftext($im, $size, 0, $x + $z, $y + $z + $yy, $color2, $font, $t);
    imagettftext($im, $size, 0, $x, $y + $yy, $color, $font, $t);
}
?>

<form action="" method="post" style="padding:8px 0 0 8px;">
    请输入数字(数字太大没人信 =.=!)：<input type="number" name="con"> <input type="submit" name="sub" value=">生成<">
    <button type="button" id="share">分享！</button>
</form>
<img src="<?php echo $txt . ".jpg"; ?>" style="width:100%;">

<script type="text/javascript" src="http://openapi.baidu.com/widget/social/1.0/share.js"></script>
<script type="text/javascript">
    var config = {
        "afterRender": function () {
            //your code
        },
        "client_id"  : "Hp0uI5gp0BuS3i88PHGpU5XZ",
        "dom_id"     : "share",
        "content"    : "颤抖吧！！！挑战我吧！！！",
        "theme"      : "native",
        "u"          : encodeURIComponent("http://bird.misuisui.com/"),
        "url"        : encodeURIComponent("http://bird.misuisui.com/"),
        "pic_url"    : encodeURIComponent("http://bird.misuisui.com/<?php echo $txt . ".jpg"; ?>")
    };
    baidu.socShare.init(config);
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-53081-6', 'misuisui.com');
    ga('send', 'pageview');

</script>
</body>
</html>
