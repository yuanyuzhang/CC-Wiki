<?php 

chdir("uploads");

   $foldername=$_GET["id"];
  //echo $foldername;
$dir = './'.$foldername;

	
		//拷贝文件
		$fileArray=getFile($dir);
		
		$count=count($fileArray);
header("Content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<pics>";

 

for($i=0;$i<$count;$i++)
{
echo "<pic>";
echo $fileArray[$i];
echo "</pic>";

}
echo "</pics>";
		//获取文件列表
	function getFile($dir) {
	$fileArray[]=NULL;
	if (false != ($handle = opendir ( $dir ))) {
		$i=0;
		while ( false !== ($file = readdir ( $handle )) ) {
			//去掉"“.”、“..”以及带“.xxx”后缀的文件
			if ($file != "." && $file != ".."&&strpos($file,".")) {
				$fileArray[$i]=$file; //文件名
				if($i==100){
					break;
				}
				$i++;
			}
		}
		//关闭句柄
		closedir ( $handle );
	}
	return $fileArray;
}

//调用方法getDir("./dir")

?>