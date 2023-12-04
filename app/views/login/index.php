<div class="container pt-10rem">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10 col-md-9">
            <div class="card border-0 shadow-light my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-md-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 mb-4">소방차 모니터링</h1>
                                </div>
                                <form id="formLogin">
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-login" placeholder="아이디"
                                            name="userId" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-login" name="userPw"
                                            placeholder="비밀번호" autocomplete="off" required>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-login">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
const formReg = document.getElementById('formLogin');
//사용자 버튼 클릭 submit이벤트
formReg.addEventListener('submit', (e) => {
    e.preventDefault();
    const payload = new FormData(formReg);
    fetch('login/login', {
            method: 'POST',
            cache: 'no-cache',
            body: payload,
        })
        .then(res => res.json())
        .then(data => {
            if (data == 0) {
                alert("아이디를 확인해 주세요");
            } else if (data == 1) {
                alert("비밀번호를 확인해 주세요");
            } else if (data == 2) {
                alert("사용중지된 아이디입니다. 관리자에게 문의 하세요");
            } else if (data == 3) {
                location.href = "./"
            }
        })
        .catch(error => console.log(error));
});
</script>