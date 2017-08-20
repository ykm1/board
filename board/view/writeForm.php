<?php
if(session_status()!=PHP_SESSION_ACTIVE){
	session_start();
}
?>
<html>
<head>
</head>
<body>
<h3>글 쓰기</h3>
<a href='/web1/board/index.php?action=list'>글목록으로 돌아가기</a><br>
<form action='/web1/board/index.php?action=add' method="post">
<table border=1>
<tr>
<th>작성자</th><td><input type="text" name="writer" value="<?php print $_SESSION['id']?>" readonly></td>
</tr>
<tr>
<th>카테고리</th>
<td>
<select name="cate">
<?php 
foreach ($this->category as $c){
	print "<option value=".$c->getId().">".$c->getName()."</option>";
}
?>
</select>
</td>
</tr>

<tr>
<th>제목</th><td><input type="text" name="title"></td>
</tr>

<tr>
<th>내용</th><td><textarea name="content" cols="40" rows="10"></textarea></td>
</tr>

<tr>
<td colspan="2"><input type="submit" value="저장하기"></td>
</tr>
</table>
<input type="hidden" name="parent" value="0">
</form>
</body>
</html>