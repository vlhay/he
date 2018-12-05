<?php
header("Content-type: text/javascript");
/* ID chuyên mục */
$idcm = 55058;
/* Mục hiển thị tại trang chủ */
$idtc = 0;
/* Thumb mặc định cho tool */
$thumb = 'http://i.imgur.com/tz0DweX.jpg';
$binhtrongbk = file_get_contents("http://www.chiemtinh.com.vn/tu-vi-12-cung-hoang-dao");
$last = file_get_contents("cachechiemtinh.txt");
$list = explode('<a href="http://www.chiemtinh.com.vn', $binhtrongbk);
for ($i=111;$i>52;$i--) {
$link = explode('" title="', $list[$i]);
if (strpos($last, $link[0])<3) {
$i = 52;
$nd = file_get_contents("http://www.chiemtinh.com.vn$link[0]");
//$tags = file_get_contents("$link[0]");
preg_match('#<title>(.*?)</title>#is', $nd, $title);
//$title[1] = str_replace('- Truyện sex','',$title[1]);
$title[1] = html_entity_decode($title[1], ENT_QUOTES, 'UTF-8');
$nd = explode('<div class="article_content">',$nd);
$nd = explode('<!--End .article_content-->',$nd[1]);
$nd = strip_tags($nd[0], '<p><strong><i><img>');
//$nd = str_replace('www.chiemtinh.com.vn','Truyensv.Ovn.Mobi',$nd);

$nd = html_entity_decode($nd, ENT_QUOTES, 'UTF-8');
//var_dump($nd);
//exit();
$content ="<h2 class=\"titleh2\"><p>$title[1], xem bói $title[1]: vận hạn, sự nghiệp, tình yêu, vận may của 12 cung hoàng đạo Bạch Dương, Kim Ngưu, Song Tử, Cự Giải, Sư Tử, Xử Nữ, Thiên Bình, Thần Nông, Nhân Mã, Ma Kết, Bảo Bình, Song Ngư.</p><p>Gieo quẻ $title[1] cho 12 cung hoàng đạo Bạch Dương, Kim Ngưu, Song Tử, Cự Giải, Sư Tử, Xử Nữ, Thiên Bình, Thần Nông, Nhân Mã, Ma Kết, Bảo Bình, Song Ngư.</p><p>Hãy cùng http://truyensv.ovn.mobi khám phá xem <a href=\"http://truyensv.ovn.mobi/box-tu-vi-hang-ngay-55058.html\"><i>tử vi hàng ngày</i></a> của 12 chòm sao $title[1] sẽ như thế nào nhé!</p></h2>";
$tags="tu vi,tu vi hang ngay,tu vi 12 cung hoang dao";
$c=curl_init();
curl_setopt($c, CURLOPT_URL, 'http://toi18.viwap.com/post');

curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_POSTFIELDS,array('title'=>$title[1],'category'=>'2','content'=>$content.$nd,'tags'=>$tags,'thumb'=>$thumb,'comment'=>'1' Của 12 Cung Hoàng Đạo','submit'=>'Đăng bài'));
$gui=curl_exec($c);
curl_close($c);
if (preg_match('#Đăng bài viết thành công#is', $gui)) {
$last = substr($last, 11, 5000);
$f = fopen('cachechiemtinh.txt', 'w+');
fwrite($f, 'binhtrongbk'.$link[0].$last);
fclose($f);
echo "document.write('A');";
} else {
echo "document.write('B');";
}
}
}

/* Powered by binhtrongbk */
?>
