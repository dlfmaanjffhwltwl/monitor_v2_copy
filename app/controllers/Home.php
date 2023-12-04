<?php


class Home extends Controller {
	//모니터(메인) 메뉴 화면 컨트롤러
	public function index() {
		Request::method('GET', function(){
			$this->view('home/index');
		});
		
	}
}