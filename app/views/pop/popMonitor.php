<div class="container-fluid">
    <div class="row">
        <div class="col-1700-2 col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-4 px-1 h-880">
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
        <div class="col-1700-2 col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-4  px-1 h-880">
            <div class="card border-left-info  shadow h-100 py-2">
                <div class="text-s fw-bold mb-2 ms-2">
                    속도 정보 (km/h)</div>
                <div class="card-body sm-scrollbar ovf-y">
                    <div class="row" id="speedMulti"></div>
                </div>
            </div>
        </div>
        <div class="col-1700-267 col-xxl-4 col-xl-4  mb-4  px-1 h-880 card-car-info">
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
                    <table class="table table-dark text-s infoListTable text-center carDataTable">
                        <thead class="table-active">
                            <tr>
                                <th width=20% class="order">차이름</th>
                                <th width=30% class="order">항목</th>
                                <th width=35%>값</td>
                                <th width=15%>단위</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-1700-267 col-xxl-4 col-xl-4 mb-4  px-1 h-880 card-break">
            <div class="card border-left-success  shadow h-100 py-2">
                <div class="row breakInfo">
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
                                <input type="checkbox" class="custom-control-input breakInput" id="realBreakCheck"
                                    checked>
                                <label class="custom-control-label" for="realBreakCheck">실제 브레이크</label>
                            </div>
                        </ul>
                    </div>
                </div>

                <div class="card-body sm-scrollbar ovf-y tableFixHead">
                    <table class="table table-dark text-s infoListTable text-center">
                        <thead class="table-active">
                            <tr>
                                <th width=20% class="order">차이름</th>
                                <th width=30% class="order">항목</th>
                                <th width=35%>값</td>
                                <th width=15%>단위</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-1700-267 col-xxl-4 col-xl-4 mb-4  px-1 h-880 card-posture">
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
                    <table class="table table-dark text-s infoListTable text-center">
                        <thead class="table-active">
                            <tr>
                                <th width=20% class="order">차이름</th>
                                <th width=30% class="order">항목</th>
                                <th width=35%>값</td>
                                <th width=15%>단위</td>
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


<!-- 착석 및 벨트 !아이콘 modal -->
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
                            <td><img src="../img/car-seat_off.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo1"></span></td>
                            <td class="vam">N</td>
                            <td class="vam">N</td>
                        </tr>
                        <tr>
                            <td><img src="../img/car-seat_on.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo2"></span></td>
                            <td class="vam">Y</td>
                            <td class="vam">N</td>
                        </tr>
                        <tr>
                            <td><img src="../img/car-seat_belt_off.png" class="seatImg-sm"></td>
                            <td><span class="seatBeltNemo3"></span></td>
                            <td class="vam">N</td>
                            <td class="vam">Y</td>
                        </tr>
                        <tr>
                            <td><img src="../img/car-seat_belt_on.png" class="seatImg-sm"></td>
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



<script>
var data; //실시간 통신 sse로 부터 받은 데이터
var isfirst = true; //처음 세팅하는 건지 구분하기 위한 변수
if (opener == null) {
    location.href = "./";
}

$("#accordionSidebar").addClass("d-none");



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



//착석 및 벨트 현황
function carSeatBeltSetting(carInfoList) {
    $("#seatBelt").empty();
    $("#seatBeltMulti").empty();
    $(".bs-tooltip-auto ").remove();
    var length = carInfoList.length;
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
    //툴팁처리
    var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
};


//속도게이지 세팅함수
function speedSetting(carInfoList) {
    var length = carInfoList.length;
    var width = $("#speedMulti").width() - 165;
    $("#speedMulti").empty();
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

//차량관련 정보 세팅
function carInfoSetting(carAllList, carList = null) {
    var tbody = $(".card-car-info").find("tbody");
    if (isfirst) {
        var html = '';
        var cnt = 0;
        for (car of carAllList) {
            html += '<tr class="wheel ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>스트어링휠 각도</td>';
            html += '<td>' + car["MCU_AcclPos"] + '</td>';
            html += '<td>deg</td>';
            html += '</tr>';

            html += '<tr class="sudden bottom-line2 ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>급제동</td>';
            html += '<td>' + car["GPS_Height"] + '</td>';
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
            html += '<tr class="accel ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>엑셀 페달</td>';
            html += '<td>' + car["MCU_AcclPos"] + '</td>';
            html += '<td>kg/m^2</td>';
            html += '</tr>';

            html += '<tr class="break ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>브레이크 페달</td>';
            html += '<td>' + car["MCU_BrkState"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';

            html += '<tr class="front ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>전방 거리 감지</td>';
            html += '<td>' + car["MCU_VKT"] + '</td>';
            html += '<td>M</td>';
            html += '</tr>';

            html += '<tr class="realBreak bottom-line2 ' + car["Car_terminal"] + '">';
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
            //var chk = false;
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
            html += '<tr class="horizontal ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>횡 가속도</td>';
            html += '<td>' + car["Acc_ALA"] + '</td>';
            html += '<td>kg/m^2</td>';
            html += '</tr>';

            html += '<tr class="inclination ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>차량 기울기</td>';
            html += '<td>' + car["Acc_YACC"] + '</td>';
            html += '<td>N</td>';
            html += '</tr>';

            html += '<tr class="insecure ' + car["Car_terminal"] + '">';
            html += '<td>' + car["Car_name"] + '</td>';
            html += '<td>불안전 자세 감지</td>';
            html += '<td>' + car["Acc_YR"] + '</td>';
            html += '<td>M</td>';
            html += '</tr>';

            html += '<tr class="inertia bottom-line2 ' + car["Car_terminal"] + '">';
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
                var yawRate = $(el).hasClass("yawRate");
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

//차량 정보 세팅
function carDataSetting() {
    carSeatBeltSetting(data);
    speedSetting(data);
    carInfoSetting(data, data);
    breakInfoSetting(data, data);
    postureInfoSetting(data, data);
    isfirst = false;
};



//sse 통신
if (typeof(EventSource) !== "undefined") {
    var source = new EventSource("<?=URL?>/carData/carCurrentDataList");
    source.onmessage = function(event) {
        data = JSON.parse(event.data);
        carDataSetting();
        var chk = opener.markerMove(data); //팝업을 호출한 부모에 함수호출 하여 카카오맵에 있는 마커를 이동시킨다.
    };

    source.addEventListener(
        'error',
        function(e) {

        },
        false,
    )
};



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
                beforeRow = row;
                beforCell = fCell;
            }
        }
    })
}


//아래 표 정렬 함수 (th클릭할때)
var currentSortIndex = 0;
$("th.order").click(function() {
    currentSortIndex = $(this).index();
    var table = $(this).parent().parent().parent();
    groupLineMaker(currentSortIndex, table);
})

//항목선택 체크박스 변경했을때 함수
$(".breakInput").change(function() {
    var parent = $(this).parent().parent().parent().parent().parent();
    var table = parent.find("table");
    console.log(table);
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
</script>