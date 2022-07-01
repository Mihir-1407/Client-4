<?php
    include 'header.php'; 
    $temp = $_GET['id'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $tu_id = intval($temp);

    if(isset($tu_id)){
        $sqlT = $conn -> prepare("DELETE FROM tutor WHERE tutor_id = ?");
        $sqlT -> bind_param("s", $tu_id);
        $sqlT -> execute();
        
        $sqlT -> close();
    }

    
?>

<div class="page-wrap">
<section>
<div>
    <div class="disptut">
        <h2>Tutors Record</h2><br>

        <table style="width:100%; text-align:center;">

            <thead>

                <?php

                    $sqlS = $conn -> prepare("SELECT * FROM tutor");
                    $sqlS -> execute();
                    $result = $sqlS -> get_result();

                    if(mysqli_num_rows($result) > 0){

                ?>

                <th><h3>ID</h3></th>

                <th><h3>Name</h3></th>

                <th><h3>Email</h3></th>

                <th><h3>Mobile</h3></th>

                <th><h3>Subject</h3></th>

                <th><h3></h3></th>

            </thead>

            <tbody>

                <?php

                    while($row = $result -> fetch_assoc()){

                ?>

                <tr>

                    <td><?php echo "TUT" . $row['tutor_id']; ?> </td> 

                    <td><?php echo $row['tutor_name']; ?> </td> 

                    <td><?php echo $row['email']; ?> </td>
                    
                    <td><?php echo $row['contact_no']; ?> </td> 

                    <td><?php echo $row['subject']; ?> </td> 

                    <td>
                        <button><a href="editTutor.php?id=<?php echo "TUT" . $row['tutor_id']?>">Update</a></button>&nbsp;&nbsp;&nbsp;
                        <button name="<?php $row['tutor_id'] ?>"><a href="<?php $_SERVER['PHP_SELF']?>?id=<?php echo "TUT" . $row['tutor_id']?>">Delete</a></button>
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
</section>
</div>

<?php
    include "../footer.php";
?>
