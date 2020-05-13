<link rel="stylesheet" href="css/show-timetable.css"> 
<?php
if(isset($_GET['fromdate'])&&isset($_GET['todate'])){
    $fromdate=date_create($_GET['fromdate']);
    $todate=date_create($_GET['todate']);
    if($fromdate<$todate){
        $todate->modify('+1 day');
        require 'conn.php';
        session_start();
        $s=$_SESSION['user'];
        $res=mysqli_query($conn,"SELECT * FROM tprofile WHERE user_id='$s'");
        $userRow=mysqli_fetch_assoc($res);
        $fromdate_value=date_format($fromdate,'Y-m-d');
        $todate_value=date_format($todate,'Y-m-d');
        
        $period=new DatePeriod(
            new DateTime($fromdate_value),
            new DateInterval('P1D'),
            new DateTime($todate_value)
        );
        ?>
                <table class='outer-table'><tr><th>Date</th><th>Day</th>

                <?php
                $get_sessions=mysqli_query($conn,"select * from sessions");
                $fetch_sessions=mysqli_fetch_assoc($get_sessions);
                for($i=1;$i<=$fetch_sessions['session'];$i++){
                    echo "<th><center>".$i." Period</center></th>";
                }
                ?>
                </tr>
                <?php
                foreach($period as $value){
                    
                    if($value->format('w')!=0){
                        echo "<tr>";
                        echo "<td>".$value->format('d-m-Y')."</td>";
                        $day_sno=$value->format('w');
                        $get_day=mysqli_query($conn,"select * from days where sno='$day_sno'");
                        while($get_fetch_day=mysqli_fetch_assoc($get_day)){
                            echo "<td>".$get_fetch_day['name']."</td>";
                        }
                        for($i=1;$i<=$fetch_sessions['session'];$i++){
                            $get_day=mysqli_query($conn,"select * from days where sno='$day_sno'");
                            $get_fetch_day=mysqli_fetch_assoc($get_day);
                            $day=$get_fetch_day['name'];
                            $self_id=$userRow['id'];
                            $getreserved_classes=mysqli_query($conn,"select * from timetable where tid='$self_id' and day='$day' and period='$i'");
                            if(mysqli_num_rows($getreserved_classes)!=0){
                                while($fetch_reserved_session=mysqli_fetch_assoc($getreserved_classes)){
                                        echo "<td class='sel' style='width:0px;height:0px;margin:0px;padding:0px'><select class='sel-inside' name='".$value->format('d-m-Y').$i."' style='width:100px' required><option value=''>-SELECT-</option>";
                                      
                                        $faculty_list=mysqli_query($conn,"select * from tprofile");
                                        while($fetch_faculty=mysqli_fetch_assoc($faculty_list)){
                                            $tid=$fetch_faculty['id'];
                                            $find_free=mysqli_query($conn,"select * from timetable where period='$i' and day='$day' and tid='$tid'");
                                            if(mysqli_num_rows($find_free)==0){
                                                echo "<option value='".$fetch_faculty['id']."'>";
                                                echo $fetch_faculty['name'];
                                                echo "</option>";
                                            }
                                        }
                                        echo"</select></td>";                     
                                }
                            }else{
                                echo "<td><center>No Class</center></td>";
                            }
                            
                            
                        }
                        echo "</tr>";
                    }else{
                        $day_sno=$value->format('w');
                        $get_day=mysqli_query($conn,"select * from days where sno='$day_sno'");
                        $get_fetch_day=mysqli_fetch_assoc($get_day);
                        // while($get_fetch_day=mysqli_fetch_assoc($get_day)){
                        //     echo "<td>".$get_fetch_day['name']."</td>";
                        // }
                        $rowspan=$fetch_sessions['session'];
                        echo "<tr><td>".$value->format('d-m-Y')."</td><td style='font-weight:bold'>SUNDAY</td><td colspan='".$rowspan."' style='height:30px;font-weight:bold'><center>Holiday</center></td></tr>";
                    }
                }
        echo "</table>";
    }else{
        echo "it is not fine";
    }
}
?>
