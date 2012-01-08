<?php
include ( '../conf.php ' );
function upload_image($imgpath)
{
	global $ccDir, $ccSite;
	$name=$imgpath["name"];
        $tmp_name=$imgpath["tmp_name"];
        $type=$imgpath["type"];
        $size=$imgpath["size"];
	$uploadimg = time()."_".$imgpath['name'];
	$image_path = $ccDir . $ccSite . '/' . 'extensions/ccgroup/images/'; 
        $uploadfile = $image_path.$uploadimg;
    
        $maxsize=500*1024;              //最大允许上许文件大小
        if($name=="")                   //文件名为空
        {
	//	echo"<script>alert('请先选择要上传的图片文件!'); 
        //	window.history.back();</script>";
		return null;
  	}
        if($type!="image/pjpeg" && $type!="image/jpeg" && $type!="image/gif")//文件类型不在指定范围
        {
 		echo"<script>alert('上传文件只可以是JPEG或GIF类型的!');
	        window.history.back();</script>";
		exit;
	}
        if($size>$maxsize)                                       //超过规定大小
        {
     		echo"<script>alert('上传文件大小不能超过500K! ');window.history.back();</script>";
     		exit;
   	}
     
    	if(move_uploaded_file($tmp_name,$uploadfile))
        	return $uploadimg;
	else if (copy($tmp_name,$uploadfile))
        	return $uploadimg;
        else
                return null;    
}
?>
