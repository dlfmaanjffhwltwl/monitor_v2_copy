<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-lg-8 px-1">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold">차량 경로</h6>
                </div>
                <div class="card-body">
                    <form class="" method="post" id="form">
                        <select name="carTerminal" class="btnSelect btn-custom">
                            <?php 
                                if($data !=false){
                                for($i=0;$i<count($data);$i=$i+1){
                                    $carTerminal = $data[$i]->Car_terminal;
                                    $carName = $data[$i]->Car_name;
                                    echo '<option value="'.$carTerminal.'">'.$carName.'</option>';
                                }
                                }
                            ?>
                        </select>
                        <input type="checkbox" class="ms-4" id="customTimeCheck" name="time">
                        <label class="" for="customTimeCheck">시간</label>
                        <input type="date" class="btn btn-custom" id="start" value="2019-11-30" name="start" required>
                        ~
                        <input type="date" class="btn btn-custom" id="end" value="2023-11-30" name="end" required>
                        <input type="checkbox" class="ms-4" id="zeroDistance" name="zeroDistance">
                        <label class="" for="zeroDistance" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true" title="거리이동이 없는 데이터 </br> 제외 또는 포함">거리0 포함</label>
                        <button type="submit" class="btn btn-info ms-4" id="searchBtn">검색</button>

                    </form>
                </div>
            </div>
            <div class="card shadow mt-1">
                <div class="card-body">
                    <div id="mapPath"></div>
                    <div class="map_cover d-none">
                        <div class="map_cover_text">
                            <span class="lodingText mr-1">Loading</span>
                            <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                            <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 contentTopDiv px-1">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold">내역</h6>
                </div>
                <div class="card-body mapContent">
                    <div class="table-responsive" style="height:805px;">
                        <table class="contentTable" width="100%">
                            <tbody class="contentTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=MAP_KEY?>"></script>

<script>
const form = document.getElementById('form');
const searchBtn = document.getElementById('searchBtn');
var polylineList = []; //조회한 경로선 리스트 담는 변수
var polylineActiveList = []; //활성화 경로 담는 변수
var markerList = []; //마커 리스트 담는 변수
var groupMap = new Object(); //그룹
var dataTableList = []; //그룹별 데이터테이블 담는 변수
var pointMarkerList = []; //경로 선택시 생기는 점 마커 담는 변수
$.fn.DataTable.ext.pager.numbers_length = 13; //보여지는 버튼 갯수 설정

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
}) //툴팁활성화 (거리0포함에 대한 설명)



//마커이미지 객체 생성
function markerImage(imageSrc, s1, s2, p1, p2) {
    var imageSize = new kakao.maps.Size(s1, s2), // 마커이미지의 크기입니다
        imageOption = {
            offset: new kakao.maps.Point(p1, p2)
        }; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

    // 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);
    return markerImage;

};


//지도 표시할 선을 생성 함수
function mapLineMaker(pathVal, key) {
    var polyline = new kakao.maps.Polyline({
        path: pathVal, // 선을 구성하는 좌표배열 입니다
        strokeWeight: 3, // 선의 두께 입니다
        strokeColor: "#e74a3b", // 선의 색깔입니다
        strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
        strokeStyle: 'solid' // 선의 스타일입니다
    });
    // 지도에 선을 표시합니다 
    polyline.setMap(map);
    polylineList.push(polyline);


    //선 위에 마우스 놓았을때 이벤트
    kakao.maps.event.addListener(polyline, 'mouseover', function(mouseEvent) {
        polyline.setZIndex(3);
        polyline.setOptions({
            strokeWeight: 6,
            strokeOpacity: 1,
            strokeColor: "#33ff33", // 선의 색깔입니다
            strokeStyle: 'solid'
        });
    });

    //선 위에 마우스 벗어날때 이벤트
    kakao.maps.event.addListener(polyline, 'mouseout', function(mouseEvent) {
        var chk = true;
        for (val of polylineActiveList) {
            if (val == key) {
                chk = false;
                break;
            }
        }
        if (chk) {
            polyline.setZIndex(1);
            polyline.setOptions({
                strokeWeight: 3, // 선의 두께 입니다
                strokeColor: "#e74a3b", // 선의 색깔입니다
                strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
                strokeStyle: 'solid' // 선의 스타일입니다
            });
        }

    });

    //선 클릭했을때 이벤트
    kakao.maps.event.addListener(polyline, 'click', function(mouseEvent) {
        var currentScroll = $(".table-responsive").scrollTop();
        var tableTop = $('.table-responsive').offset().top;
        var offset = $(".contentTable .contentTableBody .contentTr").eq(key).offset().top;
        $(".contentTable .contentTableBody .contentTr").eq(key).click();
        $(".table-responsive").animate({
            scrollTop: (offset + currentScroll - tableTop)
        }, 400);
    });
}

