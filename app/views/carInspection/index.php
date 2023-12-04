<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-lg-12 px-1">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold">점검일지</h6>
                </div>
                <div class="card-body ovf-x">
                    <div class="col-1" id="addCarDriveDiv">
                        <button class="btn btn-primary" data-bs-toggle='modal'
                            data-bs-target='#carDriveRegModal'>작성</button>
                    </div>
                    <div class="col-8" id="searchDiv">
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
                    <table class='groupTable min-w1000' id='dataTable'>
                        <thead>
                            <tr>
                                <td>키</td>
                                <td>점검내용</td>
                                <td>운행차량</td>
                                <td>고장신고내역</td>
                                <td>점검일자</td>
                                <td>DC-DC 변환기 상태 정보</td>
                                <td>인버터 및 모터 상태 경고</td>
                                <td>OBC(충전장치) 고장 경고</td>
                                <td>BMS(배터리관리) 고장 경고</td>
                                <td>수정</td>
                                <td>삭제</td>
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



<!-- 등록 Modal -->
<div class="modal fade" id="carDriveRegModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ai-fs">
                <h5 class="modal-title">점검 일지 작성</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formReg">
                    <table class="driveRegTable">
                        <tr>
                            <th>운행일자</th>
                            <td><input type="date" class="form-control w-203px" id="driveDate" name="driveDate"
                                    required></td>
                            <th>차량번호</th>
                            <td>
                                <select name="driveCarTerminal" class="form-select w-203px" required>
                                    <option value=""> - 선택없음 - </option>
                                    <?php 
                                    for($i=0;$i<count($data);$i=$i+1){
                                        $carNumber = $data[$i]->Car_number;
                                        $carTerminal = $data[$i]->Car_terminal;
                                        echo '<option value="'.$carTerminal.'">'.$carNumber.'</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="border: 0px;">
                            <td colspan="4" class="finalDistanceTd">
                            <td>
                        </tr>
                        <tr>
                            <th>운행전거리</th>
                            <td>
                                <div class="input-group w-203px">
                                    <input type="number" min="0" max="500000" class="form-control checkValue"
                                        name="driveBeforeDistance" required>
                                    <span class="input-group-text">km</span>
                                </div>
                            </td>
                            <th>운행후거리</th>
                            <td>
                                <div class="input-group w-203px">
                                    <input type="number" min="0" max="500000" class="form-control checkValue"
                                        name="driveAfterDistance" required>
                                    <span class="input-group-text">km</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>운전자</th>
                            <td><input type="text" class="form-control w-203px checkValue" name="driveDriver" required>
                            </td>
                            <th>운행목적</th>
                            <td><input type="text" class="form-control w-203px checkValue" name="drivePurpose" required>
                            </td>
                        </tr>
                        <tr>
                            <th>특이사항</th>
                            <td colspan="3">
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="5"
                                    name="driveSignificant" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <button type="button" class="btn btn-danger" id="reportFaultButton">고장신고</button>
                                <input type="hidden" name="faultStatus" value="N">
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <button type=" submit" class="btn btn-primary btn-block">등록</button>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- 수정 Modal -->
<div class="modal fade" id="carDriveEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ai-fs">
                <h5 class="modal-title">운행 일지 수정 </h5>
                <span class="modal-subtitle"></span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit">
                    <table class="driveRegTable">
                        <tr class="d-none">
                            <td> <input type="text" name="driveKey" readOnly></td>
                        </tr>
                        <tr>
                            <th>운행일자</th>
                            <td><input type="date" class="form-control w-203px" id="driveDate" name="driveDate" required
                                    disabled></td>
                            <th>차량번호</th>
                            <td>
                                <select name="driveCarTerminal" class="form-select w-203px" required disabled>
                                    <option value=""> - 선택없음 - </option>
                                    <?php 
                                    for($i=0;$i<count($data);$i=$i+1){
                                        $carNumber = $data[$i]->Car_number;
                                        $carTerminal = $data[$i]->Car_terminal;
                                        echo '<option value="'.$carTerminal.'">'.$carNumber.'</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="border: 0px;">
                            <td colspan="4" class="finalDistanceTd">
                            <td>
                        </tr>
                        <tr>
                            <th>운행전거리</th>
                            <td>
                                <div class="input-group w-203px">
                                    <input type="number" min="0" max="500000" class="form-control checkValue"
                                        name="driveBeforeDistance" required disabled>
                                    <span class="input-group-text">km</span>
                                </div>
                            </td>
                            <th>운행후거리</th>
                            <td>
                                <div class="input-group w-203px">
                                    <input type="number" min="0" max="500000" class="form-control checkValue"
                                        name="driveAfterDistance" required disabled>
                                    <span class="input-group-text">km</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>운전자</th>
                            <td><input type="text" class="form-control w-203px checkValue" name="driveDriver" required
                                    disabled>
                            </td>
                            <th>운행목적</th>
                            <td><input type="text" class="form-control w-203px checkValue" name="drivePurpose" required
                                    disabled>
                            </td>
                        </tr>
                        <tr>
                            <th>특이사항</th>
                            <td colspan="3">
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="5"
                                    name="driveSignificant" required disabled></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <button type="button" class="btn btn-info" id="driveEditStartBtn">수정하기</button>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block" disabled>수정</button>
                </form>

            </div>
        </div>
    </div>
</div>




<!-- 차량정보 상세 Modal -->
<div class="modal fade" id="carInfoDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">차량정보</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered carDriveDetailTable">
                    <tr>
                        <th>단말기번호</th>
                        <td class="carInfoModalTd"></td>
                    </tr>
                    <tr>
                        <th>사용여부</th>
                        <td class="carInfoModalTd"></td>
                    </tr>
                    <tr>
                        <th>차번호</th>
                        <td class="carInfoModalTd"></td>
                    </tr>
                    <tr>
                        <th>차이름</th>
                        <td class="carInfoModalTd"></td>
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td class="carInfoModalTd"></td>
                    </tr>
                    <tr>
                        <th>등록일자</th>
                        <td class="carInfoModalTd"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- 운행일지 상세 Modal -->
<div class="modal fade" id="carDriveDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">운행일지</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered carDriveDetailTable">
                    <tr class="d-none">
                        <th>키</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행일자</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행차량</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운전자</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행목적</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행특이사항</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행전거리</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행후거리</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>운행거리</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>일지작성자</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                    <tr>
                        <th>일지등록일</th>
                        <td class="driveDetailModalTd"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 데이터테이블 관련 js라이브러리 불러오기 -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>



<script>
const formReg = document.getElementById('formReg');
const formEdit = document.getElementById('formEdit');
$.fn.DataTable.ext.pager.numbers_length = 20; //버튼 갯수 설정
var carInfoList = <?=json_encode($data)?>; //서버에서 받은 차량정보
console.log("carInfoList", carInfoList);
var isFirstDataTable = true; //데이터테이블을 처음 생성하는지 확인
var currentData; //조회한 차량정보를 담는 변수
var selectCarList = []; //선택된 자동차 리스트
var carInfoObject = new Object(); //차량의 단말기번호로 차량정보를 가져오는 오브젝트
var editDriveObject = new Object(); //수정전정보를 담는 오브젝트 (수정정보와 비교용)
var carInfoNumberObject = new Object(); //차량 번호로 차량정보를 가져오는 오브젝트
for (car of carInfoList) {
    carInfoObject[car["Car_terminal"]] = car;
    carInfoNumberObject[car["Car_number"]] = car;
}


//초기에 달력 날짜를 세팅해주고 데이터테이블을 시작하는 기능
$(function() {
    $("#start").val(getYmd10(-1));
    $("#end").val(getYmd10());
    $("#driveDate").val(getYmd10());
    var map = new Object();
    map["start"] = getYmd10(-1);
    map["end"] = getYmd10();
    map["isAll"] = true;
    dataTableStart(map);
});


//날짜 포멧 변환 함수 yyyy-mm-dd 포맷 날짜 생성
function getYmd10(n = 0) {
    //yyyy-mm-dd 포맷 날짜 생성
    var d = new Date();
    return d.getFullYear() + "-" + ((d.getMonth() + 1 + n) > 9 ? (d.getMonth() + 1 + n).toString() : "0" + (d
            .getMonth() + 1 + n)) +
        "-" + (d.getDate() > 9 ? d.getDate().toString() : "0" + d.getDate().toString());
}

//데이터 테이블 설정 및 시작
function dataTableStart(data = null) {
    var table = $('#dataTable').DataTable({
        dom: '<"row min-w1000"<"col-2 w-150px"f><"col-1"B>>r<"row"<"col-sm-12"t>><"row min-w1000"<"col-2 col-lg-2"i><"col-10 col-lg-10 page-center"p>>',
        language: {
            "info": "_START_ ~ _END_     (_TOTAL_)", //info 형태 ex) 1~15(4,244)
        },
        order: [
            [1, 'desc'] //기본정렬(1번째 열 내림차순)
        ],
        deferRender: true,
        pageLength: 15,
        searching: true,
        oLanguage: {
            "sSearch": ""
        },
        bLengthChange: false,
        buttons: [{ //엑셀버튼 생성
            extend: 'excel',
            filename: 'car-info-data',
        }],
        ajax: { //데이터테이블 생성시 ajax통해서 서버 데이터 가져오는 기능
            url: "carInspection/getCarInspection",
            type: "POST",
            data: data,
            dataType: "JSON",
            dataSrc: '',
            complete: function(data) {
                var info = data['responseJSON']
                console.log("info", info);
                currentData = info;
            },
        },
        columns: [{ //가져온 데이터 컬럼에 할당
                data: "car_Inspection_key",
            },
            {
                data: "car_Inspection_content",
            },
            {
                data: "Inspection_car_terminal",
            },
            {
                data: "car_report",
            },
            {
                data: "car_Inspection_reg_date",
            },
            {
                data: "DCDC_state",
                render: function(data) {
                    var modifiedData = "";
                    if (data == "0000000000000") {
                        modifiedData = "정상";
                    } else {
                        modifiedData = "이상 발생";
                    }
                    return modifiedData;
                }
            },
            {
                data: "MCU_warning",
                render: function(data) {
                    var modifiedData = "";
                    if (data == "000000000000") {
                        modifiedData = "정상";
                    } else {
                        modifiedData = "이상 발생";
                    }
                    return modifiedData;
                }
            },
            {
                data: "OBC_fail",
                render: function(data) {
                    var modifiedData = "";
                    if (data == "0000000000000") {
                        modifiedData = "정상";
                    } else {
                        modifiedData = "이상 발생";
                    }
                    return modifiedData;
                }
            },
            {
                data: "BMS_fail",
                render: function(data) {
                    var modifiedData = "";
                    if (data == "0000000000000") {
                        modifiedData = "정상";
                    } else {
                        modifiedData = "이상 발생";
                    }
                    return modifiedData;
                }
            },
            {
                data: "Drive_reg_date",
                render: function(data, type) {
                    var edit =
                        " <button class='btn btn-info rounded-circle btn-sm driveEditBtn' data-bs-toggle='modal' data-bs-target='#carDriveEditModal'> <i class='fas fa-pen-to-square text-white'></i> </button>";
                    return edit;
                }
            },
            {
                data: "Drive_reg_date",
                render: function(data, type) {
                    var del =
                        "<button class='btn btn-danger rounded-circle btn-sm driveDelBtn'><i class='fas fa-trash'></i></button>"
                    return del;
                }
            },
        ],

        fnDrawCallback: function() { //테이블 생성이 완료되면 실행되는 함수
            if (isFirstDataTable) {
                var firstDiv = $("#dataTable_wrapper .row").first();
                firstDiv.prepend($("#searchDiv"));
                firstDiv.prepend($("#addCarDriveDiv"));
                isFirstDataTable = false;
            }
            $("#dataTable thead td").removeClass("p-0");
        }
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

//검색 클릭이벤트
$(document).on("click", "#searchBtn", function() {
    var map = new Object();
    var startDay = $("#start").val();
    var endDay = $("#end").val();
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

    map["start"] = startDay;
    map["end"] = endDay;
    map["carList"] = selectCarList;
    map["isAll"] = isAll;
    $(".card-body").prepend($('#searchDiv'));
    $(".card-body").prepend($('#addCarDriveDiv'));
    $('#dataTable').DataTable().destroy();
    $('#dataTable tbody').empty();
    isFirstDataTable = true;
    dataTableStart(map);
});

//운행목적 클릭 이벤트
$(document).on("click", ".driveDetail", function() {
    var td = $(this).parent().parent().find("td");
    for (var i = 0; i < $(".driveDetailModalTd").length; i++) {
        if (i == 5) {
            $(".driveDetailModalTd").eq(i).html(td.eq(i).html());
        } else {
            $(".driveDetailModalTd").eq(i).text(td.eq(i).text());
        }

    }

});


//운행차량(차번호) 클릭 이벤트
$(document).on("click", ".carInfoDetail", function() {
    var carNumber = $(this).text();
    var carInfo = carInfoNumberObject[carNumber];
    console.log(carInfo);
    $(".carInfoModalTd").eq(0).text(carInfo["Car_terminal"]);
    $(".carInfoModalTd").eq(1).text(carInfo["Car_use"]);
    $(".carInfoModalTd").eq(2).text(carInfo["Car_number"]);
    $(".carInfoModalTd").eq(3).text(carInfo["Car_name"]);
    $(".carInfoModalTd").eq(4).text(carInfo["Car_content"]);
    $(".carInfoModalTd").eq(5).text(carInfo["Car_reg_date"]);
});


//등록 및 수정모달 닫았을때 이벤트
$('#carDriveRegModal,#carDriveEditModal').on('hidden.bs.modal', function() {
    $(this).find("input[type=text]").val("");
    $(this).find("input[type=number]").val("");
    $(this).find("input[type=date]").val(getYmd10());
    $(this).find("textarea").val("");
    $(this).find("select").val("");
    $(".finalDistanceTd").text("");
    $(this).find("input[type=number]").removeClass("is-invalid");
    $(this).find("input[type=number]").removeClass("is-valid");
    var tid = $(this).attr("id");
    if (tid == "carDriveEditModal") {
        $("#carDriveEditModal input,textarea,select").attr("disabled", true);
    }
});

//수정내용 체크 이벤트 (수정된 내용이 없다면 서버로 가지 않도록)
function editChangeCheck() {
    var driveDate = $("#carDriveEditModal input[name=driveDate]").val();
    var driveCarTerminal = $("#carDriveEditModal select[name=driveCarTerminal]").val();
    var driveBeforeDistance = $("#carDriveEditModal input[name=driveBeforeDistance]").val();
    var driveAfterDistance = $("#carDriveEditModal input[name=driveAfterDistance]").val();
    var driveDriver = $("#carDriveEditModal input[name=driveDriver]").val();
    var drivePurpose = $("#carDriveEditModal input[name=drivePurpose]").val();
    var driveSignificant = $("#carDriveEditModal textarea[name=driveSignificant]").val();
    if (driveDate == editDriveObject["driveDate"] && driveCarTerminal == editDriveObject["driveCarTerminal"] &&
        driveBeforeDistance == editDriveObject["driveBeforeDistance"] && driveAfterDistance == editDriveObject[
            "driveAfterDistance"] && driveDriver == editDriveObject["driveDriver"] && drivePurpose == editDriveObject[
            "drivePurpose"] && driveSignificant == editDriveObject["driveSignificant"]) {
        return false;
    } else {
        return true;
    }

}

//운행일지등록 버튼 클릭 submit이벤트
formReg.addEventListener('submit', (e) => {
    e.preventDefault();
    var forntCheck = $("#formReg .checkValue").hasClass("is-invalid");
    if (!forntCheck) {
        const payload = new FormData(formReg);
        fetch('carDrive/addCarDrive', {
                method: 'POST',
                cache: 'no-cache',
                body: payload,
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    alert("등록되었습니다.");
                    location.href = "./carInspection"
                } else {
                    alert("등록되지 않았습니다. 다시 확인해 주세요!");
                }
            })
            .catch(error => console.log(error));
    } else {
        alert("입력값을 확인해 주세요!");
    }
});





//운행일지 수정버튼
formEdit.addEventListener('submit', (e) => {
    e.preventDefault();
    var forntCheck = $("#formEdit .checkValue").hasClass("is-invalid");
    if (!forntCheck && editChangeCheck()) {
        if (confirm("정말로 수정 하시겠습니까?")) {
            const payload = new FormData(formEdit);
            fetch('carDrive/editCarDrive', {
                    method: 'POST',
                    cache: 'no-cache',
                    body: payload,
                })
                .then(res => res.json())
                .then(data => {
                    if (data) {
                        alert("수정되었습니다.");
                        location.href = "./carInspection"
                    } else {
                        alert("수정되지 않았습니다. 다시 확인해 주세요!");
                    }
                    console.log(data);
                })
                .catch(error => console.log(error));
        } else {
            return false;
        }

    } else {
        alert("변경된 내용이 없거나 입력값을 확인해 주세요!");
    }
});


//운행일지 작성시 차량번호 셀렉트 변화할때
$("select[name=driveCarTerminal]").change(function() {
    var val = $(this).val();
    var modalId = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().attr(
        "id");
    if (val != "") {
        fetch('carDrive/getFinalDistance', {
                method: 'POST',
                cache: 'no-cache',
                body: JSON.stringify(val),
            })
            .then(res => res.json())
            .then(data => {
                var finalDistance = Number(data["driveAfterDistance"]);
                $(".finalDistanceTd").text("※ 마지막 주행거리 : " + finalDistance + "km")
            })
            .catch(error => console.log(error));

        distanceCheck(modalId);
    } else {
        var tbody = $(this).parent().parent().parent();
        tbody.find("input[type=number]").removeClass("is-invalid");
        tbody.find("input[type=number]").removeClass("is-valid");
    }
});


//차량 운행전거리, 운행후거리 체크해주는 함수
function distanceCheck(modalId) {
    console.log(modalId);
    var driveCarTerminal = $("#" + modalId + " select[name=driveCarTerminal]").val();
    var beforeDistance = $("#" + modalId + " input[name=driveBeforeDistance]").val();
    var afterDistance = $("#" + modalId + " input[name=driveAfterDistance]").val();
    if (beforeDistance != "" && afterDistance != "" && driveCarTerminal != "") {
        var resData = new Object();
        var url = "carDrive/getCheckDistance";
        if (modalId == "carDriveEditModal") {
            resData["driveKey"] = $("#" + modalId + " input[name=driveKey]").val();;
            url = "carDrive/getCheckEditDistance";
        }
        resData["driveCarTerminal"] = driveCarTerminal;
        resData["beforeDistance"] = beforeDistance;
        resData["afterDistance"] = afterDistance;
        fetch(url, {
                method: 'POST',
                cache: 'no-cache',
                body: JSON.stringify(resData),
            })
            .then(res => res.json())
            .then(data => {
                if (!data) {
                    $("#" + modalId + " input[name=driveBeforeDistance]").removeClass("is-invalid");
                    $("#" + modalId + " input[name=driveAfterDistance]").removeClass("is-invalid");
                    $("#" + modalId + " input[name=driveBeforeDistance]").addClass("is-valid");
                    $("#" + modalId + " input[name=driveAfterDistance]").addClass("is-valid");
                } else {
                    var text = "*주행거리 범위에 작성된 일지가 있습니다. 거리를 확인해 주세요 \n";
                    for (d of data) {
                        text += "- 키 : " + d["Drive_key"] + " , 일지등록일 : " + d["Drive_reg_date"] + "\n";
                    }
                    alert(text);
                    $("#" + modalId + " input[name=driveBeforeDistance]").removeClass("is-valid");
                    $("#" + modalId + " input[name=driveAfterDistance]").removeClass("is-valid");
                    $("#" + modalId + " input[name=driveBeforeDistance]").addClass("is-invalid");
                    $("#" + modalId + " input[name=driveAfterDistance]").addClass("is-invalid");
                }
            })
            .catch(error => console.log(error));

    } else {
        return false;
    }
}

//운행전거리, 운행후거리 값 입력할때 이벤트
$("input[name=driveBeforeDistance],input[name=driveAfterDistance]").change(function() {
    var modalId = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent()
        .parent().attr("id");
    //var name = $(this).attr("name");
    var beforeDistance = $("#" + modalId + " input[name=driveBeforeDistance]").val();
    var afterDistance = $("#" + modalId + " input[name=driveAfterDistance]").val();
    console.log(beforeDistance, afterDistance);
    if (Number(beforeDistance) > Number(afterDistance)) {
        $("#" + modalId + " input[name=driveAfterDistance]").val("");
    }
    distanceCheck(modalId);
});

//선택된 row정보를 해당 테이블에 있는 데이터를 추출하는 함수
function rowChangeDriveObject(row) {
    var regex = /[^0-9]/g;
    editDriveObject["driveKey"] = row.eq(0).text();
    editDriveObject["driveDate"] = row.eq(1).text();
    editDriveObject["driveCarTerminal"] = carInfoNumberObject[row.eq(2).text()]["Car_terminal"];
    editDriveObject["driveBeforeDistance"] = row.eq(6).text().replace(regex, "");
    editDriveObject["driveAfterDistance"] = row.eq(7).text().replace(regex, "");
    editDriveObject["driveDriver"] = row.eq(3).text();
    editDriveObject["drivePurpose"] = row.eq(4).text();
    editDriveObject["driveSignificant"] = row.eq(5).html().replaceAll('<br>', '\n')

}


//수정버튼 클릭 이벤트
$(document).on("click", ".driveEditBtn", function() {
    var tdList = $(this).parent().parent().find("td");
    rowChangeDriveObject(tdList);
    $("#carDriveEditModal .modal-subtitle").text("키 : " + editDriveObject["driveKey"]);
    $("#carDriveEditModal input[name=driveKey]").val(editDriveObject["driveKey"]);
    $("#carDriveEditModal input[name=driveDate]").val(editDriveObject["driveDate"]);
    $("#carDriveEditModal select[name=driveCarTerminal]").val(editDriveObject["driveCarTerminal"]).prop(
        "selected", true);
    $("#carDriveEditModal input[name=driveBeforeDistance]").val(editDriveObject["driveBeforeDistance"]);
    $("#carDriveEditModal input[name=driveAfterDistance]").val(editDriveObject["driveAfterDistance"]);
    $("#carDriveEditModal input[name=driveDriver]").val(editDriveObject["driveDriver"]);
    $("#carDriveEditModal input[name=drivePurpose]").val(editDriveObject["drivePurpose"]);
    $("#carDriveEditModal textarea[name=driveSignificant]").val(editDriveObject["driveSignificant"]);
});

//수정하기 버튼 클릭
$("#driveEditStartBtn").click(function() {
    $("#carDriveEditModal input,textarea,select,button[type='submit']").attr("disabled", false);
});

//삭제버튼 클릭 이벤트
$(document).on("click", ".driveDelBtn", function() {
    var driveKey = $(this).parent().parent().find("td").eq(0).text();
    if (confirm("키 :" + driveKey + "를 삭제 하시겠습니까?")) {
        var resData = new Object();
        resData["driveKey"] = driveKey;
        fetch('carDrive/delCarDrive', {
                method: 'POST',
                cache: 'no-cache',
                body: JSON.stringify(resData),
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    alert("삭제되었습니다.");
                    location.href = "./carDrive";
                } else {
                    alert("삭제되지 않았습니다. 다시 시도해 주세요!");
                }
            })
            .catch(error => console.log(error));
    } else {
        return false;
    }
});
</script>