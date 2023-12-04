<div id="load">
    <div class="spinner-border text-white" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-lg-10 px-1 card-monitor">
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 fw-bold">차량위치 모니터링1</h6>
                        </div>
                        <div class="col-6 tar">
                            <i class="fas fa-expand text-white expandIcon"></i>
                        </div>
                    </div>

                </div>
                <div class="card-body p-2">
                    <div id="mapMonitor"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 px-1 card-carList">
            <div class="card shadow" style="height:665px;">
                <div class=" card-header py-3">
                    <h6 class="m-0 fw-bold">차량리스트</h6>
                </div>
                <div class="card-body">
                    <div id="carList" class="ovf-y">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tbody id="carListTableBody" class="cusor-pointer">
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary" id="testBtn">소방3호</button>
                    <button type="button" class="btn btn-primary" id="test2Btn">소방4호</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-1700-2 col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-4 card-h288 px-1 card-seat-belt">
            <div class="card border-left-warning  shadow h-100 py-2">
                <div class="text-s fw-bold mb-2 ms-2">
                    착석 및 벨트현황
                    <i class="fas fa-info-circle ml-1 cusor-pointer" data-bs-toggle="modal"
                        data-bs-target="#carInfoRegModal"></i>
                    </button>
                </div>
                <div class="card-body sm-scrollbar ovf-y">
                    <div class="row" id="seatBelt" class=""></div>
                    <div class="row" id="seatBeltMulti"></div>
                </div>
            </div>
        </div>
        <div class="col-1700-2 col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-4 card-h288 px-1 card-speed">
            <div class="card border-left-info  shadow h-100 py-2">
                <div class="text-s fw-bold mb-2 ms-2">
                    속도 정보 (km/h)</div>
                <div class="card-body sm-scrollbar ovf-y">
                    <div id="speedGauge">
                        <canvas id="speedGaugeCanvas" style="width: 220px; height: 120px;"></canvas>
                        <div id="speedGaugeText" class="preview-textfield reset" style="font-size: 24px;"></div>
                    </div>
                    <div class="row" id="speedMulti"></div>

                </div>
            </div>
        </div>
        <div class="col-1700-267 col-xxl-4 col-xl-4  mb-4 card-h288 px-1 card-car-info">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="text-s fw-bold mb-2 ms-2">
                    차량 관련 정보
                    <i class="fa-regular fa-circle-down dropdown-toggle selectDropBtn drop-icon-none"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"></i>
                    <ul class="dropdown-menu dropdown-menu-dark selectDropUl px-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="wheelCheck" checked>
                            <label class="custom-control-label" for="wheelCheck">스티어링휠 각도</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="suddenCheck" checked>
                            <label class="custom-control-label" for="suddenCheck">급제동</label>
                        </div>
                    </ul>
                </div>
                <div class="card-body sm-scrollbar ovf-y  tableFixHead">
                    <table class="table table-dark text-s infoListTable text-center" id="carInfoTable">
                        <thead class="table-active">
                            <tr>
                                <th width=20% class="order">차이름</th>
                                <th width=30% class="order">항목</th>
                                <th width=35%>값</th>
                                <th width=15%>단위</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-1700-267 col-xxl-4 col-xl-4 mb-4 card-h288 px-1 card-break">
            <div class="card border-left-success  shadow h-100 py-2">

                <div class="text-s fw-bold mb-2 ms-2 dropend">
                    제동 관련 정보
                    <i class="fa-regular fa-circle-down dropdown-toggle selectDropBtn drop-icon-none"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"></i>
                    <ul class="dropdown-menu dropdown-menu-dark selectDropUl px-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="accelCheck" checked>
                            <label class="custom-control-label" for="accelCheck">엑셀 페달</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="breakCheck" checked>
                            <label class="custom-control-label" for="breakCheck">브레이크 페달</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="frontCheck" checked>
                            <label class="custom-control-label" for="frontCheck">전방 거리 감지</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="realBreakCheck" checked>
                            <label class="custom-control-label" for="realBreakCheck">실제 브레이크</label>
                        </div>
                    </ul>
                </div>


                <div class="card-body sm-scrollbar ovf-y tableFixHead">
                    <table class="table table-dark text-s infoListTable text-center" id="breakInfoTable">
                        <thead class="table-active">
                            <tr>
                                <th width=20% class="order">차이름</th>
                                <th width=30% class="order">항목</th>
                                <th width=35%>값</th>
                                <th width=15%>단위</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-1700-267 col-xxl-4 col-xl-4 mb-4 card-h288 px-1 card-posture">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="text-s fw-bold mb-2 ms-2">
                    자세 제어 정보
                    <i class="fa-regular fa-circle-down dropdown-toggle selectDropBtn drop-icon-none"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"></i>
                    <ul class="dropdown-menu dropdown-menu-dark selectDropUl px-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="horizontalCheck" checked>
                            <label class="custom-control-label" for="horizontalCheck">횡 가속도</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="inclinationCheck"
                                checked>
                            <label class="custom-control-label" for="inclinationCheck">차량 기울기</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="insecureCheck" checked>
                            <label class="custom-control-label" for="insecureCheck">불안전 자세 감지</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input breakInput" id="inertiaCheck" checked>
                            <label class="custom-control-label" for="inertiaCheck">기타 관성</label>
                        </div>
                    </ul>
                </div>
                <div class="card-body sm-scrollbar ovf-y tableFixHead">
                    <table class="table table-dark text-s infoListTable text-center" id="postureInfoTable">
                        <thead class="table-active">
                            <tr>
                                <th width=20% class="order">차이름</th>
                                <th width=30% class="order">항목</th>
                                <th width=35%>값</th>
                                <th width=15%>단위</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- icon modal -->
