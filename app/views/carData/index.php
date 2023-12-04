<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-lg-12 px-1">
            <div class="card shadow min-h800">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold">차량데이터</h6>
                </div>
                <div class="card-body ovf-x">
                    <div class="row d-none pe-0" id="searchDiv">
                        <div class="col-11" id="searchDiv2">
                            <button class="btn btn-custom dropdown-toggle me-4" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-auto-close="outside" id="carSelectDropdownBtn">전체</button>
                            <ul class="dropdown-menu dropdown-menu-dark selectDropUl px-2" id="carSelectDropdownUl">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="allCheck" checked>
                                    <label class="custom-control-label" for="allCheck">전체</label>
                                </div>
                                <?php 
                                if($data !=false){
                                    for($i=0;$i<count($data);$i=$i+1){
                                        $carTerminal = $data[$i]->Car_terminal;
                                        $carName = $data[$i]->Car_name;
                                        echo '<div class="custom-control custom-checkbox">';
                                        echo ' <input type="checkbox" class="custom-control-input carCheck" id="'.$carTerminal.'" checked>';
                                        echo '<label class="custom-control-label ms-2" for="'.$carTerminal.'">'.$carName.'</label>';
                                        echo '</div>';
                                    }
                                }   
                            ?>
                            </ul>
                            <input type="date" class="btn btn-custom" id="start" required=""> ~
                            <input type="date" class="btn btn-custom" id="end" required="">
                            <button type="submit" class="btn btn-info ms-4" id="searchBtn">검색</button>
                        </div>
                        <div class="col-1 text-right pe-0">
                            <button type="button" class="buttons-csv " id="csvBtn" data-bs-toggle='modal'
                                data-bs-target='#progressModal'>CSV</button>
                        </div>
                    </div>
                    <table class='groupTable min-w1000' id='dataTable'>
                        <thead class="d-none" id="groupTableThead">
                            <tr>
                                <td>단말기번호</td>
                                <td>모터토크</td>
                                <td>모터회전속도</td>
                                <td>주행속도</td>
                                <td>가속패달</td>
                                <td>브레이크상태</td>
                                <td>GPS접속위성수</td>
                                <td>경도</td>
                                <td>위도</td>
                                <td>고도</td>
                                <td>차속</td>
                                <td>누적거리</td>
                                <td>요레이트</td>
                                <td>종가속도</td>
                                <td>횡가속도</td>
                                <td>등록일자</td>
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


<!-- 진행율 Modal -->
<div class="modal fade" id="progressModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content downModal">
            <div class="modal-body">
                <span class="downSpan">CSV파일 변환중 . . .</span>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar overflow-visible progress-bar-striped" style="width: 0%"
                        id="downloadProgress">
                        0%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 데이터테이블,파일세이버 라이브러리 호출 (파일세이버는 대용량 파일을 빠르게 생성할 수 있게 해준다) -->
<script src="vendor/FileSaver/FileSaver.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>



<script>
$.fn.DataTable.ext.pager.numbers_length = 20; //버튼 갯수 설정
var carInfoList = <?= json_encode($data)?>; //서버에서 받은 차량정보
var isFirstDataTable = true; //데이터테이블을 처음 생성하는지 확인
var currentData; //조회한 차량센서정보를 담는 변수
var selectCarList = []; //선택된 자동차 리스트
var searchObject = new Object(); //검색정보를 담는 오브젝트 변수
var recordsTotal = 0; //전체 데이터 갯수

//초기에 달력 날짜를 세팅해주고 데이터테이블을 시작하는 기능
$(function() {
    $("#start").val(getYmd10(-1));
    $("#end").val(getYmd10());
    searchObject["startDay"] = getYmd10(-1);
    searchObject["endDay"] = getYmd10();
    searchObject["isAll"] = true;
    searchObject["carTerminal"] = carInfoList[0]["Car_terminal"];
    dataTableStart(searchObject);
});


