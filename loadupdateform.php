<?php

include "config.php";

$student_id = $_POST['id'];

$result = mysqli_query($conn, "SELECT * FROM  `student` WHERE id = {$student_id}");

$output = "";


if(mysqli_num_rows($result) > 0 )
{
    
                while($row=mysqli_fetch_assoc($result))
                {
                    $output .= "<input type='text' id='edit_name' value='{$row["name"]}'>
                            <input type='text' id='edit_email' value='{$row["email"]}'>
                            <input type='text' id='edit_id' value='{$row["id"]}' hidden>
                            <input type='submit' value='Update' id='edit_submit'>
                    ";
                }
      

       mysqli_close($conn);

       echo $output;

} else{
    echo "No Record Found";
}




?>