<div class="modal fade" id="carInfoRegModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <table class="table table-dark table-borderless text-center seatBeltInfoTable">
                    <thead>
                        <tr>
                            <th>이미지</th>
                            <th>이미지</th>
                            <th>착석여부</th>
                            <th>벨트여부</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="./img/car-seat_off.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo1"></span></td>
                            <td class="vam">N</td>
                            <td class="vam">N</td>
                        </tr>
                        <tr>
                            <td><img src="./img/car-seat_on.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo2"></span></td>
                            <td class="vam">Y</td>
                            <td class="vam">N</td>
                        </tr>
                        <tr>
                            <td><img src="./img/car-seat_belt_off.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo3"></span></td>
                            <td class="vam">N</td>
                            <td class="vam">Y</td>
                        </tr>
                        <tr>
                            <td><img src="./img/car-seat_belt_on.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo4"></span></td>
                            <td class="vam">Y</td>
                            <td class="vam">Y</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- 카카오맵, gauge.js  라이브러리 호출 -->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=MAP_KEY?>"></script>
<script src="vendor/gauge.js/gauge.min.js"></script>

<script>
//gauge.js (속도게이지) 옵션 설정
var opts = {
    angle: 0.01, // The span of the gauge arc
    lineWidth: 0.20, // The line thickness
    radiusScale: 1, // Relative radius
    pointer: {
        length: 0.6, // // Relative to gauge radius
        strokeWidth: 0.035, // The thickness
        color: '#000000' // Fill color
    },
    limitMax: 200, // If false, max value increases automatically if value > maxValue
    limitMin: 0, // If true, the min value of the gauge will be fixed
    colorStart: '#6F6EA0', // Colors
    colorStop: '#C0C0DB', // just experiment with them
    strokeColor: '#EEEEEE', // to see which ones work best for you
    generateGradient: true,
    highDpiSupport: true, // High resolution support
    // renderTicks is Optional
    staticLabels: {
        font: "10px sans-serif", // Specifies font
        labels: [0, 20, 40, 60, 80, 100, 120, 140, 160, 180, 200], // Print labels at these values
        color: "#fff", // Optional: Label text color
        fractionDigits: 0 // Optional: Numerical precision. 0=round off.
    },
    renderTicks: {
        divisions: 10,
        divWidth: 2,
        divLength: 10,
        divColor: '#333333',
        subDivisions: 0,
        subLength: 0.5,
        subWidth: 0.6,
        subColor: '#666666'
    },
    staticZones: [{ //구간별 색상설정
            strokeStyle: "#30b32d",
            min: 0,
            max: 10
        },
        {
            strokeStyle: "#30b32d",
            min: 10,
            max: 20
        },
        {
            strokeStyle: "#30b32d",
            min: 20,
            max: 30
        },
        {
            strokeStyle: "#30b32d",
            min: 30,
            max: 40
        },
        {
            strokeStyle: "#30b32d",
            min: 40,
            max: 50
        },
        {
            strokeStyle: "#62bd20",
            min: 50,
            max: 60
        },
        {
            strokeStyle: "#89c612",
            min: 60,
            max: 70
        },
        {
            strokeStyle: "#adce02",
            min: 70,
            max: 80
        },
        {
            strokeStyle: "#d0d500",
            min: 80,
            max: 90
        },
        {
            strokeStyle: "#e1cc00",
            min: 90,
            max: 100
        },
        {
            strokeStyle: "#f1c200",
            min: 100,
            max: 110
        },
        {
            strokeStyle: "#ffb700",
            min: 110,
            max: 120
        },
        {
            strokeStyle: "#ff9a0f",
            min: 120,
            max: 130
        },
        {
            strokeStyle: "#ff7d22",
            min: 130,
            max: 140
        },
        {
            strokeStyle: "#fa5f31",
            min: 140,
            max: 150
        },
        {
            strokeStyle: "#f03e3e",
            min: 150,
            max: 160
        },
        {
            strokeStyle: "#f03e3e",
            min: 160,
            max: 170
        },
        {
            strokeStyle: "#f03e3e",
            min: 170,
            max: 180
        },
        {
            strokeStyle: "#f03e3e",
            min: 180,
            max: 190
        },
        {
            strokeStyle: "#f03e3e",
            min: 190,
            max: 200
        },
    ]
};
//기본 게이지 세팅
var target = document.getElementById('speedGaugeCanvas'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 200; // set max gauge value
gauge.setMinValue(0); // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 10; // set animation speed (32 is default value)
gauge.set(0); // set actual value
</script>

<script>
var data; //실시간 통신 sse로 부터 받은 데이터
var map; //카카오맵 객체 담는 변수
var selectcarTerminal; //차량 리스트에서 선택된 차량
var selectcarTerminalList = []; //차량 리스트에서 선택된 차량 리스트
var selectFocusTerminal = "noneFocus"; //포커스 선택된 차량
var markerList = []; //마커리스트 담는 변수
var markerMap = new Object(); //차량별 마커 담는 오브젝트 변수    
var isfirst = true; //처음 세팅하는 건지 구분하기 위한 변수
var imageSrc = '<?=URL?>/img/firefighter-car.png'; //소방차 아이콘 이미지 주소
var movePage = false; //페이지 이동하는지 확인하는 변수 (페이지 이동을 안하는대 연결이 끊겼을 경우 구분하기 위함)
var sortIndexObject = new Object(); //현재 정렬중인 인덱스 


//마커이미지 객체 생성
function markerImage() {
    var imageSize = new kakao.maps.Size(50, 35), // 마커이미지의 크기입니다
        imageOption = {
            offset: new kakao.maps.Point(25, 40)
        }; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

    // 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);
    return markerImage;

};

//마커 이동하는 함수
function markerMove(carList) {
    for (car of carList) {
        var marker = markerMap[car["Car_terminal"]];
        marker.setPosition(new kakao.maps.LatLng(car["GPS_Latitude"], car["GPS_Longitude"]));
    }
    if (selectFocusTerminal != "noneFocus") { //포커스 되면 해당 차량 따라가기
        mapCenterMove(carList, selectFocusTerminal);
    }
}

//카카오맵 시작
function mapStart() {

    var mapContainer = document.getElementById('mapMonitor'), // 지도를 표시할 div 
        currentLocation = new kakao.maps.LatLng(Number(data[0]["GPS_Latitude"]), Number(data[0]["GPS_Longitude"]));
    mapOption = {
        center: currentLocation, // 지도의 중심좌표
        level: 8 // 지도의 확대 레벨
    };
    map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
    var mapTypeControl = new kakao.maps.MapTypeControl();

    // 지도에 컨트롤을 추가해야 지도위에 표시됩니다
    // kakao.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
    map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPLEFT);

    for (var i = 0; i < data.length; i++) {
        // 마커를 생성합니다
        var position = new kakao.maps.LatLng(Number(data[i]["GPS_Latitude"]), Number(data[i]["GPS_Longitude"]));
        var marker = new kakao.maps.Marker({
            position: position,
            image: markerImage(), // 마커이미지 설정 
            map: map,
        });

        markerList.push(marker);
        markerMap[data[i]["Car_terminal"]] = marker;
        //marker.setMap(map);
        var carTerminal = data[i]["Car_terminal"];
        //마커 클릭 이벤트
        kakao.maps.event.addListener(marker, 'click', markerClick(carTerminal));
    }
    var mapImage = $("#mapMonitor").find("img");
    var cnt = 0;
    for (var i = 0; i < mapImage.length; i++) {
        var markerImageSrc = $(mapImage[i]).attr("src");
        if (markerImageSrc == imageSrc) {
            $(mapImage[i]).before('<div class="carOverlay ' + data[cnt]["Car_terminal"] + '">' + data[cnt]["Car_name"] +
                '</div>');
            cnt++;
        }
    }
    $("#load").hide();
};