//csv 파일을 만들어주는 함수
function makeCsvFile(dataList) {
    let CSV = '';
    let row = "";
    var colume = {
        "Car_key": "Car_key",
        "Car_terminal": "Car_terminal",
        "DCDC_state": "DCDC_state",
        "OBC_fail": "OBC_fail",
        "OBC_Voltage": "OBC_Voltage",
        "OBC_Current": "OBC_Current",
        "OBC_ActuTem": "OBC_ActuTem",
        "BMS_fail": "BMS_fail",
        "BMS_state": "BMS_state",
        "BMS_Voltage": "BMS_Voltage",
        "BMS_Current": "BMS_Current",
        "BMS_SOC": "BMS_SOC",
        "BMS_SOH": "BMS_SOH",
        "MCU_state": "MCU_state",
        "MCU_fail": "MCU_fail",
        "MCU_MotToq": "MCU_MotToq",
        "MCU_MotSpd": "MCU_MotSpd",
        "MCU_SPEED": "MCU_SPEED",
        "MCU_AcclPos": "MCU_AcclPos",
        "MCU_BrkState": "MCU_BrkState",
        "MCU_MotTem": "MCU_MotTem",
        "MCU_MCUTem": "MCU_MCUTem",
        "MCU_MotVoltage": "MCU_MotVoltage",
        "MCU_MotCurrent": "MCU_MotCurrent",
        "GPS_SA": "GPS_SA",
        "GPS_Latitude": "GPS_Latitude",
        "GPS_Longitude": "GPS_Longitude",
        "GPS_Height": "GPS_Height",
        "GPS_Speed": "GPS_Speed",
        "MCU_warning": "MCU_warning",
        "MCU_moduleSt1": "MCU_moduleSt1",
        "MCU_moduleSt2": "MCU_moduleSt2",
        "MCU_VKT": "MCU_VKT",
        "Acc_YR": "Acc_YR",
        "Acc_YACC": "Acc_YACC",
        "Acc_ALA": "Acc_ALA",
        "LDC_Voltage": "LDC_Voltage",
        "LDC_Current": "LDC_Current",
        "LDC_Tem": "LDC_Tem",
        "Car_reg_date": "Car_reg_date",
        "Car_db_date": "Car_db_date",
    };

    var intTextObject = {
        "Car_key": '"',
        "Car_terminal": '"',
        "DCDC_state": '"\'',
        "OBC_fail": '"\'',
        "OBC_Voltage": '"',
        "OBC_Current": '"',
        "OBC_ActuTem": '"',
        "BMS_fail": '"\'',
        "BMS_state": '"\'',
        "BMS_Voltage": '"',
        "BMS_Current": '"',
        "BMS_SOC": '"',
        "BMS_SOH": '"',
        "MCU_state": '"\'',
        "MCU_fail": '"\'',
        "MCU_MotToq": '"',
        "MCU_MotSpd": '"',
        "MCU_SPEED": '"',
        "MCU_AcclPos": '"',
        "MCU_BrkState": '"',
        "MCU_MotTem": '"',
        "MCU_MCUTem": '"',
        "MCU_MotVoltage": '"',
        "MCU_MotCurrent": '"',
        "GPS_SA": '"',
        "GPS_Latitude": '"',
        "GPS_Longitude": '"',
        "GPS_Height": '"',
        "GPS_Speed": '"',
        "MCU_warning": '"\'',
        "MCU_moduleSt1": '"',
        "MCU_moduleSt2": '"',
        "MCU_VKT": '"',
        "Acc_YR": '"',
        "Acc_YACC": '"',
        "Acc_ALA": '"',
        "LDC_Voltage": '"',
        "LDC_Current": '"',
        "LDC_Tem": '"',
        "Car_reg_date": '"',
        "Car_db_date": '"',
    }

    var fileName = 'car-row-data.csv';
    for (let index in dataList[0]) {
        row += colume[index] + ',';
    }
    row = row.slice(0, -1);
    CSV += row + '\r\n';

    for (let i = 0; i < dataList.length; i++) {
        let row = "";
        var front = '"';

        for (let index in dataList[i]) {
            row += intTextObject[index] + dataList[i][index] + '",';
        }

        row.slice(0, row.length - 1);
        CSV += row + '\r\n';
    }
    csvFile = new Blob([CSV], {
        type: "text/csv"
    });
    return csvFile;
}

//압축파일 생성하는 함수
async function dozipping(zip) {
    try {
        const response = await zip.generateAsync({
            type: "blob"
        });
        zipstring = response;
        return response;
    } catch (error) {
        console.error(error);
    }
}

