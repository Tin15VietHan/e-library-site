<?php require('layouts/header.php'); ?>
<?php require('./../connect.php');
// Đóng kết nối
mysqli_close($conn);
?>
<div class="content-wrapper" style="min-height: 365px;">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><b>TRANG CHỦ</b></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active">Admin</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="muon-sach">
		<h1>MƯỢN SÁCH</h1>
		<div class="row">
			<div class="col-6 taohoadon">
				<form name="muonsach" action="" id="FormHD">
					<div class="form-group">
						<label for="">Mã Sinh Viên</label>
						<input type="text" id="masv">
					</div>
					<div class="form-group">
						<label for="">Tên Sinh Viên Mượn Sách</label>
						<input type="text" id="tensv">
					</div>
					<div class="form-group">
						<label for="">Số Điện Thoại</label>
						<input type="text" id="sdt">
					</div>
					<div class="form-group">
						<label for="">Địa Chỉ</label>
						<input type="text" id="diachi">
					</div>
					<div class="form-group">
						<label for="">Sách</label>
						<div id="inputContainer">
							<input type="text"class="autocomplete-sach"  id="sach"> <br>
						</div>
						<i id="addbook" class='bx bx-plus-circle' style="font-size: 25px; margin-top: 10px; margin-left: 49%; width: 100%;"></i>
					</div>
					<div class="form-group">
						<label for="">Ngày Mượn</label>
						<input type="text" id="diachi" value="<?php $currentDate = date('Y-m-d');
																echo "$currentDate"; ?>" readonly>
					</div>

					<div class="form-group">
						<label for="">Ngày Hẹn Trả</label>
						<input type="date" id="ngayhentra">
					</div>

					<input type="submit" name="" id="" value="Tạo Phiếu Mượn">
				</form>
			</div>
			<div class="col-6">
				<div class="container" id="printContent" style="display: block !important;">
					<div class="header">
						<div class="title">PHIẾU MƯỢN SÁCH</div>
						<div><strong>E-library</strong> </div>
						<div>Số 8 Hồ Tông Thốc, Nghi Phú, Thành Phố Vinh, Nghệ An</div>
						<div>SĐT: 0799339567 – 0876492111</div>
					</div>
					<div class="info">
					    <div id="htmasv">Mã Sinh Viên: </div>
						<div id="htnguoimuon">Người mượn: </div>
						<div id="htsdt">Số Điện Thoại:</div>
						<div id="htdiachi">Địa chỉ: </div>
					</div>
					<div class="book">
						<table class="table">
							<thead>
								<tr>
									<th style="width: 50%;">Sách</th>
									<th>Ngày mượn</th>
									<th>Ngày hẹn trả</th>
								</tr>
							</thead>
							<tbody>
								<td>
									<div id="htsach" style="text-align: left; ">Sách</div>
								</td>
								<td><?php echo $currentDate; ?></td>
								<td>
									<div id="htngayhentra"></div>
								</td>
							</tbody>
						</table>
					</div>
					<div class="footer" style="margin-top: 70px; ">
						<p style="margin-right: 30px">Người tạo phiếu</p>
						<p class="signature"><?php $fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'ad';echo $fullname ?></p>
					</div>

				</div>

				<button class="printButton" onclick="printContent()">Print</button>
			</div>

		</div>

	</div>
</div>
<?php require('layouts/footer.php'); ?>


<script>
// Bắt sự kiện khi nhấn vào nút "+"
// Biến cờ để kiểm tra xem đã thêm hàng mới hay chưa
var isNewRowAdded = false;

// Sự kiện click của button "+"
document.getElementById("addbook").addEventListener("click", function() {
    // Kiểm tra nếu chưa thêm hàng mới
    if (!isNewRowAdded) {
        var inputContainer = document.getElementById("inputContainer");
        var newInput = document.createElement("input");
        newInput.type = "text";
        newInput.className = "autocomplete-sach";
        newInput.style.marginTop = "10px";
        inputContainer.appendChild(newInput);
        inputContainer.appendChild(document.createElement("br"));

        // Gọi lại hàm tạo dữ liệu gợi ý cho input mới
        createAutocompleteForNewInput(newInput);

        // Đặt giá trị của biến cờ thành true
        isNewRowAdded = true;
    }
});

// Xử lý khi form được gửi đi
document.getElementById('FormHD').addEventListener('submit', function(event) {
    // Đặt lại giá trị của biến cờ thành false
    isNewRowAdded = false;
    // Các xử lý khác ở đây...
});



</script>