//마커 클릭 이벤트 (마커 클릭하면 이름 배경이 빨간색으로 변하고 그 차량의 움직임을 따라 맵이 이동한다.)
function markerClick(carTerminal) {
    return function() {
        var carOverlay = $('.carOverlay.' + carTerminal + '');
        if (selectFocusTerminal == carTerminal) {
            $('.carOverlay.' + selectFocusTerminal + '').removeClass("carFocus");
            selectFocusTerminal = "noneFocus";
        } else {
            $('.carOverlay.' + selectFocusTerminal + '').removeClass("carFocus");
            carOverlay.addClass("carFocus");
            selectFocusTerminal = carTerminal;
        }
    };
}

//차량 여러개 선택할때 속도 정보는 막대그래프로 보이고 그에 따른 구간별 색상 처리
function speedColor(speed) {
    var result;
    if (speed >= 0 && speed <= 50) {
        result = "rgb(48, 179, 45)";
    } else if (speed > 50 && speed <= 60) {
        result = "rgb(98, 189, 32)";
    } else if (speed > 60 && speed <= 70) {
        result = "rgb(137, 198, 18)";
    } else if (speed > 70 && speed <= 80) {
        result = "rgb(173, 206, 2)";
    } else if (speed > 80 && speed <= 90) {
        result = "rgb(208, 213, 0)";
    } else if (speed > 90 && speed <= 100) {
        result = "rgb(225, 204, 0)";
    } else if (speed > 100 && speed <= 110) {
        result = "rgb(241, 194, 0)";
    } else if (speed > 110 && speed <= 120) {
        result = "rgb(255, 183, 0)";
    } else if (speed > 120 && speed <= 130) {
        result = "rgb(255, 154, 15)";
    } else if (speed > 130 && speed <= 140) {
        result = "rgb(255, 125, 34)";
    } else if (speed > 140 && speed <= 150) {
        result = "rgb(250, 95, 49)";
    } else {
        result = "rgb(240, 62, 62)";
    }
    return result;
}



