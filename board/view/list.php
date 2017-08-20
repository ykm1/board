<html>
<head>
<style type="text/css">
#view{position:absolute; top:200px;left:500px;}
</style>
<script type="text/javascript" src="/web1/board/view/request.js"></script>
<script type="text/javascript">
function viewArticle(num){
	var param = "num="+num;
	var uri = "/web1/board/index.php?action=article_json";
	var callback = viewArticleResult;
	request("post", uri, callback, param);
}
function viewArticleResult(){
	if(httpRequest.readyState == 4){
		if(httpRequest.status == 200){ 
			var txt = httpRequest.responseText;
			var article = eval('('+txt+')');
			var viewDiv = document.getElementById("view");
			var html = "writer:"+article.writer+"<br>";
			html += "wdate:"+article.wdate+"<br>";
			html += "title:"+article.title+"<br>";
			html += "content:"+article.content+"<br>";
			viewDiv.innerHTML = html;
		}
	}	
}
function clearArticle(){
	var viewDiv = document.getElementById("view");
	viewDiv.innerHTML = "";
}
function searchByTitle(){
	var param = "title="+search1.title.value;
	var uri = "/web1/board/index.php?action=listByTitle";
	var callback = searchByTitleResult;
	request("post", uri, callback, param);
}
function searchByTitleResult(){
	if(httpRequest.readyState == 4){
		if(httpRequest.status == 200){ 
			var txt = httpRequest.responseText;
			var arr = eval('('+txt+')');
			var html = "";
			for(i=0; i<arr.length; i++){
				html += "num:"+arr[i].num+"/";
				html += "title:<a href='/web1/board/index.php?action=detail&num="+arr[i].num+"'>"+arr[i].title+"</a>/";
				html += "writer:"+arr[i].writer+"<br>";
			}
			var listDiv = document.getElementById('searchList');
			listDiv.innerHTML = html;
		}
	}
}
function searchByWriter(){
	var param = "writer="+search2.writer.value;
	var uri = "/web1/board/index.php?action=listByWriter";
	var callback = searchByTitleResult;			//위의 searchByTitleResult()와 밑에 생성한 searchByWriterResult()의 결과가 동일하게 출력됨
	request("post", uri, callback, param);
}
</script>
</head>
<body>
<h3>글 목록</h3>
<a href='/web1/board/index.php?action=writeForm'>글쓰기</a><br>
<form action='/web1/board/index.php?action=listByCategory' method="post">
<select name="cate">
<?php
foreach ($this->category as $c){
	print "<option value=".$c->getId().">".$c->getName()."</option>";
}
?>
</select>
<input type="submit" value="카테고리별로 검색">
</form>

<table border="1">
<tr>
<th>num</th><th>title</th><th>writer</th>
</tr>
<?php 
	foreach ($this->data as $a){
		print "<tr>";
		print "<td>".$a->getNum()."</td>";
		print "<td><a href='/web1/board/index.php?action=detail&num=".$a->getNum()."' onmouseover='viewArticle(".$a->getNum().")', onmouseout='clearArticle()'>".$a->getTitle()."</a></td>";
		print "<td>".$a->getWriter()."</td>";
		print "</tr>";
	}
?>
</table>
<div id="view"></div>

<h3>제목으로 검색</h3>
<form name="search1">
<input type="text" name="title">
<input type="button" value="검색" onclick="searchByTitle()">
</form>
<h3>작성자로 검색</h3>
<form name="search2">
<input type="text" name="writer">
<input type="button" value="검색" onclick="searchByWriter()">
</form>
<div id="searchList"></div>
</body>
</html>