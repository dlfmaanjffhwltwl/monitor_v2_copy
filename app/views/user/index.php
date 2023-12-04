<div class="container-fluid">
    <div class="row  mb-2">
        <div class="col-lg-12 px-1">
            <!-- Illustrations -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold">사용자 정보</h6>
                </div>
                <div class="card-body ovf-x d-none">
                    <table class='groupTable min-w1000' id='dataTable'>
                        <thead>
                            <tr>
                                <td>아이디</td>
                                <td>이름</td>
                                <td>권한</td>
                                <td>등록일자</td>
                                <td>사용</td>
                                <td>수정</td>
                                <td>삭제</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($data !=false){
                                $userLevelList = $data["userLevelList"];
                                $userList = $data["userList"];
                                for($i=0;$i<count($userList);$i=$i+1){
                                    $userId         = $userList[$i]->User_Id;
                                    $userName       = $userList[$i]->User_name;
                                    $userLevel      = $userList[$i]->User_level;
                                    $userLevelName =   $userList[$i]->Level_name;
                                    $userRegDate    = $userList[$i]->User_reg_date;
                                    $userUse        = $userList[$i]->User_use;
                            
                                    echo "<tr>
                                    <td>".$userId."</td>
                                    <td>".$userName."</td>
                                    <td>".$userLevelName."</td>
                                    <td>".$userRegDate."</td>
                                    <td class='tdIconBtn'>".$userUse."</td>
                                    <td class='tdIconBtn'>
                                        <button class='btn btn-info rounded-circle btn-sm userEditBtn' data-bs-toggle='modal'
                                        data-bs-target='#userEditModal'>
                                            <i class='fas fa-pen-to-square text-white'></i>
                                        </button>
                                    </td>
                                    <td class='tdIconBtn'>
                                        <button class='btn btn-danger rounded-circle btn-sm userDelBtn'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </td>
                                    </tr>";
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
<div class="modal fade" id="userRegModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">사용자 등록</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formReg">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">아이디</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="userId" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">비밀번호</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control checkValue" name="userPw" autocomplete="off"
                                required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">비밀번호 확인</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control checkValue" name="userPw1" autocomplete="off"
                                required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">이름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="userName" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">권한</label>
                        <div class="col-sm-10">
                            <select name="userLevel" class="form-control form-select"
                                <?php if ($userLevel == 3) echo ' disabled'; ?>>
                                <?php 
                                 if($data !=false){
                                    $userLevelList = $data["userLevelList"];
                                    for($j=0;$j<count($userLevelList);$j=$j+1){
                                        $userLevel = $userLevelList[$j]->Level_key;
                                        $userLevelName =$userLevelList[$j]->Level_name;
                                        echo '<option value="'.$userLevel.'">'.$userLevelName.'</option>';
                                    }
                                 }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">사용여부</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userUse" id="userUseRadio1" value="Y"
                                    checked>
                                <label class="form-check-label" for="userUseRadio1">Y</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userUse" id="userUseRadio2"
                                    value="N">
                                <label class="form-check-label" for="userUseRadio2">N</label>
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
<div class="modal fade" id="userEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">사용자 수정</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit">
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">아이디</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control checkValue" name="userId" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">비밀번호</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control checkValue" name="userPw" autocomplete="off"
                                required disabled>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-check-input" type="checkbox" value="" id="pwCheck">
                            <label class="form-check-label" for="flexCheckDefault">
                                비번변경
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">비밀번호 확인</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control checkValue" name="userPw1" autocomplete="off"
                                required disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">이름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="userName" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">권한</label>
                        <div class="col-sm-10">
                            <select name="userLevel" class="form-control form-select">
                                <?php 
                                 if($data !=false){
                                    $userLevelList = $data["userLevelList"];
                                    for($j=0;$j<count($userLevelList);$j=$j+1){
                                        $userLevel = $userLevelList[$j]->Level_key;
                                        $userLevelName =$userLevelList[$j]->Level_name;
                                        echo '<option value="'.$userLevel.'">'.$userLevelName.'</option>';
                                    }
                                 }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">사용여부</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userUse" id="editUserUseRadio1"
                                    value="Y" checked>
                                <label class="form-check-label" for="editUserUseRadio1">Y</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userUse" id="editUserUseRadio2"
                                    value="N">
                                <label class="form-check-label" for="editUserUseRadio2">N</label>
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

<!--datatable 관련 라이브러리 호출 -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script>
const formReg = document.getElementById('formReg');
const formEdit = document.getElementById('formEdit');
var editUserId; //수정전 아이디를 담을 변수
var editUserName; //수정전 이름을 담을 변수
var editUserUse; //수정전 사용여부를 담을 변수
var editUserLevel; //수정전 권한레벨을 담을 변수
$.fn.DataTable.ext.pager.numbers_length = 20; //버튼 갯수 설정

$(document).ready(function() {
    //데이터 테이블 시작
    var isFirstDataTable = true;
    $("#dataTable").DataTable({
        dom: '<"row min-w500"<"col-6 col-sm-6 col-md-4"f><"col-2 col-sm-1 col-md-1"B>>r<"row"<"col-sm-12"t>><"row min-w1000"<"col-2 col-lg-2"i><"col-10 col-lg-10 page-center"p>>',
        pageLength: 15,
        bLengthChange: false,
        language: {
            "info": "_START_ ~ _END_     (_TOTAL_)",
        },
        order: [
            [3, 'desc']
        ],
        oLanguage: {
            "sSearch": ""
        },
        buttons: ['excel'],
        fnDrawCallback: function() {
            if (isFirstDataTable) {
                var btnHtml =
                    '<div class="col-4 col-sm-5 col-md-7"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userRegModal">사용자등록</button></div>';
                var firstDiv = $("#dataTable_wrapper .row").first();
                firstDiv.prepend(btnHtml);
                isFirstDataTable = false;
                $('.card-body').removeClass("d-none");
            }
        },
    });

})




//기존값과 수정값 체크하는 함수
function editChangeCheck() {
    var userId = $("#formEdit input[name=userId]").val();
    var userName = $("#formEdit input[name=userName]").val();
    var userLevel = $("#formEdit select[name=userLevel]").val();
    var userUse = $('#formEdit  input:radio[name="userUse"]:checked').val();
    var userPwCheck = true;
    var userPw = $("#formEdit input[name=userPw]").val();
    if (userPw != "") {
        userPwCheck = false;
    }
    if (editUserId == userId && editUserName == userName && editUserUse == userUse && editUserLevel == userLevel &&
        userPwCheck) {
        return false;
    } else {
        return true;
    }
}

//사용자 버튼 클릭 submit이벤트
formReg.addEventListener('submit', (e) => {
    e.preventDefault();
    var forntCheck = $("#formReg .checkValue").hasClass("is-invalid");
    if (!forntCheck) {
        const payload = new FormData(formReg);
        fetch('user/addUser', {
                method: 'POST',
                cache: 'no-cache',
                body: payload,
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    alert("등록되었습니다.");
                    location.href = "./user"
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

//차량 수정 버튼 클릭 submit이벤트이벤트
formEdit.addEventListener('submit', (e) => {
    e.preventDefault();
    var forntCheck = $("#formEdit .checkValue").hasClass("is-invalid");
    console.log(editChangeCheck());
    if (!forntCheck && editChangeCheck()) {
        if (confirm("정말로 수정 하시겠습니까?")) {
            const payload = new FormData(formEdit);
            fetch('user/editUser', {
                    method: 'POST',
                    cache: 'no-cache',
                    body: payload,
                })
                .then(res => res.json())
                .then(data => {
                    if (data) {
                        alert("수정되었습니다.");
                        location.href = "./user"
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

//서버체크 아이디 중복 체크 후 처리
function serverIdCheck(em, isValid) {
    console.log(em, isValid);
    em.attr("class", "form-control checkValue");
    if (isValid) {
        em.addClass("is-valid");
    } else {
        em.addClass("is-invalid");
    }
}

//비밀번호 확인을 먼저 입력 할 경우 처리
$("#userRegModal Input[name=userPw1]").focus(function() {
    var userPw = $("#userRegModal Input[name=userPw]");
    if (userPw.val() == "") {
        alert("비밀번호를 먼저 입력해주세요");
        $(this).val("");
        userPw.focus();
        return false;
    }
    console.log("포카스");
})

//필수값 입력했을 때 중복 또는 비밀번호가 맞는지 확인하는 이벤트
$(".checkValue").change(function() {
    var formGroup = $(this).parent().parent();
    var name = $(this).attr("name");
    var val = $(this).val();
    var resData = new Object();
    resData["value"] = val;
    if (name == "userId") {
        fetch('user/getUserIdCheck', {
                method: 'POST',
                cache: 'no-cache',
                body: JSON.stringify(resData),
            })
            .then(res => res.json())
            .then(data => {
                serverIdCheck($(this), data);
            })
            .catch(error => console.log(error));
    } else if (name == "userPw") {
        var pw1 = formGroup.next().find("input");
        if (pw1.val() != "") {
            pw1.val("");
        }
        serverIdCheck($(this), true);
    } else if (name == "userPw1") {
        var pwVal = formGroup.prev().find("input").val();
        if (pwVal == val) {
            serverIdCheck($(this), true);
        } else {
            serverIdCheck($(this), false);
        }
    } else if (name == "userName") {}

})

//등록모달 닫았을때 이벤트
$('#userRegModal,#userEditModal').on('hidden.bs.modal', function() {
    $(".checkValue").attr("class", "form-control checkValue");
    $("input[type=text],input[type=password]").val("");
    $("select[name=userLevel]").val(2);
    $("input[name=userUse]").eq(0).prop("checked", true);
    $("#pwCheck").prop('checked', false);
    $("#formEdit input[name=userPw],#formEdit input[name=userPw1]").attr("disabled", true);
})

//수정 버튼 클릭이벤트
$(document).on("click", ".userEditBtn", function() {
    var userInfoTd = $(this).parent().parent().find("td");
    editUserId = userInfoTd.eq(0).text();
    editUserName = userInfoTd.eq(1).text();
    var editUserLevelValue = userInfoTd.eq(2).text();
    editUserUse = userInfoTd.eq(4).text();
    editUserLevel = $('#formEdit select[name=userLevel] option:contains(' + editUserLevelValue + ')').val();
    if (editUserId === "test") {
        $("#formEdit select[name=userLevel]").prop("disabled", true);
    } else {
        $("#formEdit select[name=userLevel]").prop("disabled", false);
    }

    $("#formEdit select[name=userLevel]").val(editUserLevel);
    if (editUserUse == "Y") {
        $("#formEdit input[name=userUse]").eq(0).prop("checked", true);
    } else {
        $("#formEdit input[name=userUse]").eq(1).prop("checked", true);
    }
    $("#formEdit input[name=userId]").val(editUserId);
    $("#formEdit input[name=userName]").val(editUserName);

});


//삭제 버튼 클릭이벤트
$(document).on("click", ".userDelBtn", function() {
    var userId = $(this).parent().parent().find("td").eq(0).text();
    if (confirm("아이디 :" + userId + "를 삭제 하시겠습니까?")) {
        var resData = new Object();
        resData["userId"] = userId;
        fetch('user/delUser', {
                method: 'POST',
                cache: 'no-cache',
                body: JSON.stringify(resData),
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    alert("삭제되었습니다.");
                    location.href = "./user"
                } else {
                    alert("삭제되지 않았습니다. 다시 시도해 주세요!");
                }
            })
            .catch(error => console.log(error));
    } else {
        return false;
    }
});


//비밀번호 변경 체크박스 클릭이벤트
$("#pwCheck").click(function() {
    var chk = !$(this).is(':checked');
    $("#formEdit input[name=userPw],#formEdit input[name=userPw1]").attr("class", "form-control checkValue");
    $("#formEdit input[name=userPw]").val("");
    $("#formEdit input[name=userPw1]").val("");
    $("#formEdit input[name=userPw]").attr("disabled", chk);
    $("#formEdit input[name=userPw1]").attr("disabled", chk);
});
</script>