//속도게이지 세팅함수
function speedSetting(carInfoList) {
    var length = carInfoList.length;
    var width = $("#speedMulti").width() - 165;
    $("#speedMulti").empty();
    if (length == 1) { //선택된 차량이 하나면 geuge.js 표시
        $("#speedGauge").removeClass("d-none");
        var speed = carInfoList[0]["MCU_SPEED"];
        gauge.set(speed);
        $("#speedGaugeText").text(speed)
    } else if (length == 0) { //선택된 차량이 없다면 '선택된 차량이 없습니다' 문구 표시
        $("#speedGauge").addClass("d-none");
        var html = '<div class="col-xl-12 mb-3 text-center">선택된 차량이 없습니다</div>';
        $("#speedMulti").append(html);
    } else { //선택된 차량이 하나 이상이면 막대그래프 표시
        $("#speedGauge").addClass("d-none");
        var html = '<table>';
        html += '<tbody>';
        var cnt = 0;
        for (car of carInfoList) {
            var color = speedColor(car["MCU_SPEED"]);
            var cal = (width * car["MCU_SPEED"]) / 200;
            html += '<tr class="space">'
            html += '<td width=72>' + car["Car_name"] + '</td>';
            html += '<td>'
            html += '<svg width=100% height=10>';
            html += '<line x1=0 y1=4 x2=' + (cal) +
                ' y2=4 stroke="' + color + '" stroke-width=100% ></line>';
            html += '</svg>';
            html += '</td>'
            html += '<td width=29>' + car["MCU_SPEED"] + '</td>';
            html += '</tr>'
        }
        html += '</tbody>';
        html += '</table>';
        $("#speedMulti").append(html);
    }

}

//맵 중앙 이동 함수
function mapCenterMove(carList, carTerminal) {
    var carInfo;
    for (car of carList) {
        if (car["Car_terminal"] == carTerminal) {
            carInfo = car;
            break;
        }
    }
    var moveLatLon = new kakao.maps.LatLng(carInfo["GPS_Latitude"], carInfo["GPS_Longitude"]);
    map.setCenter(moveLatLon);
};

//차량리스트에 차량이름 세팅
function carListSetting() {
    var html = '';
    for (var i = 0; i < data.length; i++) {
        html += '<tr class="tableRow">';
        html += '<td>';
        html += data[i]["Car_name"];
        html += '<span class="d-none carTerminalTd">';
        html += data[i]["Car_terminal"];
        html += '</span>';
        html += '</td>';
        html += '</tr>';
    }
    $("#carListTableBody").append(html);
};


//시트 이미지 테그 생성 함수
function carSeatBeltImageSrc(val) {
    var imageHtml = "";
    switch (Number(val)) {
        case 1:
            imageHtml = '<img src="./img/car-seat_off.png" class="seatImg">';
            break;
        case 2:
            imageHtml = '<img src="./img/car-seat_on.png" class="seatImg">';
            break;
        case 3:
            imageHtml = '<img src="./img/car-seat_belt_off.png" class="seatImg">';
            break;
        case 4:
            imageHtml = '<img src="./img/car-seat_belt_on.png" class="seatImg">';
            break;
        default:
            imageHtml = '<img src="./img/car-seat_off.png" class="seatImg">';
    }
    return imageHtml;
};


