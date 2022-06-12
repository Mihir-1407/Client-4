<?php
    include 'header.php';
    $curr_date = date("Y-m-d");
?>

<div>
<div class="dispstu"><br><br>
<h2>Scheduled Lectures</h2><br>

<table style="width:100%; text-align:center;">

    <thead>
    
    <?php
        $conducted = false;
        $sdate = date("Y-m-d");
        $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE tutor_id = ? AND conducted = ? AND sdate >= ? ORDER BY sdate, stime");
        $sqlL -> bind_param("sss", $id, $conducted, $curr_date);
        $sqlL -> execute();
        $result = $sqlL -> get_result();

        if(mysqli_num_rows($result) > 0){

    ?>

    <th><h3>Lecture ID</h3></th>

    <th><h3>Student ID</h3></th>

    <th><h3>Subject</h3></th>

    <th><h3>Schedule Date</h3></th>

    <th><h3>Schedule Time</h3></th>

    <th><h3>Duration</h3></th>

    <th><h3>Form Link</h3></th>

    </thead>

    <tbody>

        <?php

            while($row = $result -> fetch_assoc()){

        ?>

        <tr>

            <td><?php echo $row['lec_id']; ?> </td> 

            <td><?php echo "STU" . $row['stu_id']; ?> </td> 

            <td><?php echo $row['subject']; ?> </td> 

            <td><?php echo date("d-m-Y", strtotime($row['sdate'])); ?> </td> 

            <td><?php echo date('h:i A', strtotime($row['stime'])); ?> </td>

            <td><?php echo $row['duration']; ?> </td>

            <td><a href="lectureEntry.php?id=<?php echo $row['lec_id']?>"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVnFhpbg03-VX8S1QQOrZ1n7WtNhp7f4S8qWZgamtaXLCZJ6w6dsMCUzDZ-t07HDMr1Mw&usqp=CAU" style="width: 20px; height: 20px;" /></a></td>

        </tr>
        <?php 
            }
        }else{
            echo "<h1>No Records</h1>";
        } 
        ?>

    </tbody>
    
</table>


<?php
    include '../footer.php';
?>

</div>
</div>