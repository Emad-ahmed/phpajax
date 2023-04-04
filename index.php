<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <title>Home</title>

    <style>
        table{
            width:50%;
            margin:auto;
            margin-top: 4rem;
        }
        table, th, td,tr{
            border:1px solid black;
           
        }
        #errormessage
        {
            color:red;
        }

        #successmessage
        {
            color:green;
        }
        
        #modal{
            background: rgba(0,0,0,0.7);
            color:white;
            position: fixed;
            left:0;
            top:0;
            width:100%;
            height:100%;
            z-index:100;
            display:none;
        }

        
        #modal-form{
            background: white;
            color:black;
            width:30%;
            position: relative;
           
            top:20%;
            left:calc(50%,-15%);
            padding:10px;
        }

        #close-btn
        {
            width: 100%;
            background: black;
            color:white;
            cursor:pointer;
        }
        
    </style>
</head>
<body>
    
<div class="container mt-5">
    <form id="addform" class="w-50 m-auto">
        <input type="text" name="name" id="name" class="form-control">
        <input type="text" name="email" id="email" class="form-control mt-3 mb-3">

        <input type="submit" value="Add" id="savebutton" >
    </form>
    <input type="text" placeholder="Search..." id="search">

    <table>
        <tr>
        <td id="table-data">

        </td>
        </tr>
        
    </table>
   

    <table id="tabledata">


    </table>

    <div id="errormessage"></div>
    <div id="successmessage"></div>

</div>


<div id="modal">
    <div id="modal-form">
        <h2>Edit Form</h2>
       
        <table>
            
        </table>
        <div id="close-btn">Exit</div>
    </div>
    
</div>




<script src="js/jquery-3.6.4.js"></script>
    <script>
        $(document).ready(function(){
            function loaddata(){
                $.ajax({
                    type: "POST",
                    url: "showdata.php",
                    success: function (data) {
                        $("#tabledata").html(data);
                    }
                });
            };
            loaddata();

            $("#savebutton").on("click", function(e)
            {
                e.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();

                if(name == "" || email == "")
                {
                    $("#errormessage").html("Please Full Fill The Field").slideDown();
                    $("#successmessage").html("Successfully Saved").slideUp();
                } else{
                    $.ajax({
                    type: "POST",
                    url: "insertdata.php",
                    data: {name:name, email:email},
                    success: function (data) {
                        if(data == 1)
                        {
                            loaddata();
                            $("#addform").trigger("reset");
                            $("#successmessage").html("Successfully Saved").slideDown();
                            $("#errormessage").html("Not Saved Data").slideUp();
                            
                        } else{
                            $("#errormessage").html("Not Saved Data").slideDown();
                            $("#successmessage").html("Successfully Saved").slideUp();
                        }
                        
                    }
                });
                }

            

            });

            $(document).on("click", ".delete-btn", function()
            {
                if(confirm("Do you really want to delete this data"))
                {
                var student_id = $(this).data("id");
                var element = this;
            
                $.ajax({
                    type: "POST",
                    url: "deletedata.php",
                    data: {id:student_id},
                    success: function (data) {
                        if(data==1)
                        {
                            $(element).closest("tr").fadeOut();
                            $("#successmessage").html("Successfully Deleted").slideDown();
                            $("#errormessage").html("Not delete").slideUp();
                           
                            loaddata();
                        } else{
                            $("#errormessage").html("Not Delte").slideDown();
                            $("#successmessage").html("Successfully Saved").slideUp();
                        }
                    }
                });
            };
            });

            $(document).on("click", ".edit-btn", function()
            {
                $("#modal").show();
                var student_id = $(this).data("eid");
                
                $.ajax({
                    type: "POST",
                    url: "loadupdateform.php",
                    data: {id:student_id},
                    success: function (data) {
                        $("#modal-form table").html(data);
                    }   
                });
            });

            $(document).on("click", "#close-btn", function()
            {
                $("#modal").hide();
            });

            $(document).on("click", "#edit_submit", function()
            {
                var stid = $("#edit_id").val();
                var name = $("#edit_name").val();
                var email = $("#edit_email").val();

                $.ajax({
                    type: "POST",
                    url: "updateform.php",
                    data: {id:stid, name:name, email:email},
                    success: function (data) {
                        alert("Suceesfully Chnged");
                        $("#modal").hide();
                        loaddata();

                    }
                });
            });


            // Live Search
            $("#search").on("keyup", function()
                {
                        var searchitem = $(this).val();

                        $.ajax({
                            type: "POST",
                            url: "ajax_livesearch.php",
                            data: {search:searchitem},
                            success: function (data) {
                                $("#table-data").html(data);
                                loaddata().hide();
                            }
                        });
                }
            );


        })
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>
</html>