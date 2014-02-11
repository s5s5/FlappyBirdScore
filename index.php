<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>Flappy Bird 成绩生成器，1xx生成效果最好</title>
    <style>
        html,body{margin:0;padding:0;}
    </style>
</head>

<body style="width:320px;">
<?php
if(!empty($_POST['sub'])){
    $txt = $_POST['con'];
} else {
    $txt = "102";
}
$im = imagecreatefromjpeg("bg.jpg");
$color = imagecolorallocate($im, 254, 254, 254);
$color2 = imagecolorallocate($im, 2, 2, 2);
$x = 428;
$y = 412;
imagettftext($im, 46, 0, $x - 3, $y - 3, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x + 3, $y - 3, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x - 3, $y + 3, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x + 3, $y + 3, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x, $y, $color, "04B_19__.TTF", $txt);

imagettftext($im, 46, 0, $x - 3, $y - 3 + 98, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x + 3, $y - 3 + 98, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x - 3, $y + 3 + 98, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x + 3, $y + 3 + 98, $color2, "04B_19__.TTF", $txt);
imagettftext($im, 46, 0, $x, $y + 98, $color, "04B_19__.TTF", $txt);
imagejpeg($im, $txt . ".jpg");
imagedestroy($im);
?>

<form action="" method="post">
    请输入数字(1xx生成效果最好)：<input type="number" name="con"> <input type="submit" name="sub" value="生成">
    <button type="button" id="share">分享！</button>
</form>
<img src="<?php echo $txt . ".jpg"; ?>" style="width:100%;">

<script type="text/javascript" src="http://openapi.baidu.com/widget/social/1.0/share.js"> </script>
<script type="text/javascript">
    var config = {
        "afterRender":function(){
            //your code
        },
        "client_id":"Hp0uI5gp0BuS3i88PHGpU5XZ",
        "dom_id":"share",
        "content":"颤抖吧！！！挑战我吧！！！",
        "theme":"native",
        "u":encodeURIComponent("http://bird.misuisui.com/"),
        "url":encodeURIComponent("http://bird.misuisui.com/"),
        "pic_url":encodeURIComponent("http://bird.misuisui.com/<?php echo $txt . ".jpg"; ?>")
    };
    baidu.socShare.init(config);
</script>
</body>
</html>
