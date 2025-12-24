<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">
        table{
            width: 800px;
            margin: auto;
            text-align: center;
        }
        tr, th, td {
            border: 1px solid;
        }
        h1{
            text-align: center;
            color: red;
        }
        #button{
            margin: 2px;
            margin-right: 10px;
            float: right;
        }
    </style>
</head>
<body>

<?php 
// Kết nối database
include 'connect.php';

// Lấy dữ liệu cầu thủ
$sql = "SELECT * FROM cauthu ORDER BY id";
$result = $con->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$html = '';
foreach ($data as $value) {
    $html .= '
    <tr>
        <td>'.$value['id'].'</td>
        <td>'.$value['ten_cauthu'].'</td>
        <td>'.$value['tuoi'].'</td>
        <td>'.$value['quoc_tich'].'</td>
        <td>'.$value['vi_tri'].'</td>
        <td>'.$value['luong'].' $</td>
        <td><a href="edit.php?id='.$value['id'].'">Edit</a></td>
        <td>
            <a href="delete.php?id='.$value['id'].'"
               onclick="return confirm(\'Bạn có chắc muốn xóa cầu thủ này không?\')">
               Delete
            </a>
        </td>
    </tr>';
}

?>

<h1>Quản lý cầu thủ</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên cầu thủ</th>
            <th>Tuổi</th>
            <th>Quốc tịch</th>
            <th>Vị trí</th>
            <th>Lương</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $html; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8">
                <a href="add.php"><button id="button">Thêm cầu thủ</button></a>
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>