//지도에 선과 마커를 그려주는 함수
function mapLineSetting(data) {
    //선, 마커 리셋
    if (polylineList.length > 0) {
        for (var i = 0; i < polylineList.length; i++) {
            polylineList[i].setMap(null);
            markerList[i].setMap(null);
            groupMap = new Object();
        }
        polylineActiveList = [];
        polylineList = [];
        markerList = [];
    }
    if (!data) {
        return false;
    }

    var linePath = [];
    var groupDataList = [];
    var groupLineMap = new Object();
    var mapGroup = data[0]["Map_group"];

    //데이터 가공 (그룹별 객체화)
    for (var i = 0; i < data.length; i++) {
        if (mapGroup != data[i]["Map_group"]) {
            groupLineMap[mapGroup] = linePath;
            groupMap[mapGroup] = groupDataList;
            linePath = [];
            groupDataList = [];
            mapGroup = data[i]["Map_group"];

        }
        linePath.push(new kakao.maps.LatLng(Number(data[i]["GPS_Latitude"]), Number(data[i]["GPS_Longitude"])));
        groupDataList.push(data[i]);
        if (i == (data.length - 1)) {
            mapGroup = data[i]["Map_group"];
            groupLineMap[mapGroup] = linePath;
            groupMap[mapGroup] = groupDataList;
        }
    }

    //객체 반복문으로 마커 및 선 처리
    for (var key in groupLineMap) {
        mapLineMaker(groupLineMap[key], key);
        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
            position: new kakao.maps.LatLng(Number(groupLineMap[key][0]["Ma"]), Number(groupLineMap[key][0][
                "La"
            ])),
            image: markerImage('./img/location-pin.png', 40, 40, 20, 40), // 마커이미지 설정 
        });

        map.setLevel(4);
        marker.setMap(map);
        markerList.push(marker);
    }

    //맵 센터 이동
    map.setCenter(new kakao.maps.LatLng(Number(groupLineMap[key][0]["Ma"]), Number(groupLineMap[key][0]["La"])));
}

//내역 테이블 생성
function tbodySetting(data) {
    dataTableList = [];
    var html = "";
    for (key in groupMap) {
        html += "<tr class='contentTr'>";
        html += "<td><div class='contentTableTdDiv p-2'>group" + key + "</div></td>";
        html += "</tr>";
        html += "<tr><td> <div class='slideMe p-1'>";
        html += "<table class='groupTable' id='dataTable" + key + "'>";
        html += "<thead>";
        html += "<tr>";
        html += "<td>날짜</td>";
        html += "<td>위도</td>";
        html += "<td>경도</td>";
        html += "<td>거리</td>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        for (group of groupMap[key]) {
            html += "<tr class='tableRow'>";
            html += "<td class='tdRegDate'>" + group["Car_reg_date"] + "</td>";
            html += "<td>" + group["GPS_Latitude"] + "</td>";
            html += "<td>" + group["GPS_Longitude"] + "</td>";
            html += "<td>" + group["GPS_distance"].toLocaleString() + "</td>";
            html += "</tr>";
        }
        html += "</tbody>";
        html += "</table>";
        html += "</div></td></tr>";
    }
    $(".contentTableBody").append(html);
    for (key in groupMap) {
        var table = $('#dataTable' + key + '').DataTable({
            "language": {
                "info": "_START_ ~ _END_     (_TOTAL_)",
            },
            "bDestroy": true,
            pageLength: 500,
            searching: false,
            "bLengthChange": false,
            "bProcessing": true,
            "sDom": 'ir<"page-left"p>t<"page-left"p>',
        });
    }
    $("#searchBtn").attr("disabled", false);
}


//데이트 타입 바꿔주는 함수
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