//전달받은 csv파일을 압축해서 파일로 내보내는 함수
async function downloadCSVZip(csvFileList) {
    progressRate(100, "파일 압축중", );
    var zip = new JSZip();
    for (var i = 0; i < csvFileList.length; i++) {
        zip.file(`car_row_data${i+1}.csv`, csvFileList[i]);
    }
    var resZip = await dozipping(zip);
    progressRate(100, "파일 압축완료");
    saveAs(resZip, 'down.zip');
    progressRate(100, "다운로드완료", true);
}


//날짜 포멧 변환 함수 yyyy-mm-dd 포맷 날짜 생성
function getYmd10(n = 0) {
    var d = new Date();
    return d.getFullYear() + "-" + ((d.getMonth() + 1 + n) > 9 ? (d.getMonth() + 1 + n).toString() : "0" + (d
            .getMonth() + 1 + n)) +
        "-" + (d.getDate() > 9 ? d.getDate().toString() : "0" + d.getDate().toString());
}

//데이터 테이블 설정 및 시작
function dataTableStart(data = null) {
    var reqData = data;

    var table = $('#dataTable').DataTable({
        dom: '<"row min-w1000">r<"row min-w1000"<"col-2 col-lg-2 mt-1"i><"col-10 col-lg-10 mt-1"p>><"row"<"col-sm-12"t>>', //테이블구조
        language: {
            "info": "_START_ ~ _END_     (_TOTAL_)", //info 형태 ex) 1~15(4,244)
        },
        order: [
            [15, 'desc'] //기본정렬(15번째 열 내림차순)
        ],
        serverSide: true,
        deferRender: true,
        pageLength: 30, //한화면에 보여줄 수
        searching: true,
        oLanguage: {
            "sSearch": "",
            "processing": "불러오는 중...",
        },
        destroy: true,
        bLengthChange: false,
        bProcessing: true,
        "fnServerParams": function(aoData) {
            aoData["recordsTotal"] = recordsTotal;
        },

        ajax: { //데이터테이블 생성시 ajax통해서 서버 데이터 가져오는 기능
            url: "carData/getCarDataList",
            type: "POST",
            data: reqData,
            dataType: "JSON",
            dataSrc: function(res) {
                var resData = res.data;
                recordsTotal = res.recordsTotal;
                currentData = resData;
                return resData;
            },
        },
        columns: [{ //가져온 데이터 컬럼에 할당
                data: "Car_terminal",
                className: "p-0 ",
            },
            {
                data: "MCU_MotToq",
                className: "p-0",
            },
            {
                data: "MCU_MotSpd",
                className: "p-0",
            },
            {
                data: "MCU_SPEED",
                className: "p-0",
            },
            {
                data: "MCU_AcclPos",
                className: "p-0",
            },
            {
                data: "MCU_BrkState",
                className: "p-0",
            },
            {
                data: "GPS_SA",
                className: "p-0",
            },
            {
                data: "GPS_Longitude",
                className: "p-0 w70px",
            },
            {
                data: "GPS_Latitude",
                className: "p-0 w70px",
            },
            {
                data: "GPS_Height",
                className: "p-0",
            },
            {
                data: "GPS_Speed",
                className: "p-0",
            },
            {
                data: "MCU_VKT",
                className: "p-0",
            },
            {
                data: "Acc_YR",
                className: "p-0",
            },
            {
                data: "Acc_YACC",
                className: "p-0",
            },
            {
                data: "Acc_ALA",
                className: "p-0",
            },
            {
                data: "Car_reg_date",
                className: "p-0 w100px",
            },
        ],

        fnDrawCallback: function() { //테이블 생성이 완료되면 실행되는 함수
            if (isFirstDataTable) {
                var firstDiv = $("#dataTable_wrapper .row").first();
                $("#groupTableThead").removeClass("d-none");
                $("#searchDiv").removeClass("d-none");
                firstDiv.prepend($("#searchDiv"));
                isFirstDataTable = false;
            }
            $("#dataTable thead td").removeClass("p-0");

        }
    });

}

//csv파일 생성 진행바 퍼센트 나타내는 함수
function progressRate(percent, title = "", complete = false) {
    $(".progress").attr("aria-valuenow", "" + percent);
    $(".progress .progress-bar").css("width", percent + "%");
    $(".progress .progress-bar").text(percent + "%");
    if (title != "") { //타이틀이 비어있지 않다면 세팅
        $(".downSpan").text(title);
    }
    if (percent == 100 && complete) { //완료되었다면 1초 후에 모달창 닫기
        setTimeout(() => {
            $('#progressModal').modal('hide');
            $(".downSpan").text("Download . . .");
            $(".progress").attr("aria-valuenow", "" + 0);
            $(".progress .progress-bar").css("width", 0 + "%");
            $(".progress .progress-bar").text(0 + "%");
        }, 1000);
    }

}

