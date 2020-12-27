<?php
include('../includes/connection.php');

$cid = $_POST['catID'];
$qry = "select * from tblproduct where catID='$cid'";
$res = mysqli_query($con, $qry) or die("q error");
?>
<table border="1">
    <thead>
        <tr>
            <th>pname</th>
            <th>quantity</th>
            <th>price</th>
            <th>img</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $row['pname']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><img src="<?php echo "../images/" . $row['img']; ?>" /></td>
            </tr>
        <?php } ?>
    </tbody>
</table>