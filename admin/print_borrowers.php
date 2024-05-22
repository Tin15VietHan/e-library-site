<?php
require('./../connect.php');

// Query to get borrower information
$sqlBorrowers = "
    SELECT ms.id, ms.ngay_muon, ms.ngay_han_tra, dg.ten_nguoi_muon, s.sach_muon
    FROM muon_sach ms
    JOIN docgia dg ON ms.docgia_id = dg.id
    JOIN sach s ON ms.sach_id = s.id
    WHERE ms.trang_thai = 'Đang Mượn'
    ORDER BY ms.ngay_muon DESC";

$resultBorrowers = mysqli_query($conn, $sqlBorrowers);

// Check if the query was successful
if ($resultBorrowers) {
    // Display the borrower information
    echo "<h1>Borrower Information</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Borrow Date</th><th>Return Date</th><th>Borrower Name</th><th>Book Name</th></tr>";
    while ($row = mysqli_fetch_assoc($resultBorrowers)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['ngay_muon']}</td>";
        echo "<td>{$row['ngay_han_tra']}</td>";
        echo "<td>{$row['hoten']}</td>";
        echo "<td>{$row['sach_muon']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