//진행바 닫았을때 원래대로 세팅하는 함수
$('#progressModal').on('hidden.bs.modal', function() {
    $(".downSpan").text("CSV파일 변환중 . . .");
    $(".progress").attr("aria-valuenow", "" + 0);
    $(".progress .progress-bar").css("width", 0 + "%");
    $(".progress .progress-bar").text(0 + "%");
})

//csv 버튼 클릭 이벤트 서버에서 5만개씩 데이터를 불러와 csv파일로 만드는 이벤트
$("#csvBtn").click(async function() {
    try {
        var limit = 50000;
        var csvFileList = [];
        var dataObejct = Object.assign({}, searchObject);
        var isPage = false;
        if (recordsTotal > limit) {
            isPage = true;
        }
        dataObejct["isPage"] = isPage;
        dataObejct["recordsTotal"] = recordsTotal;
        dataObejct["limit"] = limit;
        var pages = Math.ceil(recordsTotal / limit) - 1;
        for (var i = 0; i <= pages; i++) {
            dataObejct["page"] = i * limit;
            var data = await getAjax(dataObejct); // 5.
            var percent = Math.round((i + 1) / (pages + 1) * 100);
            progressRate(percent);
            csvFileList.push(makeCsvFile(data));
        }
        downloadCSVZip(csvFileList);
    } catch (e) { // 6.
        console.log(e);
    }
})

//csv클릭시 서버로 호출하는 함수
const getAjax = function(data) {
    return new Promise((resolve, reject) => { // 1.
        $.ajax({
            url: "carData/getAllData",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(data),
            success: (res) => {
                resolve(res); // 2.
            },
            error: (e) => {
                reject(e); // 3.
            }
        });
    });
}


//전체 클릭이벤트
$("#allCheck").click(function() {
    var chk = $(this).is(":checked");
    if (chk) {
        $('.carCheck').prop('checked', true);
        $("#carSelectDropdownBtn").text("전체");
    } else {
        $('.carCheck').prop('checked', false);
        $("#carSelectDropdownBtn").text("선택없음");
    }
});

//전체에서 각각 클릭이벤트
$(".carCheck").click(function() {
    var selectCarName = [];
    $(".carCheck").each(function(index, item) {
        if ($(item).is(':checked')) {
            selectCarName.push($(item).parent().find('label').text());
        };
    });
    if (selectCarName.length == $(".carCheck").length) {
        $("#carSelectDropdownBtn").text("전체");
    } else if (selectCarName.length == 0) {
        $("#carSelectDropdownBtn").text("선택없음");
    } else if (selectCarName.length == 1) {
        $("#carSelectDropdownBtn").text(selectCarName[0]);
    } else {
        $("#carSelectDropdownBtn").text(selectCarName[0] + "외 " + (selectCarName.length - 1));
    }
})

//검색 클릭이벤트 데이터 테이블을 파괴하고 재생성 한다.
$(document).on("click", "#searchBtn", function() {

    var startDay = $("#start").val();
    var endDay = $("#end").val();
    var selectCarTerminal = $("#selectCarTerminal").val();
    var isAll = $("#carSelectDropdownBtn").text() == "전체" ? true : false;
    var selectCarList = [];
    $(".carCheck").each(function(index, item) {
        if ($(item).is(':checked')) {
            selectCarList.push($(item).attr("id"));
        };
    });
    if (selectCarList.length == 0) {
        alert("선택하신 차량이 없습니다.");
        return false;
    }

    searchObject["startDay"] = startDay;
    searchObject["endDay"] = endDay;
    searchObject["isAll"] = isAll;
    searchObject["carList"] = selectCarList;
    searchObject["carTerminal"] = selectCarTerminal;
    $("#groupTableThead").addClass("d-none");
    $(".card-body").prepend($('#searchDiv'));
    $('#dataTable').DataTable().destroy();
    $('#dataTable tbody').empty();
    isFirstDataTable = true;
    dataTableStart(searchObject);
});
</script>