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
                    <h1 class="m-0 text-dark"><b style="color:#1E90FF">TRANG CHỦ</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm banner thông tin ở đây -->
    <div class="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h2>Chào mừng đến với E-library</h2>
                        <p>Thư viện trực tuyến hàng đầu cung cấp hàng ngàn đầu sách phong phú. Hãy mượn sách và tận hưởng trải nghiệm đọc tuyệt vời!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="muon-sach">
        <h1>MƯỢN SÁCH</h1>
        <div class="row">
            <div class="col-6 taohoadon">
                <form name="muonsach" id="FormHD">
                    <div class="form-group">
                        <label for="madocgia">Mã Độc Giả</label>
                        <input type="text" class="autocomplete-madocgia" id="madocgia" onblur="getDocGiaInfo()">
                    </div>
                    <div class="form-group">
                        <label for="tensv">Tên Độc Giả Mượn Sách</label>
                        <input type="text" class="autocomplete-hoten" id="hoten">
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số Điện Thoại</label>
                        <input type="text" class="autocomplete-sdt" id="sdt">
                    </div>
                    <div class="form-group">
                        <label for="diachi">Địa Chỉ</label>
                        <input type="text" class="autocomplete-diachi" id="diachi">
                    </div>
                    <div class="form-group">
                        <label for="sach">Sách</label>
                        <div id="inputContainer">
                            <input type="text" class="autocomplete-sach" id="sach"><br>
                        </div>
                        <i id="addbook" class='bx bx-plus-circle' style="font-size: 25px; margin-top: 10px; margin-left: 49%; width: 100%;"></i>
                    </div>
                    <div class="form-group">
                        <label for="ngaymuon">Ngày Mượn</label>
                        <input type="text" id="ngaymuon" value="<?php echo date('d/m/Y'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ngayhentra">Ngày Hẹn Trả</label>
                        <input type="date" id="ngayhentra">
                    </div>
                    <input type="submit" value="Tạo Phiếu Mượn">
                </form>
            </div>
            <div class="col-6" style="margin-bottom: 5px; border-radius: 6px; padding: 15px; border: 1px solid #b2bec3;">
                <div class="container" id="printContent" style="display: block !important;">
                    <div class="header">
                        <div class="title">PHIẾU MƯỢN SÁCH</div>
                        <div><strong>E-Library Việt Hàn</strong></div>
                        <div>Số 8 Hồ Tông Thốc, Nghi Phú, Thành Phố Vinh, Nghệ An</div>
                        <div>SĐT: 0799339567 – 0876492111</div>
                    </div>
                    <div class="info">
                        <div id="htmadocgia">Mã Độc Giả: </div>
                    </div>
                    <div class="info">
                        <div id="hthoten">Người mượn: </div>
                    </div>
                    <div class="info">
                        <div id="htsdt">Số Điện Thoại: </div>
                    </div>
                    <div class="info">
                        <div id="htdiachi">Địa Chỉ: </div>
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
                                <tr>
                                    <td id="htsach"></td>
                                    <td><?php echo date('d/m/Y'); ?></td>
                                    <td id="htngayhentra"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer" style="margin-top: 70px;">
                        <p style="margin-right: 30px">Người tạo phiếu</p>
                        <p class="signature"><?php echo isset($_SESSION['hoten']) ? $_SESSION['hoten'] : 'admin'; ?></p>
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
// Xử lý khi form được gửi đi
document.getElementById('FormHD').addEventListener('submit', function(event) {
    event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu đi
    event.preventDefault();
    var confirmation = confirm("Vui lòng kiểm tra lại dữ liệu trước khi tạo hóa đơn, hóa đơn này sẽ được lưu vào hệ thống ngay sau đó!");
    if (confirmation) {
    var madocgia = document.getElementById('madocgia').value;
    var hoten = document.getElementById('hoten').value;
    var sdt = document.getElementById('sdt').value;
    var diachi = document.getElementById('diachi').value;
    var ngayhentra = document.getElementById('ngayhentra').value;
    var books = document.querySelectorAll('.autocomplete-sach');
    var booksArray = Array.from(books).map(book => book.value).filter(book => book.trim() !== '');};

    document.getElementById('htmadocgia').innerText = "Mã Độc Giả: " + madocgia;
    document.getElementById('hthoten').innerText = "Người mượn: " + hoten;
    document.getElementById('htsdt').innerText = "Số Điện Thoại: " + sdt;
    document.getElementById('htdiachi').innerText = "Địa Chỉ: " + diachi;
    document.getElementById('htngayhentra').innerText = ngayhentra;
    document.getElementById('htsach').innerHTML = booksArray.join('<br>');

    // Thực hiện gửi dữ liệu bằng AJAX nếu cần
    $.ajax({
        type: 'POST',
        url: 'them_nguoi_muon.php',
        data: {
            madocgia: madocgia,
            hoten: hoten, // Cập nhật tên biến ở đây để trùng khớp với tên trong PHP
            sdt: sdt,
            diachi: diachi,
            ngayhentra: ngayhentra,
            sach: booksArray
        },
        success: function(response) {
            // Xử lý kết quả từ máy chủ nếu cần
            alert(response);
        },
        error: function() {
            // Xử lý lỗi nếu có
            alert('Đã xảy ra lỗi khi gửi dữ liệu.');
        }
    });
});


function printContent() {
    var contentToPrint = document.getElementById("printContent").innerHTML;
    var originalBody = document.body.innerHTML;
    document.body.innerHTML = contentToPrint;
    window.print();
    document.body.innerHTML = originalBody;
    setTimeout(function() {
        location.reload();
    }, 100);
}

function createAutocompleteForNewInput(input) {
    $(input).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timsach.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });
}

function getDocGiaInfo() {
    var madocgia = document.getElementById('madocgia').value;
    if (madocgia.trim() !== "") {
        $.ajax({
            type: 'POST',
            url: 'them_nguoimuonsach.php',
            data: { madocgia: madocgia },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    document.getElementById('hoten').value = response.data.hoten;
                    document.getElementById('sdt').value = response.data.sdt;
                    document.getElementById('diachi').value = response.data.diachi;
                } else {
                    alert('Không tìm thấy thông tin độc giả.');
                }
            },
            error: function() {
                alert('Đã xảy ra lỗi khi lấy thông tin độc giả.');
            }
        });
    }
}



// Khởi tạo autocomplete cho các trường input mặc định
$(document).ready(function() {
    $('.autocomplete-madocgia').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timdocgia.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });
    document.getElementById('addbook').addEventListener('click', function() {
    var inputContainer = document.getElementById('inputContainer');
    var newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.className = 'autocomplete-sach';
    newInput.style.marginTop = '10px';
    inputContainer.appendChild(newInput);
    $(newInput).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timsach.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });
});


    $('.autocomplete-sinhvien').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timtensv.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });

    $('.autocomplete-sdt').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timsdt.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });

    $('.autocomplete-diachi').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timdiachi.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });

    $('.autocomplete-sach').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "timsach.php",
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data.map(item => ({ label: item, value: item })));
                }
            });
        }
    });
});

</script>


