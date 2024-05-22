const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
const handeFormSubmit = () => { // arrow funtion
    // Nếu mà điều kiện cần kiểm tra là thỏa mãn => return true;
    let checkValidate = true;
    let username =  $("input[name=username]").val().trim();
   
    let email = $("input[name=email]").val().trim();
    let fullname =  $("input[name=fullname]").val().trim();
    let password =  $("input[name=password]").val().trim();
    let re_password =  $("input[name=re_password]").val().trim();
    let phone = $("input[name=phone]").val();
    let gender = $("input[name=gender]:checked").val();
    let birthday = $("input[name=birthday]").val(); 
   
    // Check validate của username
    if(!username){ // có ! là không có giá trị hoặc là false
        alert("Tên đăng nhập không được để trống");
        return false;
    } else if(username.indexOf(' ') >= 0) { // Kiểm tra tên chỉ được viết liền không có khoảng trắng
        alert("Tên đăng nhập không được chứa ký tự khoảng trắng");
        return false;
    }

    // Check validate của email
    if(!email) {
        alert ("Email không được để trống");
        return false;
    }  else if (!email.match(validRegex)) {// kiểm tra có phải là mail không
        alert("Không đúng định dạng email");
        return false;
    }
    if(!fullname){ 
        alert("Tên đầy đủ không được để trống");
        return false;
    } 

    if(!password){ 
        alert("Mật khẩu không được để trống");
        return false;
    } else if (password.length < 3 || password.length > 15) {
        alert("Mật khẩu phải có độ dài từ 3 đến 15 ký tự");
        return false;
    }

    
    if(re_password !== password){ 
        alert("Mật khẩu không khớp");
        return false;
    }  

    if(!phone){ 
        alert("Số điện thoại không được để trống");
        return false;
    } else if(!isNum(phone)) {
        alert("Số điện thoại phải là số");
        return false;
    } else if(phone.length !== 10){
        alert("Số điện thoại phải có 10 số");
        return false;
    }


    if(!birthday){ 
        alert("Ngày sinh không được để trống");
        return false;
    } else if(!Date.parse(birthday)) {
        alert("Ngày sinh chưa điền đủ thông tin");
        return false;
    }



    // Check validate fullname => không được để trống
    // Check validate password => không được để trống, min: 3 ký tự, max: 15 ký tự
    // Check validate re_password => không được khác password
    // Check validate phone => không được bỏ trống, phải là số, đủ 10 ký tự
    // Check validate birthday => không được bỏ trống





    /**
     * const => hằng số => khai báo 1 lần duy nhất và được án giá trị => ko thay đổi được giá vị
     *  */ 
    
    return true;
}
console.log('xxxxx')


// Hàm kiểm tra định dạng email
function isValidEmail(email) {
    // Biểu thức chính quy kiểm tra định dạng email
    const emailPattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
    return emailPattern.test(email);
}

// Thêm sự kiện 'blur' cho trường email để kiểm tra định dạng khi rời khỏi trường nhập liệu
document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    const emailHelp = document.getElementById('emailHelp');
    if (!isValidEmail(email)) {
        emailHelp.textContent = 'Email không hợp lệ. Vui lòng nhập email định dạng @gmail.com';
        emailHelp.style.color = 'red';
    } else {
        emailHelp.textContent = '';
    }
});

// Kiểm tra email khi submit form
document.getElementById('FormHD').addEventListener('submit', function(event) {
    const email = document.getElementById('email').value;
    const emailHelp = document.getElementById('emailHelp');
    if (!isValidEmail(email)) {
        emailHelp.textContent = 'Email không hợp lệ. Vui lòng nhập email định dạng @gmail.com';
        emailHelp.style.color = 'red';
        event.preventDefault(); // Ngăn không cho form gửi đi
        document.getElementById('email').focus(); // Di chuyển con trỏ đến trường email
    }
});


