<?php
class Article {
	private $num;
	private $wdate;
	private $title;
	private $content;
	private $writer;
	private $category;
	private $parent;	//부모 글의 번호를 저장. 현재 글이 루트 글이면 0
	private $reps;		//현재 글의 댓글들을 저장할 배열
	
	public function __construct($num, $wdate, $title, $content, $writer, $category) {
		$this->num= $num;
		$this->wdate = $wdate;
		$this->title = $title;
		$this->content= $content;
		$this->writer= $writer;
		$this->category= $category;
	}
	public function setParent($parent){
		$this->parent = $parent;
	}
	public function getParent(){
		return $this->parent;
	}
	public function setReps($arr){
		$this->reps = $arr;
	}
	public function getReps(){
		return $this->reps;
	}
	public function setNum($num) {
		$this->num = $num;
	}
	public function getNum() {
		return $this->num;
	}
	public function setWdate($wdate) {
		$this->wdate = $wdate;
	}
	public function getWdate() {
		return $this->wdate;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setContent($content) {
		$this->content = $content;
	}
	public function getContent() {
		return $this->content;
	}
	public function setWriter($writer) {
		$this->writer = $writer;
	}
	public function getWriter() {
		return $this->writer;
	}
	public function setCategory($category) {
		$this->category = $category;
	}
	public function getCategory() {
		return $this->category;
	}
	public function __toString() { 			// 객체를 설명하는 메소드
		return "num:" . $this->num . ", wdate:" . $this->wdate . ", title:" . $this->title . ", content:" . $this->content . ", writer:" . $this->writer . ", category:" . $this->category . "<br>";
	}
}

// $a = new Article(1, '2017', 'title2', 'content2', 'bbb', 4);
// print $a;
?>