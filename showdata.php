<?php

include "config.php";



$result = mysqli_query($conn, "SELECT * FROM  `student` ");


$output = "";

if(mysqli_num_rows($result) > 0 )
{
    $output = '<table>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>';

                while($row=mysqli_fetch_assoc($result))
                {
                    $output .= "<tr>
                        <td>{$row["id"]}</td>
                        <td>{$row["name"]}</td>
                        <td>{$row["email"]}</td>
                        <td><button class='edit-btn' data-eid ='{$row["id"]}'>Edit</button></td>
                        <td><button class='delete-btn' data-id ='{$row["id"]}'>Delete</button></td>
                    </tr>";
                }
       $output .= "</table>";

       mysqli_close($conn);

       echo $output;

} else{
    echo "No Record Found";
}




?>