//선택그룹 활성화 여부에 따라 선 색상 및 z인덱스를 설정하는 함수
function selectGroupLine(index, isActive) {
    if (isActive) {
        polylineActiveList.push(index);
        var firstPath = polylineList[index].getPath()[0];
        polylineList[index].setZIndex(3);
        polylineList[index].setOptions({
            strokeWeight: 6,
            strokeOpacity: 1,
            strokeColor: "#33ff33", // 선의 색깔입니다
            strokeStyle: 'solid'
        });
        map.setCenter(new kakao.maps.LatLng(Number(firstPath["Ma"]), Number(firstPath["La"])));
    } else {
        for (let i = 0; i < polylineActiveList.length; i++) {
            if (polylineActiveList[i] === index) {
                polylineActiveList.splice(i, 1);
                i--;
            }
        }
        polylineList[index].setZIndex(1);
        polylineList[index].setOptions({
            strokeWeight: 3, // 선의 두께 입니다
            strokeColor: "#e74a3b", // 선의 색깔입니다
            strokeOpacity: 0.5, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
            strokeStyle: 'solid' // 선의 스타일입니다
        });
    }
}


//카카오맵 시작
var mapContainer = document.getElementById('mapPath'), // 지도를 표시할 div 
    mapOption = {
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 8 // 지도의 확대 레벨
    };

// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);


//그룹 별 클릭이벤트
$(document).on('click', ".contentTable .contentTableBody .contentTr", function() {
    var index = $(this).index() / 2;
    if (!$(this).hasClass("selectTr")) { //선택되어 있지 않다면
        $(this).addClass("selectTr");
        selectGroupLine(index, true);
    } else { //기존에 선택이 되어 있다면
        $(this).removeClass("selectTr");
        selectGroupLine(index, false);
    }
    var slideMe = $(".slideMe").eq(index);
    var slideMeTd = $(".slideMe").eq(index).parent();
    $(".slideMe").eq(index).slideToggle();

});



//검색 버튼 클릭 submit이벤트
form.addEventListener('submit', (e) => {
    e.preventDefault();
    $("#searchBtn").attr("disabled", true);
    const payload = new FormData(form);
    $(".map_cover").removeClass("d-none");
    $(".contentTableBody").empty();
    for (p of pointMarkerList) {
        p.setMap(null);
    }
    pointMarkerList = [];
    fetch('path/getPath', {
            method: 'POST',
            cache: 'no-cache',
            body: payload,
        })
        .then(res => res.json())
        .then(data => {
            console.log("data", data);

            console.log(data);
            if (data == false) {
                alert("조회된 내역이 없습니다.");
            }
            mapLineSetting(data);
            tbodySetting(data);
            $(".map_cover").addClass("d-none");

        })
        .catch(error => {
            $("#searchBtn").attr("disabled", false);
            console.log(error);
            alert("데이가 너무 많아 날짜 범위를 축소하여 검색 부탁드립니다.")
            $(".map_cover").addClass("d-none");
        });
});

//시간 체크박스 클릭 이벤트
$("#customTimeCheck").click(function() {
    var chk = $(this).is(":checked");
    var startVal = $("#start").val();
    var endVal = $("#end").val();
    $("#start").val("");
    $("#end").val("");
    if (chk) {
        $("#start").attr("type", "datetime-local");
        $("#end").attr("type", "datetime-local");
        $("#start").val(startVal + "T00:00:00");
        $("#end").val(endVal + "T00:00:00");
    } else {
        $("#start").attr("type", "date");
        $("#end").attr("type", "date");
        $("#start").val(formatDate(startVal));
        $("#end").val(formatDate(endVal));
    }
})


//마커 찍어주는 클릭 이벤트
$(document).on("click", ".tableRow", function() {
    var latitude = $(this).find("td").eq(1).text();
    var longitude = $(this).find("td").eq(2).text();
    var parentTr = $(this).parent().parent().parent().parent().parent().parent();
    var groupName = parentTr.prev().find(".contentTableTdDiv").text();
    var activePage = parentTr.find(".page-item.active").eq(0).find("a").text();
    var rowIndex = $(this).index();
    var markerPosition = new kakao.maps.LatLng(latitude, longitude);
    if ($(this).hasClass("bg-secondary text-white")) {
        $(this).removeClass("bg-secondary text-white");
        var chkTitle = groupName + "," + activePage + "," + rowIndex;
        for (var i = 0; i < pointMarkerList.length; i++) {
            if (chkTitle == pointMarkerList[i].getTitle()) {
                pointMarkerList[i].setMap(null);
                pointMarkerList.splice(i, 1);
            }
        }
    } else {
        $(this).addClass("bg-secondary text-white");
        // 마커가 표시될 위치입니다 
        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
            position: markerPosition,
            image: markerImage('./img/full-stop.png', 60, 60, 30, 30), // 마커이미지 설정 
        });
        marker.setTitle(groupName + "," + activePage + "," + rowIndex);
        // 마커가 지도 위에 표시되도록 설정합니다
        marker.setMap(map);
        pointMarkerList.push(marker);
    }
})
</script>