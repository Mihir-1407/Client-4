<?php
    include 'header.php';
?>

<div>
    <div class="dispstu">
        <h2>FeedBack</h2><br>

    
        <table style="width:100%; text-align:center;">

            <thead>

            <?php

                $sqlA = $conn -> prepare("SELECT * FROM feedback ORDER BY rating");
                $sqlA -> execute();
                $result = $sqlA -> get_result();

                if(mysqli_num_rows($result) > 0){

            ?>

            <th><h3>TUTOR ID</h3></th>

            <th><h3>Rating</h3></th>

            <th><h3>Comments</h3></th>

            </thead>

            <tbody>

                <?php

                    while($row = $result -> fetch_assoc()){

                ?>

                <tr>

                    <td><?php echo "TUT" . $row['tutor_id']; ?> </td> 

                    <td><?php echo $row['rating']; ?> </td> 

                    <td><?php echo $row['comment']; ?> </td> 


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

    <?php
        include "../footer.php";
    ?>

    <?php 
    
    ?>

    </div>
</div>
