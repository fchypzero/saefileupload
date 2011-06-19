<html><?php
$s2 = new SaeStorage();
$name =$_FILES['myfile']['name'];
$fshortname = $_POST['fileshortname'];

echo $s2->upload('test',$fshortname,$_FILES['myfile']['tmp_name']);
//把用户传到SAE的（临时）文件转存到名为test的storage，保存的实际文件名为用户指定的名称

// echo $s2->getUrl("test",$name);//输出文件在storage的访问路径


echo '<br/>';
echo $s2->errmsg(); //输出storage的返回信息 


$mysql = new SaeMysql();
/*
create table files(
fid int primary key auto_increment,
fdispname char(80),
fshortname char(20),
fpath char(200),
fdesc text,
fsize char(20),
ftype char(40),
ftime datetime
);

insert into `files`
(fdispname,fshortname,fpath,fdesc,fsize,ftype,ftime)
values(
'操作系统课件','os.zip',
'http://html5sandbox-test.stor.sinaapp.com/os.zip',
'操作系统课件以及不需要掌握的问答题列表，文件比较大',
'不到10MB','application/x-zip-compressed',now()
);

*/
$fpath = $s2->getUrl("test",$name);
$sql = "INSERT  INTO `files` (fdispname,fshortname,fpath,fdesc,fsize,ftype,ftime) 
VALUES ('{$_POST['filedispname']}','{$fshortname}',
'http://html5sandbox-test.stor.sinaapp.com/{$fshortname}','{$_POST['filedesc']}',
'{$_FILES['myfile']['size']}','{$_FILES['myfile']['type']}',now())";
echo $sql;
$mysql->runSql( $sql );
if( $mysql->errno() != 0 ){
	echo "Error";
	die( "Error:" . $mysql->errmsg() );
}


?>
<meta http-equiv="refresh" content="0;url=listfiles.php">
</html>