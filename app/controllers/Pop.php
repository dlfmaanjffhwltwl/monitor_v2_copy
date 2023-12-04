<?php



class Pop extends Controller {
	//팝업 컨트롤러 (모니터 메뉴에서 지도를 확대했을때)
	public function monitor() {
		Request::method('GET', function(){
			$this->view('pop/popMonitor');
		});
		
	}

}