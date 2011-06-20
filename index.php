<?php
/*
首先进行数据库连接
*/
$mysql = new SaeMysql();
$sql="select * from `files`";
$data = $mysql->getData( $sql );
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>08621班 大三期末复习资料汇总</title>
<style>
html{
background:silver;
}
table{
padding:0em;
background-color:#FFEE88;
}
form td:nth-child(2n+1){
text-align:right;
}
td:nth-child(2n){
text-align:left;
}
#filelist tr:nth-child(2n){
background-color:#00AAEE;
}
#filelist{
font-size:1.55em;
margin:1em;
display:inline-block;
float:left;
}
fieldset{
margin:2em;
display:inline-block;
}

#desc{
font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
min-height: 7em; min-width: 16em; max-width:36em;
background-color:rgb(256,256,256);

border:0.1em solid rgb(200,200,200);

line-height:2em;
text-indent:2em;
padding:1em;
margin:0em;
}
[type~=file],[value="上传"]{float:right;padding:1em;background-color:#88FFAA;border-radius:8px;}
</style>
		<script><!-- 内容提交的时候首先执行下面一段代码对comment内容进行赋值，然后上传。 -->
			function formUpdate(){
				var desc = document.getElementById("desc");
				document.uploadform.filedesc.value=desc.innerHTML;
			}
		</script>
</head>
<body>
<fieldset>
<legend>文件列表：</legend>
	<div id="filelist">
		<table>
			<tr><td>文件名</td><td>文件大小</td><td>描述</td></tr>
<?php
	foreach($data as $row){
		echo "\t\t\t<tr><td><a href=\"".$row['fpath']."\">".$row['fdispname']."</a></td><td>".$row['fsize']."</td><td>".$row['fdesc']."</td></tr>\n";
	}
	echo "</div>";
?>		</table>
	</div>
</fieldset>

<fieldset>
<legend>上传新文件：</legend>
<form enctype="multipart/form-data" name="uploadform" action="upload.php" method="post" onsubmit="return formUpdate();"> 
	<table>
		<tr><td><label for="chinesename" title="使用中文名称">文件显示名称：</label></td>
			<td><input id="chinesename" name="filedispname" type="text" /></td></tr>
		<tr><td><label for="savename" title="英文、带扩展名">文件保存名称：</label></td>
			<td><input id="savename" name="fileshortname" type="text" /></td></tr>
		<tr><td><label title="用于说明所上传文件的信息">文件描述信息:</label></td>
			<td><div id="desc" contenteditable="true">文件描述</div></td></tr>
		<tr><td><input type="hidden" name="filedesc" value="" /></td><td><input name="myfile" type="file" /></td></tr>
		<tr><td></td><td><input type="submit" value="上传"/></td></tr>
	</table>
</form>
</fieldset>

</body>
</html>
<?php
$mysql->closeDb();
?>