//착석 및 벨트 현황에 따라 표현하는 함수
function carSeatBeltSetting(carInfoList) {
    $("#seatBelt").empty();
    $("#seatBeltMulti").empty();
    $(".bs-tooltip-auto ").remove();
    var length = carInfoList.length;
    if (length == 1) { //선택된 차량이 하나면 이미지 아이콘으로 표시
        var html = '';
        html += '<div class="col-xl-12 mb-3 text-center">';
        html += carSeatBeltImageSrc(carInfoList[0]["MCU_MotToq"]);
        html += carSeatBeltImageSrc(carInfoList[0]["MCU_MotSpd"]);
        html += carSeatBeltImageSrc(carInfoList[0]["MCU_AcclPos"]);
        html += '</div>';
        html += '<div class="col-xl-12 mb-3 text-center">';
        html += carSeatBeltImageSrc(carInfoList[0]["MCU_BrkState"]);
        html += '<span class="seatEmpty"></span>';
        html += carSeatBeltImageSrc(carInfoList[0]["GPS_SA"]);
        html += '</div>';
        $("#seatBelt").append(html);
    } else if (length == 0) { //선택된 차량이 없다면 '선택된 차량이 없습니다' 문구 표시
        var html = '<div class="col-xl-12 mb-3 text-center">선택된 차량이 없습니다</div>';
        $("#seatBelt").append(html);
    } else { //선택된 차량이 여러개라면 네모 박스로 표시
        var html = '<table>';
        html += '<tbody>';
        var cnt = 0;
        for (car of carInfoList) {
            html += '<tr class="space">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>';
            html += '<span class="defaultSeatBeltNemo seatBeltNemo' + car["MCU_BrkState"] + '"';
            if (cnt == 0) {
                html += 'data-bs-toggle="tooltip" title="조수석"'
            }
            html += '></span>';
            html += '<span class="defaultSeatBeltNemo seatBeltNemo' + car["GPS_SA"] + '"';
            if (cnt == 0) {
                html += 'data-bs-toggle="tooltip" title="운전석"'
            }
            html += '></span>';
            html += '</td>';
            html += '<td>';
            html += '<span class="defaultSeatBeltNemo seatBeltNemo' + car["MCU_MotToq"] + '"';
            if (cnt == 0) {
                html += 'data-bs-toggle="tooltip" title="조수석 뒤"'
            }
            html += '></span>';
            html += '<span class="defaultSeatBeltNemo seatBeltNemo' + car["MCU_MotSpd"] + '"';
            if (cnt == 0) {
                html += 'data-bs-toggle="tooltip" title="뒷자리 중앙"'
            }
            html += '></span>';
            html += '<span class="defaultSeatBeltNemo seatBeltNemo' + car["MCU_AcclPos"] + '"';
            if (cnt == 0) {
                html += 'data-bs-toggle="tooltip" title="운전석 뒤"'
            }
            html += '></span>';
            html += '</td>';
            html += '</tr>';
            cnt++;
        }
        html += '</tbody>';
        html += '</table>';
        $("#seatBeltMulti").append(html);
        //툴팁처리 (선택된 차량이 여러개일 경우 박스 위치가 차량에 자리인지 알기 어려워 툴팁으로 자리 확인)
        var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    }

};

