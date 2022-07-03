<?php
    include 'header.php'; 
    $temp = $_GET['id'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $stu_id = intval($temp);

    if(isset($stu_id)){
        $sqlS = $conn -> prepare("DELETE FROM student WHERE stu_id = ?");
        $sqlS -> bind_param("s", $stu_id);
        $sqlS -> execute();
        
        $sqlS -> close();
    }
?>
<div class="page-wrap">
    <div>
        <div class="dispstu">
            <h2>Students Record</h2><br>

        
            <table style="width:100%; text-align:center;">

                <thead>

                <?php

                    $sqlS = $conn -> prepare("SELECT * FROM student");
                    $sqlS -> execute();
                    $result = $sqlS -> get_result();

                    if(mysqli_num_rows($result) > 0){

                ?>

                <th><h3>ID</h3></th>

                <th><h3>Name</h3></th>

                <th><h3>Email</h3></th>

                <th><h3></h3></th>

                <th><h3></h3></th>

                </thead>

                <tbody>

                    <?php

                        while($row = $result -> fetch_assoc()){

                    ?>

                    <tr>

                        <td><?php echo "STU" . $row['stu_id']; ?> </td> 

                        <td><?php echo $row['stu_name']; ?> </td> 

                        <td><?php echo $row['stu_email']; ?> </td> 

                        <td>
                            <button><a href="editStudent.php?id=<?php echo "STU" . $row['stu_id']?>">Update</a></button>&nbsp;&nbsp;&nbsp;
                        </td>

                        <td>
                            <button name="<?php $row['stu_id'] ?>"><a href="<?php $_SERVER['PHP_SELF']?>?id=<?php echo "STU" .  $row['stu_id']?>">Delete</a></button>
                        </td>
                    </tr>

                    <?php 
                        }
                    }else{
                        echo "<h1>No Records</h1>";
                    } 
                    ?>

                </tbody>
                
            </table>

        </div>
    </div>
</div>

    <?php
        include "../footer.php";
    ?>

