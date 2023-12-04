<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-lg-12 px-1">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold">차량정보</h6>
                </div>
                <div class="card-body ovf-x d-none">
                    <table class='groupTable min-w1000' id='dataTable'>
                        <thead>
                            <tr>
                                <td>단말기번호</td>
                                <td>차번호</td>
                                <td>차이름</td>
                                <td>비고</td>
                                <td>등록일자</td>
                                <td>사용</td>
                                <?php
                                  $sessionLevel = Session::get("userLevel");
                                if($sessionLevel ==1){
                                    echo '
                                    <td>수정</td>
                                    <td>삭제</td>
                                    ';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($data !=false){
                                for($i=0;$i<count($data);$i=$i+1){
                                    $carTerminal    = $data[$i]->Car_terminal;
                                    $carNumber      = $data[$i]->Car_number;
                                    $carName        = $data[$i]->Car_name;
                                    $carContent     = $data[$i]->Car_content;
                                    $carUse         = $data[$i]->Car_use;
                                    $carRegDate     = $data[$i]->Car_reg_date;
                            
                                    echo "<tr>
                                    <td>".$carTerminal."</td>
                                    <td>".$carNumber."</td>
                                    <td>".$carName."</td>
                                    <td>".$carContent."</td>
                                    <td>".$carRegDate."</td>
                                    <td class='tdIconBtn'>".$carUse."</td>
                                    ";
                                    if($sessionLevel ==1){
                                        echo "
                                        <td class='tdIconBtn'>
                                        <button class='btn btn-info btn-sm rounded-circle carInfoEditBtn' data-bs-toggle='modal'
                                        data-bs-target='#carInfoEditModal'>
                                            <i class='fas fa-pen-to-square text-white'></i>
                                        </button>
                                        </td>
                                        <td class='tdIconBtn'>
                                            <button class='btn btn-danger btn-sm rounded-circle carInfoDelBtn'>
                                                <i class='fas fa-trash'></i>
                                            </button>
                                        </td>
                                        ";
                                    }
                                    echo "
                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 등록 Modal -->
<div class="modal fade" id="carInfoRegModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header ai-fs">
                <h5 class="modal-title">차량 등록</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formReg">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">단말기번호</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="Car_terminal" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">차량번호</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="Car_number" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">차량이름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="Car_name" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">비고</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Car_content">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">사용여부</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Car_use" id="caruseRadio1" value="Y"
                                    checked>
                                <label class="form-check-label" for="caruseRadio1">Y</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Car_use" id="caruseRadio2" value="N">
                                <label class="form-check-label" for="caruseRadio2">N</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">등록</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- 수정 Modal -->
<div class="modal fade" id="carInfoEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">차량 수정</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">단말기번호</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="Car_terminal" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">차량번호</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="Car_number">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">차량이름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="Car_name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">비고</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Car_content">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">사용여부</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Car_use" id="eidtCaruseRadio1"
                                    value="Y">
                                <label class="form-check-label" for="eidtCaruseRadio1">Y</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Car_use" id="eidtCaruseRadio2"
                                    value="N">
                                <label class="form-check-label" for="eidtCaruseRadio2">N</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">수정</button>
                </form>
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
var editCarTerminal; //수정전 단말기번호를 담을 변수
var editCarNumber; //수정전 차번호를 담을 변수
var editCarName; //수정전 차이름을 담을 변수
var editCarContent; //수정전 비고 내용을 담을 변수
var editCarUse; //수정전 사용여부를 담을 변수
var isFirstDataTable = true; //데이터테이블을 처음 생성하는지 확인
var table = $('#dataTable').DataTable({
    dom: '<"row min-w500"<"col-6 col-sm-6 col-md-4"f><"col-2 col-sm-1 col-md-1"B>>r<"row"<"col-sm-12"t>><"row min-w1000"<"col-2 col-lg-2"i><"col-10 col-lg-10 page-center"p>>',
    language: {
        "info": "_START_ ~ _END_     (_TOTAL_)",
    },
    order: [
        [4, 'desc']
    ],
    pageLength: 15,
    searching: true,
    oLanguage: {
        "sSearch": ""
    },
    bLengthChange: false,
    //"bInfo": false,
    bProcessing: true,
    buttons: [{
        extend: 'excel',
        filename: 'car-info-data',
    }],
    fnDrawCallback: function() {
        if (isFirstDataTable) {
            var btnHtml = '';
            if ("<?= $sessionLevel?>" == 1) { //유저권한이 1(관리자)이면 차량등록버튼이 보이고 아니면 안보이게 하는
                btnHtml =
                    '<div class="col-4 col-sm-5 col-md-7"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carInfoRegModal">차량등록</button></div>';
            } else {
                var btnHtml =
                    '<div class="col-4 col-sm-5 col-md-7"></div>';
            }
            var firstDiv = $("#dataTable_wrapper .row").first();
            firstDiv.prepend(btnHtml);
            isFirstDataTable = false;
            $('.card-body').removeClass("d-none");
        }
    },
});



//차량등록 버튼 클릭 submit이벤트
formReg.addEventListener('submit', (e) => {
    e.preventDefault();
    var forntCheck = $("#formReg .checkValue").hasClass("is-invalid");
    if (!forntCheck) {
        const payload = new FormData(formReg);
        fetch('carInfo/addCarInfo', {
                method: 'POST',
                cache: 'no-cache',
                body: payload,
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    alert("등록되었습니다.");
                    location.href = "./carInfo"
                } else {
                    alert("등록되지 않았습니다. 다시 확인해 주세요!");
                }
                console.log(data);
            })
            .catch(error => console.log(error));
    } else {
        alert("입력값을 확인해 주세요!");
    }
});

//수정내용이 있는지 체크하는 함수
function editChangeCheck() {
    var carTerminal = $("#formEdit input[name=Car_terminal]").val();
    var carNumber = $("#formEdit input[name=Car_number]").val();
    var carName = $("#formEdit input[name=Car_name]").val();
    var carContent = $("#formEdit input[name=Car_content]").val();
    var carUse = $('#formEdit  input:radio[name="Car_use"]:checked').val();
    if (editCarNumber == carNumber && editCarName == carName && editCarContent == carContent && editCarUse == carUse) {
        return false;
    } else {
        return true;
    }
}

//차량 수정버튼
formEdit.addEventListener('submit', (e) => {
    e.preventDefault();
    var forntCheck = $("#formEdit .checkValue").hasClass("is-invalid");
    console.log(editChangeCheck());
    if (!forntCheck && editChangeCheck()) {
        if (confirm("정말로 수정 하시겠습니까?")) {
            const payload = new FormData(formEdit);
            fetch('carInfo/editCarInfo', {
                    method: 'POST',
                    cache: 'no-cache',
                    body: payload,
                })
                .then(res => res.json())
                .then(data => {
                    if (data) {
                        alert("수정되었습니다.");
                        location.href = "./carInfo"
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


//차량 수정시 값을 변경했을때 이벤트
$(".checkValue").change(function() {
    var resData = new Object();
    resData["name"] = $(this).attr("name");
    resData["value"] = $(this).val();
    fetch('carInfo/getCarInfoCheck', { //변경정보 중복값 확인
            method: 'POST',
            cache: 'no-cache',
            body: JSON.stringify(resData),
        })
        .then(res => res.json())
        .then(data => {
            console.log("데이터확인" + data);
            $(this).attr("class", "form-control checkValue");
            if (data) {
                $(this).addClass("is-valid");
            } else {
                $(this).addClass("is-invalid");
            }
        })
        .catch(error => console.log(error));
})

//수정 버튼 클릭이벤트
$(document).on("click", ".carInfoEditBtn", function() {
    var carInfoTd = $(this).parent().parent().find("td");
    editCarTerminal = carInfoTd.eq(0).text();
    editCarNumber = carInfoTd.eq(1).text();
    editCarName = carInfoTd.eq(2).text();
    editCarContent = carInfoTd.eq(3).text();
    editCarUse = carInfoTd.eq(5).text();
    if (editCarUse == "Y") {
        $("#formEdit input[name=Car_use]").eq(0).prop("checked", true);
    } else {
        $("#formEdit input[name=Car_use]").eq(1).prop("checked", true);
    }
    $("#formEdit input[name=Car_terminal]").val(editCarTerminal);
    $("#formEdit input[name=Car_number]").val(editCarNumber);
    $("#formEdit input[name=Car_name]").val(editCarName);
    $("#formEdit input[name=Car_content]").val(editCarContent);
});


//삭제 버튼 클릭이벤트
$(document).on("click", ".carInfoDelBtn", function() {
    var carTerminal = $(this).parent().parent().find("td").eq(0).text();
    if (confirm("단말기번호 :" + carTerminal + "를 삭제 하시겠습니까?")) {
        var resData = new Object();
        resData["carTerminal"] = carTerminal;
        fetch('carInfo/delCarInfo', {
                method: 'POST',
                cache: 'no-cache',
                body: JSON.stringify(resData),
            })
            .then(res => res.json())
            .then(data => {
                if (data["result"]) {
                    alert("삭제되었습니다.");
                    location.href = "./carInfo"
                } else {
                    alert(data["data"]);
                }
            })
            .catch(error => console.log(error));
    } else {
        return false;
    }
});

//등록모달 닫았을때 이벤트
$('#carInfoRegModal,#carInfoEditModal').on('hidden.bs.modal', function() {
    $(this).find(".form-control").attr("class", "form-control checkValue");
    $(this).find("input[type=text]").val("");
})
</script>