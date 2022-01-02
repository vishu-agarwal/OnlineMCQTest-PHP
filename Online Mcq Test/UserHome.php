<?php
include "connection.php";
session_start();
if (isset($_SESSION['user'])) {
    $uname = $_SESSION['user'];
    // echo $uname;
    $query = "select name from tbluser where email = '$uname';";
    $res = mysqli_query($con, $query);
    $ar = mysqli_fetch_array($res);
    $name = $ar[0];
} else {
?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
<?php
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin Home</title>

    <style>
        .container1 {
            padding-top: 15px;

            padding-bottom: 15px;

            background-color: #fffca6;

            font-size: larger;

        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 20%;
            border-radius: 50%;
        }

        a {
            text-decoration: none;
            color : yellow;

        }
    </style>
</head>

<body>

    <div class="container container1">
        <div class="row">

            <nav class="navbar navbar-expand navbar-dark bg-dark">
                <div class="container-fluid ">
                    <a class="navbar-brand" href="logout.php"><button type="button" class="btn btn-light btn-lg fw-bolder">Sign
                            Out</button></a>


                </div>
                <div class="d-flex d-grid gap-2 d-md-flex justify-content-md-end">

                    <form class="d-grid gap-2 d-md-flex justify-content-md-end" method="post">
                        <button type="submit" value="submit" name="test" id="addSid" class="btn btn-primary btn-lg fw-bolder">Test</button>
                        <button type="submit" value="submit" name="resultTest" id="resultId" class="btn btn-primary btn-lg fw-bolder">Result</button>
                </div>
                </form>

            </nav>
        </div>
        <div>
            <div class="imgcontainer">
                <img src="bioimg.jpg" alt="Avatar" class="avatar">
            </div>
            <center><b>
                    <h3 class="navbar-brand fs-1 fw-bolder">WELCOME <?php echo strtoupper($name); ?> !</h3>
                </b></center>
        </div>

        <div class="row justify-content-md-center">
            <?php
            if (isset($_POST["test"]))
            {
                 //Get Data From test table
                    $sql="select * from tbltest where status = 1";
                    $row=mysqli_query($con,$sql);
                ?>

                <form class="col-8">
                    <center><label class="navbar-brand fs-2" for="Question"><b>Test</b></label></center><br>
                    <table class="table table-dark table-hover">
                        <thead class="bg-warning text-white">
                            <tr>
                                <th scope="row">No.</th>
                                <th>Subject Name</th>
                                <th>Test Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sr = 1;
                                if (mysqli_num_rows($row) > 0) 
                                {

                                    while ($data = mysqli_fetch_array($row)) 
                                    {
                                        $s = $data["subject"];
                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $sr++; ?></th>
                                            <td><?php echo $s; ?></td>
                                            <td><?php echo $data["testName"]; ?></td>
                            <?php
                                            //get user give exam or not
                                            $tnm = $data["testName"];
                                            $sql1 = "select * from tblresult where userEmail='$uname' and testName='$tnm'";
                                            //echo $sql1;
                                            $row1 = mysqli_query($con, $sql1);
                                            //echo $row1;
                                            $data1 = mysqli_fetch_array($row1);
                                            //echo $data1;
                                            // echo "data::".$data["testName"];
                                            // echo "data2:: ".$data1["testName"];

                                            // check test name
                                            if(isset($data1["testName"]))
                                            {
                                                echo "hii";
                                                if($data["testName"] === $data1["testName"])
                                                {
                                ?>
                                                    <td>
                                                        <p class="btn btn-primary text-uppercase" type="button">DONE</p>
                                                    </td>
                                <?php 
                                                 } 
                                            }
                                             else 
                                             { 
                                                $_SESSION['s']=$s;
                                                // echo "............................hello";
                                ?>
                                                <td>
                                                
                                                    <a href="testPage.php?sub=<?php echo $data["subject"]; ?>&tid=<?php echo $data["testName"]; ?>">
                                                    Start
                                                        <!-- <button class="btn btn-outline-warning text-uppercase">
                                                            START
                                                        </button> -->
                                                    </a>
                                                </td>
                                            
                                <?php
                                         }
                            ?>
                                            </tr>
                            <?php
                                    }  
                                }   
                            ?>
                                        
                        </tbody>
                    </table>    
                </form>        
                <?php
            } 

            else if (isset($_POST["resultTest"]))
             {
                $sql = "select * from tblresult where userEmail = '$uname'";
                //echo $sql;
                $row = mysqli_query($con, $sql);
                ?>
                <form class="col-8">
                    <center><label class="navbar-brand fs-2" for="Question"><b>Result</b></label></center><br>
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>

                                <th scope="col">Test Name</th>
                                <th scope="col">Subject Name</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>
                        <?php
                        $sr = 1;
                        if (mysqli_num_rows($row) > 0) {

                            while ($data = mysqli_fetch_array($row)) {
                                //test_name get
                                //$res = $data["testName"];
                                // $sql2="select * from tbltest where testName=".$row["testName"];
                                // $res2=mysqli_query($con,$sql2);
                                // $data2=mysqli_fetch_array($res2);

                                //echo $sub_name;
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $sr++; ?></th>

                                    <td><?php echo $data["testName"]; ?></td>
                                    <td><?php echo $data["subject"]; ?></td>

                                    <td><?php echo $data["marks"]; ?></td>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </form>
            <?php
            }
            ?>
        </div>


    </div>

</body>

</html>