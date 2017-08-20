<?php
require_once 'service.php';
require_once '../dbmember_class/service.php';

class BoardController{
	private $bservice;
	private $hservice;
	private $action;
	private $date;
	private $view;
	private $category;
	
	public function __construct($action){
		$this->bservice = new Boardservice();
		$this->hservice = new HobbyService();
		$this->action = $action;
	}
	public function run(){
		switch ($this->action){
			case "add":
				$this->add();
				return;
			case "list":
				$this->boardList();
				break;
			case "listByCategory":
				$this->listByCategory();
				break;
			case "listByWriter":
				$this->listByWriter();
				break;
			case "listByTitle":
				$this->listByTitle();
				break;
			case "detail":
				$this->detail();
				break;
			case "edit":
				$this->edit();
				return;
			case "del":
				$this->del();
				break;
			case "writeForm":
				$this->writeForm();
				break;
			case "article_json":
				$this->article_json();
				break;
		}
		require 'view/'.$this->view;
	}
	public function article_json(){
		$this->data = $this->bservice->getByNum($_REQUEST['num']);
		$this->view = "article_json.php";
	}
	public function boardList(){
		//목록 검색 결과를 $this->data에 저장
		$this->data = $this->bservice->getAll();
		$this->getCategory();
		$this->view = "list.php";
	}
	public function getCategory(){
		$this->category = $this->hservice->getAll();
	}
	public function listByCategory(){
		$this->data = $this->bservice->getByCategory($_POST['cate']);
		$this->getCategory();
		$this->view = "list.php";
	}
	public function writeForm(){
		$this->getCategory();
		$this->view = "writeForm.php";
	}
	public function add(){
		$a = new Article(0, '', $_POST['title'], $_POST['content'], $_POST['writer'], $_POST['cate']);
		$a->setParent($_POST['parent']);
		$this->bservice->addArticle($a);
		$this->action="list";
		$this->run();
	}
	public function detail(){
		$this->data = $this->bservice->getByNum($_GET['num']);
		$this->getCategory();
		$this->view = "detail.php";
	}
	public function edit(){
		$a = new Article($_POST['num'], '', $_POST['title'], $_POST['content'], '', $_POST['cate']);
		$this->bservice->editArticle($a);
		$this->action="list";
		$this->run();
	}
	public function del(){
		$this->bservice->delArticle($_GET['num']);
		$this->action="list";
		$this->run();
	}
	public function listByWriter(){
		$this->data = $this->bservice->getByWriter($_POST['writer']);
		$this->view = "searchList.php";
	}
	public function listByTitle(){
		$this->data = $this->bservice->getByTitle($_POST['title']);
		$this->view = "searchList.php";
	}
}
?>