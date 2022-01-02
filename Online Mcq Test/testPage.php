<?php
include "connection.php";
session_start();
$uname = $_SESSION['user'];
$subject = $_SESSION['s'];
$query = "select name from tbluser where email = '$uname';";
$res = mysqli_query($con, $query);
$ar = mysqli_fetch_array($res);
$name = $ar[0];

if(isset($_GET["btn1"]))
{

    //code for result
    header("location:UserHome.php");
}
// else
// {
//     //get Question
//     $subject = $_GET["sub"];
//     $sql="select * from tblquestion where subject='$subject';";
//    // echo $sql;
//     $row=mysqli_query($con,$sql);
//     //echo $row;
    
    
// }

//check result:-
if(isset($_POST["QuizSubmit"]))
{
    //echo "Success";
    $sub = $_POST["snm"];
    $test = $_POST["testnm"];
    $temp=0;
    if(isset($_POST["result_data"]))
    {
        $c = $_POST['result_data'];
       //echo $c;
      // $str = '"Hello"';
        $trim = trim($c,'""');
       $sql="select * from tblquestion where subject='$sub';";
      //   echo $sql;
        $row1=mysqli_query($con,$sql);
         $no_of_question=mysqli_num_rows($row1);
        while($data=mysqli_fetch_array($row1))
        {
           // $qno=$data["id"];
          //  echo "qno ::". $qno;
            $ans= $data["answer"];
            //echo "ans ::". $ans;
            //print_r($check);
            //$c = array_values($check);
            // $key =  in_array("Storage",$ans);// $key = 2;
            // echo "key ...".$key."...";

           // print_r( "................".$c."..............");
           // print_r(array_key_exists($qno, $check));
        //    $a = "select answer from tblquestion where answer = '.$c.';";
        //    echo $a;
        //    $r = mysqli_query($con,$a);
            if ($ans == $trim) 
            {
               // $ans= $row1["answer"];
                //echo "answer ::". $ans;
               
                $temp++;
                
            }
            // else
            // {
            //     echo "wrong answer";
            // }
        }  
        $query="insert into tblresult(userEmail,testName,subject,marks) values ('".$uname."','".$test."','".$sub."','".$temp."');";
        echo $query;
         $res1 = mysqli_query($con,$query);
         if ($res1)
         {
             ?>
                 <script type = "text/javascript">
                    
                     alert("Successfully Test Submitted!!!!");
                     window.location = "UserHome.php";
                 </script>
                 <?php
            
         }
         else
         {
             ?>
                 <script type = "text/javascript">
                    
                     alert("While Submitting problem occur!!!!");
                 </script>
                 <?php
         }
        //header("location:UserHome.php");
    }
    else
    {
        $msg="Please Fill Answer";
        echo $msg;
    }

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

        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
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

                        <!-- <button type="submit" value="submit" name="test" id="addSid" class="btn btn-primary btn-lg fw-bolder">Test</button> -->
                        <!-- <button type="submit" value="submit" name="resultTest" id="resultId" class="btn btn-primary btn-lg fw-bolder">Result</button> -->
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
        
             
            <div class="conatiner col-9">
            <form  action="testPage.php" method="post">
            <center><label class="navbar-brand fs-2" for="Question"><b>Online Quiz Test</b></label></center><br>
                   <?php
                     //get Question
   // $subject = $_GET["sub"];
    $sql="select * from tblquestion where subject='$subject';";
   // echo $sql;
    $row=mysqli_query($con,$sql);
    //echo $row;
                        $count=1;
                       // echo "ow are you";
                       
                if (mysqli_num_rows($row) > 0)
                {
                        while($data2 = mysqli_fetch_array($row))
                    {
                        
                        //echo $data2['question'];
?>                     
                    <input type="text" name="testnm" value="<?php if(isset($_GET["tid"])){ echo $_GET["tid"];}?>" />
                    <input type="text" name="snm" value="<?php if(isset($_GET["sub"])){ echo $_GET["sub"];}?>" />
             
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-warning text-white">
                        
                            <label class="form-check-label" for="flexRadioDefault1">
                                <h5><?php echo $count++; ?>&nbsp;&nbsp;<?php echo $data2['question']; ?></h5>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="result_data" value='"<?php echo $data2['option1'];?>"'>
                            <label class="form-check-label" for="flexRadioDefault1">
                                <?php echo $data2["option1"];?>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="result_data" value='"<?php echo $data2['option2'];?>"'>
                            <label class="form-check-label" for="flexRadioDefault2">
                                <?php echo $data2["option2"];?>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="result_data" value='"<?php echo $data2['option3'];?>"'>
                            <label class="form-check-label" for="flexRadioDefault3">
                                <?php echo $data2["option3"];?>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name='result_data' value='"<?php echo $data2['option4'];?>"'>
                            <label class="form-check-label" for="flexRadioDefault4">
                                <?php echo $data2["option4"];?>
                            </label>
                        </li>
                    </ul>
                    <?php
}
}
?>
                    <div class="pt-3">
                        <center><button class="btn btn-warning btn-lg text-uppercase" type="submit" name="QuizSubmit">
                            SUBMIT
                        </button></center>
                    </div>
            </form>
            </div>
        </div>
    </form>
          
        </div>


    </div>

</body>

</html>