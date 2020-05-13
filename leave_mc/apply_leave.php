<?php
if(isset($_GET['apply'])&&isset($_GET['leave'])){
    require 'conn.php';
    $leave=$_GET['leave'];
    $get_leave=mysqli_query($conn,"select * from leave_log where leave_id='$leave'");
    if(mysqli_num_rows($get_leave)!=0){
        mysqli_query($conn,"update leave_log set status='APPROVED' where leave_id='$leave'");
        mysqli_query($conn,"update leave_log set status='REJECTED' where leave_id='$leave'");
    }
}else{

}
?>