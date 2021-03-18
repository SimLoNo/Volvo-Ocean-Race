<?php
  session_start();

  $mysqli = new mysqli('localhost','root','','ocean_race') or die(mysqli_error($mysqli));
  /*Connect mysql database.('hostname', 'username', 'password', 'database-name').
    "or die(mysqli_error($mysqli))" shows error, if it can't connectes to the database.
  */

  /*//checking connection:
  if ($mysqli->error)
  {
    echo "not Connected";
  }
  echo "Connected successfully";*/

  //default values 
  $id = 0;
  $name = ''; //there isn't anything in the input box
  $points = ''; //there isn't anything in the input box
  $rank = ''; //there isn't anything in the input box
  $username = '';
  $password = '';
  $update = false; //udate button isn't shown
  $admin = false;

  if (isset($_POST['login'])) //log in button (doesn't work)
  {
    //$admin = true
    //check if username and password is in database
    echo "login isset"; //check if log in button works
    
  }
  else{echo "login not set";}//check if log in button works

  //if the button named save has been pressed:
  if (isset($_POST['save']))
  {
    //store everything inside varibles
    $id = $_POST['id'];
    $name = $_POST['name'];
    $points = $_POST['points'];
    $rank = $_POST['rank'];

    $checker = "SELECT ShipName FROM ships WHERE ShipName='$name'";
    $check = mysqli_query($mysqli,$checker);
    if (mysqli_num_rows($check)>0) //If you try to add a team, that already exists
    {
      $_SESSION['message'] = "Team name already exists!";
      $_SESSION['msg_type'] = "danger";
    }
    else
    {
      $mysqli->query("INSERT INTO ships (ShipName, ShipScore, ShipRank) VALUES('$name', '$points', '$rank')") or die($mysqli->error);
    
      $_SESSION['message'] = "Record has been saved!";
      $_SESSION['msg_type'] = "success";
    }
    header("location: index.php"); //return to page when processed
  }

  //edit
  if (isset($_GET['edit']))
  {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM ships WHERE ShipID=$id") or die($mysqli->error);
    
    $row = $result->fetch_array(); //this returns the data from the record(database)
    $name = $row['ShipName'];
    $points = $row['ShipScore'];
    $rank = $row['ShipRank'];
  }

  //update
  if (isset($_POST['update']))
  {
    //store everything inside varibles
    $id = $_POST['id'];
    $name = $_POST['name'];
    $points = $_POST['points'];
    $rank = $_POST['rank'];
    $mysqli->query("UPDATE ships SET ShipName='$name', ShipScore='$points', ShipRank='$rank' WHERE ShipID=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location: index.php"); //return to index page
  }

  //delete
  if (isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM ships WHERE ShipID=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php"); //return to page when processed
  }

?>