<?php
include "connection.php";
session_start();
if (isset($_SESSION['user']))
{
    $uname = $_SESSION['user'];
   // echo $uname;
    $query = "select name from tbladmin where email = '$uname';";
    $res = mysqli_query($con,$query);
    $ar = mysqli_fetch_array($res);
    $name = $ar[0];
    
            
          if (isset($_POST["addS"]))
          {
            //storing all necessary data into the respective variables.
            $sub = $_POST["sub"];
         
           
            if(empty($_POST["sub"]))
                {
                    $msg="* Please Enter Subject";
                    echo $msg;
                }
                else
                {
                    //tblsubject
                    $query="insert into tblsubject(`subject`) VALUES ('$sub');";//mysql command to insert file name with extension into the table. Use TEXT datatype for a particular column in table.
                        $res = mysqli_query($con,$query);
                    //     echo $query;
                    //     echo "resut::" . $res;
                     if($res)
                    {
                        $msg='<b style="color:green">Successfully Subject Register</b>';
                        //echo $msg;
                    }
                    else
                    {
                        $msg="* Failed !!! Subject Not Register";
                        //echo $msg;
                    }
                }
          }
           //Add Question
           else if(isset($_POST["addQ"]))
           {
               if(empty($_POST["sub"]) or empty($_POST["txtque"]) or empty($_POST["txtopt1"]) or empty($_POST["txtopt2"]) or empty($_POST["txtopt3"]) or empty($_POST["txtopt4"]) or empty($_POST["txtans"]))
               {
                   $msg="* Please Fill Information";
               }
               else
               {
                   $sql="insert into tblquestion(subject,question,option1,option2,option3,option4,answer) value ('".$_POST["sub"]."','".$_POST["txtque"]."','".$_POST["txtopt1"]."','".$_POST["txtopt2"]."','".$_POST["txtopt3"]."','".$_POST["txtopt4"]."','".$_POST["txtans"]."');";
                   //echo $sql;
                   if(mysqli_query($con,$sql))
                   {
                       $msg='<b style="color:green">Successfully Question Added</b>';
                       //echo $msg;
                   }
                   else
                   {
                       $msg="* Failed Question Not Store!!!";
                       //echo $msg;
                   }
               }
           }
           //Add Test
           else if(isset($_POST["addT"]))
           {
               //echo "helllo";
               
                   $sql="insert into tbltest(status,subject,testName,noOfQues) value (0,'".$_POST["sub"]."','".$_POST["txttest"]."',".$_POST['textno'].");";
                  // echo $sql;
                   if(mysqli_query($con,$sql))
                   {
                       $msg='<b style="color:green">Successfully Question Added</b>';
                      // echo $msg;
                   }
                   else
                   {
                       $msg="* Failed Test Not Store!!!";
                      // echo $msg;
                   }
               
           }
           //Active Test
           else if(isset($_POST["active"]))
           {
               //echo "helllo";
               
                   $sql="insert into tbltest(status,subject,testName,noOfQues) value (0,'".$_POST["sub"]."','".$_POST["txttest"]."',".$_POST['textno'].");";
                  // echo $sql;
                   if(mysqli_query($con,$sql))
                   {
                       $msg='<b style="color:green">Successfully Question Added</b>';
                      // echo $msg;
                   }
                   else
                   {
                       $msg="* Failed Test Not Store!!!";
                      // echo $msg;
                   }
            }
                //Result Test
           else if(isset($_POST["result"]))
           {
               //echo "helllo";
               
                   $sql="insert into tbltest(status,subject,testName,noOfQues) value (0,'".$_POST["sub"]."','".$_POST["txttest"]."',".$_POST['textno'].");";
                  // echo $sql;
                   if(mysqli_query($con,$sql))
                   {
                       $msg='<b style="color:green">Successfully Question Added</b>';
                      // echo $msg;
                   }
                   else
                   {
                       $msg="* Failed Test Not Store!!!";
                      // echo $msg;
                   }
                }
              
}
else
{
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
                
                <form class = "d-grid gap-2 d-md-flex justify-content-md-end"  method = "post">
                    <button type="submit" value="submit" name="addSub" id = "addSid" class="btn btn-primary btn-lg fw-bolder" >Add Subject</button>
                    <button type="submit" value="submit" name="addQue" id = "addQid" class="btn btn-primary btn-lg fw-bolder">Add Question</button>
                    <button type="submit" value="submit" name="crtTest" id = "crtTid" class="btn btn-primary btn-lg fw-bolder">Add Test</button>
                    <button type="submit" value="submit" name="testActive" id = "testAid" class="btn btn-primary btn-lg fw-bolder">Active Test</button>
                    <button type="submit" value="submit" name="resultTest" id = "resultId" class="btn btn-primary btn-lg fw-bolder">Result</button>
                </div>
                </form>

            </nav>
        </div>
        <div >
            <div class="imgcontainer">
                <img src="bioimg.jpg" alt="Avatar" class="avatar">
            </div>
            <center><b>
                    <h3 class="navbar-brand fs-1 fw-bolder" >WELCOME  <?php echo strtoupper($name);?> !</h3></b></center>
        </div>
         
        <div class = "row justify-content-md-center">
            <?php  
                    if (isset($_POST["addSub"]))
                    {
                     ?>
                     
                        <form class = "col-6" action="adminHome.php" method="post">
                        <br>
                     <br>
                            <div class ="row justify-content-md-center">
                                <center><label class="navbar-brand fs-2" for="Subject"><b>Subject</b></label></center><br><br>
                                <input type="text" placeholder="Enter Subject Name" name="sub" class="form-control" required/>
                            </div>                        
                                      <br>                  
                                  <div class ="row justify-content-md-center"> 
                                <button  type="submit" name ="addS" class="btn btn-success btn-lg fw-bolder" >ADD</button>
                                  </div>
                            </form>
                        <?php
                    }  
                    else if (isset($_POST["addQue"]))
                    {
                        //Display subject in combobox
                            $sql = "select * from tblsubject";
                           // echo $sql;
                            $row=mysqli_query($con,$sql);
                           //echo $row;
                            ?>
                        
                        
                        <form class = "col-6" action="adminHome.php" method="post">
                        
                    
                     <center><label class="navbar-brand fs-2" for="Question"><b>Question</b></label></center><br><br>
                            <select class="form-select form-select mb-2 form-control" name="sub" aria-label=".form-select-lg example">
                            <option value="-1">Select Subject</option>
                           <?php
                           if(mysqli_num_rows($row)>0)
                           {
                            
                                while($sub = mysqli_fetch_array($row))
                                { 
                            ?>
                            <option value="<?php echo $sub["subject"];?>"><?php echo $sub["subject"]; ?></option>
                            <?php 
                            
                                 } 
                            }
                            ?>
                                </select>
                                <br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter Question" name="txtque"><br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter Option 1" name="txtopt1"><br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter Option 2" name="txtopt2"><br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter Option 3" name="txtopt3"><br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter Option 4" name="txtopt4"><br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter Answer" name="txtans"><br>
                                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="addQ"
                                    value="submit">ADD</button>
                                <?php if(isset($msg)){ ?>
                                <div class="text-danger font-bold" role="alert">
                                    <?php echo $msg; ?>
                                </div>
                                <?php } ?>
                            </form><!-- /form -->
                       
<?php
                    }  
                    else if (isset($_POST["crtTest"]))
                    {

                         //Display subject in combobox
                         $sql = "select * from tblsubject";
                         // echo $sql;
                          $row=mysqli_query($con,$sql);
                         //echo $row;
                          ?>
                      
                      
                      <form class = "col-6" action="adminHome.php" method="post">
                      
                  
                            <center><label class="navbar-brand fs-2" for="Question"><b>Test</b></label></center><br><br>
                          <select class="form-select form-select mb-2 form-control" name="sub" aria-label=".form-select-lg example">
                          <option value="-1">Select Subject</option>
                         <?php
                         if(mysqli_num_rows($row)>0)
                         {
                          
                              while($sub = mysqli_fetch_array($row))
                              { 
                          ?>
                          <option value="<?php echo $sub["subject"];?>"><?php echo $sub["subject"]; ?></option>
                          <?php 
                          
                               } 
                          }
                          ?>
                              </select>
                              <br>
                              <input type="text" id="inputsubject" class="form-control" placeholder="Enter Test Name" name="txttest"><br>
                                <input type="text" id="inputsubject" class="form-control" placeholder="Enter No. Of Questions " name="textno"><br>
                                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="addT" value="submit">ADD</button>
                                <?php if(isset($msg)){ ?>
                                <div class="text-danger font-bold" role="alert">
                                    <?php echo $msg; ?>
                                </div>
                                <?php } ?>
                            </form><!-- /form -->
                            <?php

                    } 
                    else if (isset($_POST["testActive"]))
                    {
                        //Display test 
                        $sql = "select * from tbltest";
                        // echo $sql;
                         $row=mysqli_query($con,$sql);
                        //echo $row;
                         ?>
                        <form class = "col-8" >
                        <center><label class="navbar-brand fs-2" for="Question"><b>Active / In-Active Tests</b></label></center><br><br>
                            <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Test Name</th>
                                <th scope="col">Subject Name</th>
                                <th scope="col">Total Questions</th>
                                <th scope="col">Status</th>
                                <th scope="col">Active / In-Active</th>
                                </tr>
                            </thead>
                            <?php
                            $sr=1; 
                            if(mysqli_num_rows($row)>0)
                            {
                         
                                while($data = mysqli_fetch_array($row))
                                { 
                            
        
                                    // $sql2="SELECT * FROM tblsubject where subject=".$row["subject"];
                                    // $res2=mysqli_query($con,$sql2);
                                    // $row2=mysqli_fetch_array($res2);
                                    $sub=$data["subject"];
                                    //echo $sub_name;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $sr++; ?></th>
                                            <td><?php echo $data["testName"];?></td>
                                            <td><?php echo $sub;?></td>
                                            <td><?php echo $data["noOfQues"];?></td>
                                            <td><?php echo $data["status"];?></td>
                                            <td><a
                                                    href="./active.php?id=<?php echo $data["id"];?>&status=<?php echo $data["status"];?>">
                                                    <?php 
                                                    if($data["status"]==0) 
                                                    { 
                                                        echo "<p class='btn btn-warning'>NOT ACTIVE</p>";
                                                    } 
                                                    else 
                                                    {
                                                        echo "<p class='btn btn-success'>ACTIVE</p>";
                                                    }
                                                    ?>
                                                   
                                            </td>
                                        </tr>
                                <?php
                                } 
                                
                            }
                            ?>
                            </table>
                        </form>
                         <?php

                    }
                    else if (isset($_POST["resultTest"]))
                    {
                        $sql="select * from tblresult";
                        $row=mysqli_query($con,$sql);
                        ?>
                        <form class = "col-8" >
                        <center><label class="navbar-brand fs-2" for="Question"><b>Result</b></label></center><br><br>
                            <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">User-Name</th>
                                <th scope="col">Test Name</th>
                                <th scope="col">Subject Name</th>
                                
                                <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <?php
                            $sr=1; 
                            if(mysqli_num_rows($row)>0)
                            {
                         
                                while($data = mysqli_fetch_array($row))
                                { 
                                    //test_name get
                                    //$res = $data["testName"];
                                    // $sql2="select * from tbltest where testName=".$row["testName"];
                                    // $res2=mysqli_query($con,$sql2);
                                    // $data2=mysqli_fetch_array($res2);
                                    
                                    //echo $sub_name;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $sr++; ?></th>
                                            <td><?php echo $data["userEmail"];?></td>
                                            <td><?php echo $data["testName"];?></td>
                                            <td><?php echo $data["subject"];?></td>
                                            
                                            <td><?php echo $data["marks"];?></td>
                                            
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

