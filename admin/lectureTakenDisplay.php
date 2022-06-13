<?php
    include 'header.php'; 
    $curr_date = date("Y-m-d");
?>

<br>
<br>

<div>

    <h2>Lectures Conducted</h2><br>


    <table style="width:100%; text-align:center;">

        <thead>

        <?php

            $sqlS = $conn -> prepare("SELECT * FROM lecture_entry WHERE sdate <= '$curr_date' AND conducted = 1 ORDER BY sdate");
            $sqlS -> execute();
            $result1 = $sqlS -> get_result();

            if(mysqli_num_rows($result1) > 0){

        ?>

        <th><h3>Tutor ID</h3></th>

        <th><h3>Student ID</h3></th>

        <th><h3>Subject</h3></th>

        <th><h3>Date</h3></th>

        <!-- <th><h3>Time</h3></th> -->

        <th><h3>Duration</h3></th>

        <th><h3>Payment</h3></th>

        </thead>

        <tbody>

            <?php

                while($row1 = $result1 -> fetch_assoc()){

            ?>

            <tr> 

                <td><?php echo "TUT" . $row1['tutor_id']; ?> </td> 

                <td><?php echo "STU" . $row1['stu_id']; ?> </td>

                <td><?php echo $row1['subject']; ?> </td>
                
                <td><?php echo date("d-m-Y", strtotime($row1['sdate'])); ?> </td>
                
                <!-- <td><?php 
                $stime = date('h:i A', strtotime($row1['stime']));
                echo $stime; 
                ?> </td> -->

                <td><?php echo $row1['duration']; ?> </td> 

                <td>
                    <?php 
                        if($row1['payment'] == false){
                            echo "Unsuccessfull";
                        }else{
                            echo "Successfull";
                        } 
                    ?> 
                </td> 

            </tr>

            
            <?php 
            } 
            $sqlS -> close();
            }else{
                echo "<h4>No Records Found.</h4>";
            } 
            ?>

        </tbody>
        
    </table>


</div>
<br>
<br>
<br>
<br>

<div>

    <h2>Pending Lectures</h2><br>


    <table style="width:100%; text-align:center;">

        <thead>

        <?php

            
            $sql = $conn -> prepare("SELECT * FROM lecture_entry WHERE conducted = 0 AND sdate > '$curr_date' ORDER BY sdate");
            $sql -> execute();
            $result2 = $sql -> get_result();

            if(mysqli_num_rows($result2) > 0){

        ?>

        <th><h3>Tutor ID</h3></th>

        <th><h3>Student ID</h3></th>

        <th><h3>Subject</h3></th>

        <th><h3>Date</h3></th>

        <th><h3>Time</h3></th>

        <th><h3>Duration</h3></th>

        <!-- <th><h3>Payment</h3></th> -->

        </thead>

        <tbody>

            <?php

                while($row2 = $result2 -> fetch_assoc()){

            ?>

            <tr> 

                <td><?php echo "TUT" . $row2['tutor_id']; ?> </td> 

                <td><?php echo "STU" . $row2['stu_id']; ?> </td>

                <td><?php echo $row2['subject']; ?> </td>
                
                <td><?php echo date("d-m-Y", strtotime($row2['sdate'])); ?> </td>
                
                <td><?php echo date('h:i A', strtotime($row2['stime']));?> </td>

                <td><?php echo $row2['duration']; ?> </td> 

                <!-- <td>
                    <?php 
                        if($row2['payment'] == false){
                            echo "Unsuccessfull";
                        }else{
                            echo "Successfull";
                        } 
                    ?> 
                </td>  -->

            </tr>

            
            <?php 
            } 
            $sqlS -> close();
            }else{
                echo "<h1>No Records</h1>";
            } 
            ?>

        </tbody>
        
    </table>


</div>

<?php
    include "../footer.php";
?>