//차량관련 정보 세팅
function carInfoSetting(carAllList, carList = null) {
    var tbody = $(".card-car-info").find("tbody");
    if (isfirst) { //처음 세팅할 경우
        var html = '';
        var cnt = 0;
        for (car of carAllList) {
            if (cnt != 0) {
                html += '<tr class="wheel d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="wheel ' + car["Car_terminal"] + '">';
            }
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>스트어링휠 각도</td>';
            html += '<td>' + car["MCU_AcclPos"] + '</td>';
            html += '<td>deg</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="sudden d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="sudden ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>급제동</td>';
            html += '<td>' + car["GPS_Height"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';
            cnt++;
        }
        tbody.append(html);
    } else { //실시간 데이터 업데이트 할 경우
        tbody.find("tr").each(function(index, el) {
            //값세팅
            var type = $(el).attr("class");
            //var chk = false;
            for (carAll of carAllList) {
                var chk = $(el).hasClass(carAll["Car_terminal"]);
                var wheelChk = $(el).hasClass("wheel");
                var suddenChk = $(el).hasClass("sudden");
                if (chk) {
                    if (wheelChk) {
                        $(el).children().eq(2).text(carAll["MCU_AcclPos"]);
                    } else if (suddenChk) {
                        $(el).children().eq(2).text(carAll["GPS_Height"]);
                    }
                }
            }
            //쇼 하이드
            var chkSelect = false;
            for (car of carList) {
                chkSelect = $(el).hasClass(car["Car_terminal"]);
                if (chkSelect) break;
            }
            if (chkSelect) {
                $(el).removeClass("d-none");
            } else {
                $(el).addClass("d-none");
            }
        })
    }
}


//제동관련 정보 세팅
function breakInfoSetting(carAllList, carList = null) {
    var tbody = $(".card-break").find("tbody");
    if (isfirst) {
        var html = '';
        var cnt = 0;
        for (car of carAllList) {
            if (cnt != 0) {
                html += '<tr class="accel d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="accel ' + car["Car_terminal"] + '">';
            }
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>엑셀 페달</td>';
            html += '<td>' + car["MCU_AcclPos"] + '</td>';
            html += '<td>kg/m^2</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="break d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="break ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>브레이크 페달</td>';
            html += '<td>' + car["MCU_BrkState"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="front d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="front ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>전방 거리 감지</td>';
            html += '<td>' + car["MCU_VKT"] + '</td>';
            html += '<td>M</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="realBreak d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="realBreak ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>실제 브레이크</td>';
            html += '<td>' + car["MCU_BrkState"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';
            cnt++;
        }
        tbody.append(html);
    } else {
        tbody.find("tr").each(function(index, el) {
            //값세팅
            var type = $(el).attr("class");
            for (carAll of carAllList) {
                var chk = $(el).hasClass(carAll["Car_terminal"]);
                var accelChk = $(el).hasClass("accel");
                var breakChk = $(el).hasClass("break");
                var frontChk = $(el).hasClass("front");
                var realBreakChk = $(el).hasClass("realBreak");
                if (chk) {
                    if (accelChk) {
                        $(el).children().eq(2).text(carAll["MCU_AcclPos"]);
                    } else if (breakChk) {
                        $(el).children().eq(2).text(carAll["MCU_BrkState"]);
                    } else if (frontChk) {
                        $(el).children().eq(2).text(carAll["MCU_VKT"]);
                    } else if (realBreakChk) {
                        $(el).children().eq(2).text(carAll["MCU_BrkState"]);
                    }
                }
            }
            //쇼 하이드
            var chkSelect = false;
            for (car of carList) {
                chkSelect = $(el).hasClass(car["Car_terminal"]);
                if (chkSelect) break;
            }
            if (chkSelect) {
                $(el).removeClass("d-none");
            } else {
                $(el).addClass("d-none");
            }
        })
    }
}


//자세관련 정보 세팅
function postureInfoSetting(carAllList, carList = null) {
    var tbody = $(".card-posture").find("tbody");
    if (isfirst) {
        var html = '';
        var cnt = 0;
        for (car of carAllList) {
            if (cnt != 0) {
                html += '<tr class="horizontal d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="horizontal ' + car["Car_terminal"] + '">';
            }
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>횡 가속도</td>';
            html += '<td>' + car["Acc_ALA"] + '</td>';
            html += '<td>kg/m^2</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="inclination d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="inclination ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>차량 기울기</td>';
            html += '<td>' + car["Acc_YACC"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="insecure d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="insecure ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>불안전 자세 감지</td>';
            html += '<td>' + car["Acc_YR"] + '</td>';
            html += '<td>M</td>';
            html += '</tr>';
            if (cnt != 0) {
                html += '<tr class="inertia d-none ' + car["Car_terminal"] + '">';
            } else {
                html += '<tr class="inertia ' + car["Car_terminal"] + '">';
            }

            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>기타 관성</td>';
            html += '<td>' + car["MCU_SPEED"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';
            cnt++;
        }
        tbody.append(html);
    } else {
        tbody.find("tr").each(function(index, el) {
            //값세팅
            var type = $(el).attr("class");
            //var chk = false;
            for (carAll of carAllList) {
                var chk = $(el).hasClass(carAll["Car_terminal"]);
                var horizontal = $(el).hasClass("horizontal");
                var inclination = $(el).hasClass("inclination");
                var insecure = $(el).hasClass("insecure");
                var yawRate = $(el).hasClass("Acc_YR");
                if (chk) {
                    if (horizontal) {
                        $(el).children().eq(2).text(carAll["Acc_ALA"]);
                    } else if (inclination) {
                        $(el).children().eq(2).text(carAll["Acc_YACC"]);
                    } else if (insecure) {
                        $(el).children().eq(2).text(carAll["Acc_YR"]);
                    } else if (yawRate) {
                        $(el).children().eq(2).text(carAll["MCU_SPEED"]);
                    }
                }
            }
            //쇼 하이드
            var chkSelect = false;
            for (car of carList) {
                chkSelect = $(el).hasClass(car["Car_terminal"]);
                if (chkSelect) break;
            }
            if (chkSelect) {
                $(el).removeClass("d-none");
            } else {
                $(el).addClass("d-none");
            }
        })
    }
}



//선택한 차량정보 리스로 만드는 함수
function getCarInfo() {
    var carInfoList = [];
    data.forEach(function(car) {
        for (selectCar of selectcarTerminalList) {
            if (car["Car_terminal"] == selectCar) {
                carInfoList.push(car);
                carInfo = car;
            }
        }

    });
    return carInfoList;
};

//선택한 차량 정보를 가지고 화면 각 정보에 세팅하는 함수
function carDataSetting() {
    ;
    var carInfoList = getCarInfo();
    carSeatBeltSetting(carInfoList);
    speedSetting(carInfoList);

    carInfoSetting(data, carInfoList);
    breakInfoSetting(data, carInfoList);
    postureInfoSetting(data, carInfoList);
};

var source; //EventSource 담는 변수
//sse통신 시작하는 함수
function sseStart() {
    if (typeof(EventSource) !== "undefined") {
        source = new EventSource("<?=URL?>/carData/carCurrentDataList");
        source.onmessage = function(event) {
            data = JSON.parse(event.data);
            if (isfirst) {
                selectcarTerminal = data[0]["Car_terminal"];
                carListSetting();
                mapStart();
                //selectTrList();
                //carDataSetting();
                $(".tableRow").eq(0).click(); //첫번째 row클릭
            } else {
                selectTrList();
                carDataSetting();
                markerMove(data);
            }
            isfirst = false;
        };

        source.addEventListener(
            'error',
            function(e) {
                if (source.readyState == EventSource.CLOSED) {
                    if (!movePage) {
                        alert("연결이 끊겼습니다 새로고침 해주세요");
                    }
                }
            },
            false,
        )
    }
}

//sse통신 시작 호출
sseStart();


//페이지 이동 감지 이벤트
window.onbeforeunload = function() {
    movePage = true;
};

//차량리스트 선택시 차량 단말번호를 리스트에 담는 함수
function selectTrList() {
    selectcarTerminalList = [];
    var length = $(".selectTr").length;
    $(".selectTr").each(function(index, el) {
        var carTerminal = $(el).find(".carTerminalTd");
        selectcarTerminalList.push(carTerminal.text());
    });

}


//차량리스트 클릭이벤트
$(document).on("click", ".tableRow", function() {
    selectcarTerminal = $(this).find(".carTerminalTd").text();
    var isSelect = $(this).hasClass("selectTr");
    var tr = $(this).parent().find("tr");
    if (isSelect) {
        $(this).removeClass("selectTr");
        $(".carOverlay." + selectcarTerminal + "").removeClass("select");
        markerMap[selectcarTerminal].setZIndex(0);
    } else {
        $(this).addClass("selectTr");
        $(".carOverlay." + selectcarTerminal + "").addClass("select");
        markerMap[selectcarTerminal].setZIndex(1);
    }
    selectTrList();
    carDataSetting();
    mapCenterMove(data, selectcarTerminal);
    groupLineMaker(sortIndexObject["carInfoTable"], $("#carInfoTable"));
    groupLineMaker(sortIndexObject["breakInfoTable"], $("#breakInfoTable"));
    groupLineMaker(sortIndexObject["postureInfoTable"], $("#postureInfoTable"));
});

//소방3호차,소방4호차 버튼 테스트를 위한 랜덤 숫자 생성 함수
function randomNumber() {
    const rand = Math.floor(Math.random() * 4) + 1;
    return rand + "";
}

//소방3호차 테스트용 가짜 데이터를 만드는 함수
function testData(cnt) {
    var lati = 35.9746900100 + (cnt * 0.001);
    var long = 126.7300001000 + (cnt * 0.001);
    var jsonData = JSON.stringify({
        "Car_terminal": "DLS200001",
        "DCDC_state": randomNumber(),
        "OBC_fail": randomNumber(),
        "OBC_Voltage": randomNumber(),
        "OBC_Current": randomNumber(),
        "OBC_ActuTem": randomNumber(),
        "BMS_fail": randomNumber(),
        "BMS_state": randomNumber(),
        "BMS_Voltage": randomNumber(),
        "BMS_Current": randomNumber(),
        "BMS_SOC": randomNumber(),
        "BMS_SOH": randomNumber(),
        "MCU_state": randomNumber(),
        "MCU_fail": randomNumber(),
        "MCU_MotToq": randomNumber(),
        "MCU_MotSpd": randomNumber(),
        "MCU_SPEED": randomNumber() * 30,
        "MCU_AcclPos": randomNumber(),
        "MCU_BrkState": randomNumber(),
        "MCU_MotTem": randomNumber(),
        "MCU_MCUTem": randomNumber(),
        "MCU_MotVoltage": randomNumber(),
        "MCU_MotCurrent": randomNumber(),
        "GPS_SA": randomNumber(),
        "GPS_Longitude": "" + long,
        "GPS_Latitude": "" + lati,
        "GPS_Height": randomNumber(),
        "GPS_Speed": randomNumber(),
        "MCU_warning": randomNumber(),
        "MCU_moduleSt1": randomNumber(),
        "MCU_moduleSt2": randomNumber(),
        "MCU_VKT": randomNumber(),
        "Acc_YR": randomNumber(),
        'Acc_YACC': randomNumber(),
        'Acc_ALA': randomNumber(),
        "LDC_Voltage": randomNumber(),
        "LDC_Current": randomNumber(),
        'LDC_Tem': randomNumber(),
        "Car_reg_date": "2023-07-23 14:42:00"
    });
    return jsonData;
}

//소방4호차 테스트용 가짜 데이터를 만드는 함수
function test2Data(cnt) {
    var lati = 35.9668600100 + (cnt * 0.001);
    var long = 126.7100001000 + (cnt * 0.001);
    var jsonData = JSON.stringify({
        "Car_terminal": "DLS200009",
        "MCU_MotToq": randomNumber(),
        "MCU_MotSpd": randomNumber(),
        "MCU_SPEED": randomNumber() * 30,
        "MCU_AcclPos": randomNumber(),
        "MCU_BrkState": randomNumber(),
        "GPS_SA": randomNumber(),
        "GPS_Longitude": "" + long,
        "GPS_Latitude": "" + lati,
        "GPS_Height": randomNumber(),
        "MCU_SPEED": randomNumber(),
        "MCU_VKT": randomNumber(),
        "Acc_YR": randomNumber(),
        "Acc_YACC": randomNumber(),
        "Acc_ALA": randomNumber(),
        "Car_reg_date": "2023-07-23 14:42:00"
    });
    return jsonData;
}




//테스트 버튼 클릭이벤트 (소방3호차)
$("#testBtn").click(function() {
    var cnt = 1;
    setInterval(() => {
        fetch('carData/addCarData', {
                method: 'POST',
                cache: 'no-cache',
                body: testData(cnt)
            })
            .then(res => res.json())
            .then(data => {})
            .catch(error => console.log(error));
        cnt++;
    }, 3000);

});


//테스트 버튼 클릭이벤트 (소방4호차)
$("#test2Btn").click(function() {
    var cnt = 1;
    setInterval(() => {
        fetch('carData/addCarData', {
                method: 'POST',
                cache: 'no-cache',
                body: test2Data(cnt)
            })
            .then(res => res.json())
            .then(data => {})
            .catch(error => console.log(error));
        cnt++;
    }, 3000);

});



//테이블 정렬 함수
function table_sort() {
    const styleSheet = document.createElement('style')
    styleSheet.innerHTML = `
        .order-inactive span {
            visibility:hidden;
        }
        .order-inactive:hover span {
            visibility:visible;
        }
        .order-active span {
            visibility: visible;
        }
    `
    document.head.appendChild(styleSheet)
    document.querySelectorAll('th.order').forEach(th_elem => {
        let asc = true
        const span_elem = document.createElement('span')
        span_elem.style = "font-size:0.5rem; margin-left:0.2rem"
        span_elem.innerHTML = "▼"
        th_elem.appendChild(span_elem)
        th_elem.classList.add('order-inactive')
        const index = Array.from(th_elem.parentNode.children).indexOf(th_elem)
        th_elem.addEventListener('click', (e) => {
            document.querySelectorAll('th.order').forEach(elem => {
                elem.classList.remove('order-active')
                elem.classList.add('order-inactive')
            })
            th_elem.classList.remove('order-inactive')
            th_elem.classList.add('order-active')

            if (!asc) {
                th_elem.querySelector('span').innerHTML = '▲'
            } else {
                th_elem.querySelector('span').innerHTML = '▼'
            }
            const arr = Array.from(th_elem.closest("table").querySelectorAll('tbody tr'))
            arr.sort((a, b) => {
                const a_val = a.children[index].innerText
                const b_val = b.children[index].innerText
                return (asc) ? a_val.localeCompare(b_val) : b_val.localeCompare(a_val)
            })
            arr.forEach(elem => {
                th_elem.closest("table").querySelector("tbody").appendChild(elem)
            })
            asc = !asc
        })
    })
}

//테이블 정렬 함수 시작
table_sort();


//정렬에 따라 마지막 값 td에 bottom border 생성 함수
function groupLineMaker(index = 0, table) {
    var target = table.find("tbody tr");
    var beforCell;
    var beforeRow;
    target.removeClass("bottom-line2");
    target.each(function(i, row) {
        var noneChk = $(row).hasClass("d-none");
        var noneChk2 = $(row).hasClass("chk-none");
        if (!noneChk && !noneChk2) {
            var fCell = row.cells[index].innerHTML.toUpperCase();
            if (i == 0) {
                beforCell = fCell;
                beforeRow = row;
            }
            if (beforCell != fCell) {
                $(beforeRow).addClass("bottom-line2");
            }
            if (i > 0) {
                beforCell = fCell;
                beforeRow = row;
            }
        }
    })
}


//아래 표 정렬 함수 (th클릭할때)
var currentSortIndex = 0;
$("th.order").click(function() {
    currentSortIndex = $(this).index();
    var table = $(this).parent().parent().parent();
    var tableId = table.attr("id");
    currentSortIndex
    sortIndexObject[tableId] = currentSortIndex;
    groupLineMaker(currentSortIndex, table);
})

//항목선택 체크박스 변경했을때 함수
$(".breakInput").change(function() {
    var parent = $(this).parent().parent().parent().parent().parent();
    var table = parent.find("table");
    var id = $(this).attr("id");
    var chk = $(this).is(":checked");
    var className = id.replace('Check', '');
    var el = parent.find("table ." + className);
    if (chk) {
        el.removeClass("chk-none");
    } else {
        el.addClass("chk-none");
    }
    groupLineMaker(currentSortIndex, table);
});


//맵전체화면 (팝업)
var popWindow = null;
//전체화면 아이콘 클릭 이벤트
$(".expandIcon").click(function() {
    var isExpand = $(this).hasClass("fa-expand");
    if (isExpand) {
        popWindow = window.open('./pop/monitor', 'window',
            'location=no, directories=no,resizable=no,status=no,toolbar=no,menubar=no, width=300,height=400,left=0, top=0, scrollbars=yes'
        );
        $(this).attr("class", "fas fa-compress text-white expandIcon");
        source.close();
        $(".tableRow").removeClass("selectTr");
        $(".carOverlay ").removeClass("select");
        $(".card-carList").addClass("d-none");
        $(".card-seat-belt").addClass("d-none");
        $(".card-speed").addClass("d-none");
        $(".card-car-info").addClass("d-none");
        $(".card-break").addClass("d-none");
        $(".card-posture").addClass("d-none");
        $("#mapMonitor").addClass("h-800");
        $(".card-monitor").attr("class", "col-lg-12 px-1 card-monitor");
        map.relayout();
    } else {
        popWindow.close();
        $(this).attr("class", "fas fa-expand text-white expandIcon");
        popWindow = null;
        sseStart();
        $(".card-carList").removeClass("d-none");
        $(".card-seat-belt").removeClass("d-none");
        $(".card-speed").removeClass("d-none");
        $(".card-car-info").removeClass("d-none");
        $(".card-break").removeClass("d-none");
        $(".card-posture").removeClass("d-none");
        $("#mapMonitor").removeClass("h-800");
        $(".card-monitor").attr("class", "col-lg-10 px-1 card-monitor");
        map.relayout();
        $(".tableRow").eq(0).click();
    }


});
</script>