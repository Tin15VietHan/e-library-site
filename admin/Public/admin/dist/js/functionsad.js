document.getElementById("addbook").addEventListener("click", function() {
    var inputContainer = document.getElementById("inputContainer");
    var newInput = document.createElement("input");
    newInput.type = "text";
    newInput.id = "sach"; // Để giữ nguyên id, bạn có thể sử dụng id động
    newInput.style.marginTop = "10px"; // Thêm margin-top
    inputContainer.appendChild(newInput);
    inputContainer.appendChild(document.createElement("br"));
});


document.getElementById('FormHD').addEventListener('submit', function(event) {
    event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu đi

    var ValueNguoiMuon = document.getElementById('nguoimuon').value;
    var ValueSdt = document.getElementById('sdt').value;
    var ValueDiaChi = document.getElementById('diachi').value;
    var ValueNgayHenTra = document.getElementById('ngayhentra').value;



    document.getElementById('htnguoimuon').innerText = "Người Mượn: " + ValueNguoiMuon;
    document.getElementById('htsdt').innerText = "Số Điện Thoại: " + ValueSdt;
    document.getElementById('htdiachi').innerText = "Địa Chỉ: " + ValueDiaChi;
    document.getElementById('htngayhentra').innerText = ValueNgayHenTra;
    //document.getElementById('htsach').innerText =  ValueSach;

    var ValueSach = document.querySelectorAll('input#sach'); // Lấy tất cả các phần tử input có id là "sach"
    var output = "";
    for (var i = 0; i < ValueSach.length; i++) {
        output += (i + 1) + ": " + ValueSach[i].value + "<br>";
    }
    document.getElementById('htsach').innerHTML = output;

});

var printed = false; // Biến cờ để xác định đã in hoặc hủy in

function printContent() {
    var contentToPrint = document.getElementById("printContent").innerHTML;
    var originalBody = document.body.innerHTML;
    document.body.innerHTML = contentToPrint;
    window.print();
    document.body.innerHTML = originalBody;

    // Bắt sự kiện sau khi in
    window.onafterprint = function(event) {
        // Xử lý sau khi in hoặc hủy in
        printed = true;
        // Nếu đã in hoặc hủy in, chờ 1 giây trước khi chuyển hướng
        setTimeout(function() {
            location.reload();
        }, 100);
    };
}

// Xử lý khi trang đã được in hoặc hủy in
window.addEventListener("afterprint", function(event) {
    if (!printed) {
        // Xử lý khi người dùng hủy in
        printed = true;
        // Nếu đã in hoặc hủy in, chờ 1 giây trước khi chuyển hướng
        setTimeout(function() {
            location.reload();
        }, 100);
    }
});