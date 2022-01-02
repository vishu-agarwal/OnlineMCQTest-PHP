<?php
session_start();
//check session is set or not

if (isset($_POST["add"]))
{
  //storing all necessary data into the respective variables.
  $sub = $_POST['sub'];
 
  if(empty($_POST["sub"]))
      {
          $msg="* Please Enter Subject";
      }
      else
      {
          //tblsubject
          $query="insert into tblsubject(`suject`) VALUES ('$sub');";//mysql command to insert file name with extension into the table. Use TEXT datatype for a particular column in table.
              $res = mysqli_query($con,$query);
          if($res)
          {
              $msg='<b style="color:green">Successfully Subject Register</b>';
          }
          else
          {
              $msg="* Failed !!! Subject Not Register";
          }
      }
}
?>