<script>
	document.getElementById('FormHD').addEventListener('submit', function(event) {
		// Ngăn chặn việc gửi biểu mẫu đi
		// Hiển thị thông báo xác nhận trước khi submit
		event.preventDefault();
		var ValueMaSv = document.getElementById('masv').value;
		var ValueNguoiMuon = document.getElementById('tensv').value;
		var ValueSdt = document.getElementById('sdt').value;
		var ValueDiaChi = document.getElementById('diachi').value;
		var ValueNgayHenTra = document.getElementById('ngayhentra').value;

		
		document.getElementById('htmasv').innerText = "Mã Sinh Viên: " + ValueMaSv;
		document.getElementById('htnguoimuon').innerText = "Người Mượn: " + ValueNguoiMuon;
		document.getElementById('htsdt').innerText = "Số Điện Thoại: " + ValueSdt;
		document.getElementById('htdiachi').innerText = "Địa Chỉ: " + ValueDiaChi;
		document.getElementById('htngayhentra').innerText = ValueNgayHenTra;

		var ValueSach = document.querySelectorAll('input.autocomplete-sach'); // Lấy tất cả các phần tử input có id là "sach"
		var output = "";
		for (var i = 0; i < ValueSach.length; i++) {
			output +=ValueSach[i].value + "<br> </br> ";
		}
		document.getElementById('htsach').innerHTML = output;
	});
</script>


<script>
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
</script>


<script>
	$('#FormHD').submit(function(event) {
    // Ngăn chặn sự kiện mặc định của form
    event.preventDefault();
	var confirmation = confirm("Vui lòng kiểm tra lại dữ liệu trước khi tạo hóa đơn, hóa đơn này sẽ được lưu vào hệ thống ngay sao đó");
		if (confirmation) {
    // Lấy giá trị từ các trường input
    var ValueMaSv = $('#masv').val();
    var ValueNguoiMuon = $('#tensv').val();
    var ValueSdt = $('#sdt').val();
    var ValueDiaChi = $('#diachi').val();
    var ValueNgayHenTra = $('#ngayhentra').val();

    // Tạo một mảng để lưu các giá trị của trường sách
    var sachArr = [];
    $('#inputContainer input').each(function() {
        sachArr.push($(this).val());
    });
    var ValueSach = sachArr.join(', ');

    // Gửi dữ liệu bằng AJAX
    $.ajax({
        type: 'POST',
        url: 'them_nguoi_muon.php',
        data: {
            masv: ValueMaSv,
            nguoimuon: ValueNguoiMuon,
            sdt: ValueSdt,
            diachi: ValueDiaChi,
            ngayhentra: ValueNgayHenTra,
            sach: ValueSach,
        },
        success: function(response) {
            // Xử lý kết quả từ máy chủ (nếu cần)
            alert(response); // Hiển thị thông báo từ máy chủ
			console.log(sachArr);

        },
        error: function() {
            // Xử lý lỗi nếu có
            alert('Đã xảy ra lỗi khi gửi dữ liệu.');
        }
    });
}
});


</script>
<script>
    // Thêm sự kiện change cho ô nhập mã sinh viên
   // Sử dụng sự kiện "blur" cho ô nhập mã sinh viên để bắt sự kiện khi người dùng nhập xong
$('#masv').on('blur', function() {
    var masv = $(this).val();
    $.ajax({
        type: 'POST',
        url: 'them_nguoimuonsach.php', // Địa chỉ xử lý AJAX trên máy chủ
        data: { masv: masv }, // Gửi mã sinh viên lên máy chủ
        success: function(response) {
            // Xử lý kết quả trả về từ máy chủ
            var data = JSON.parse(response);
            $('#tensv').val(data.tensv); // Cập nhật tên người mượn
            $('#sdt').val(data.sdt); // Cập nhật số điện thoại
            $('#diachi').val(data.diachi); // Cập nhật địa chỉ
        },
        error: function() {
            // Xử lý lỗi nếu có
            alert('Đã xảy ra lỗi khi lấy thông tin người mượn.');
        }
    });
});

</script>


<script>

// Hàm tạo dữ liệu gợi ý cho input mới
function createAutocompleteForNewInput(input) {
    $(input).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timsach.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    var formattedData = data.map(function(item) {
                        return { label: item, value: item };
                    });
                    response(formattedData);
                }
            });
        },
        open: function(event, ui) {
            var autocompleteList = $(this).data("ui-autocomplete").menu.element;
            autocompleteList.css("overflow-y", "auto"); // Tạo thanh cuộn khi nội dung dài hơn chiều cao tối đa
            autocompleteList.css("width", "41%"); // Tạo thanh cuộn khi nội dung dài hơn chiều cao tối đa
            autocompleteList.css("overflow-x", "hidden"); // Ẩn thanh cuộn ngang
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div>" + item.label + "</div>")
            .appendTo(ul);
    };
}

// Gọi hàm tạo dữ liệu gợi ý cho tất cả các input hiện có
$(".autocomplete-sach").each(function() {
    createAutocompleteForNewInput(this);
});



</script>