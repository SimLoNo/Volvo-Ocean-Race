<?php session_start(); ?>
<!doctype html>
<html lang="en">

    <!--Jeg bruger stadig den gamle database, så alle kolonne-navnene er forkerte i forhold til den nye.-->
    <!--KØR PROGRAMMET: http://localhost/OceanRace/-->
    <head>
        <title>oceanrace</title> <!--title in the web-tab-->
        <!--down there\/ is standard bshtml (b4-$)-->
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--up there^ is standard bshtml (b4-$)-->

        <link rel="stylesheet" href="style.css">
        <script src="javascript.js"></script>
        <header><div class="header"><h1>Ocean Volvo Race</h1></div> <!--header of the website--></header>
    </head>
    <body>
        <?php require_once 'process.php';?> <!--index.php now knows the file process.php-->
        
        <div id="navbar"> <!--navigation-bar-->
            <ul class="nav">
                <li id="Racetab" class="active"><a data-toggle="pill" href="#Race">Race</a></li>
                <li><a data-toggle="pill" href="#Video">Video</a></li>
                <li id="Admintab"><a data-toggle="pill" href="#Admin">Admin</a></li>
                <?php if(isset($_SESSION['user'])): ?> <!--If you are logged in-->
                    
                    <form class="justify-content" action="logout.php" method="POST"> <!--executes code from logout.php-->   
                        <button  onclick="alert('you are logged out')" type="submit" class="btn btn-success">Log out</button> <!--Log-out button-->
                    </form>
                <?php else: ?> <!--If you are logged out-->
                    <style type="text/css">#Admintab{display:none;}</style> <!--The admin tab is only shown, if you are logged in.-->
                    <form class="justify-content" action="login.php" method="POST"> <!--executes code from login.php-->
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control" name="username"> <!--Input field for username-->
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password"> <!--Input field for password. type=password hides the text and only writes dots, when you write a char.-->
                        </div>
                        <button type="submit" class="btn btn-success">Log in</button> <!--Log-in button-->
                    </form>
                <?php endif; ?>
            </ul>
        </div>
        <div class="tab-content"> <!--content in the tabs from the navigationbar-->
            <div id="Race" class="tab-pane active"> <!--The race-tab. "active" means the website opens the admin-tab by default-->
                <!--Anders' kode her-->
                <h3>Race</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="Video" class="tab-pane fade"> <!--Video-tab. Problem: video is behind footer and header-->
                <!--Simons kode-->
                <div class="row" id="videoen"">
                    <div class="col-sm-2"></div> <!--Placing the video in the middel of the screen-->
                    <div class="embed-responsive embed-responsive-16by9 col-sm-8" >
                        <iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/videoseries?list=PL8z1Z17Ds-C4LtWQT55QRbCaqa-dQyOoT&autoplay=1&mute=1loop=1"></iframe>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            <?php if(isset($_SESSION['user'])):?> <!--if you are logged in, this is shown in the admin-tab-->
                <div id="Admin" class="tab-pane fade"> <!--the admin-tab.-->
                
                    <h2>Team management</h2>
                    <form class="justify-content" action="process.php" method="POST">
                        <!--The <form> element is a container for different types of input elements, such as: text fields, checkboxes, radio buttons, submit buttons, etc.
                            The method attribute specifies how to send form-data (the form-data is sent to the page specified in the action attribute).
                            The form-data can be sent as URL variables (with method="GET") or as HTTP post transaction (with method="post").
                        -->
                        <?php $result = $mysqli->query("SELECT * FROM ships") or die($mysqli->error);  //selects all data from the table named "ships"
                        ?>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!--This is for the functionality of the updatebutton. This is hidden from the user-->
                        <div class="form-group">
                            <label for="name">Team name</label> <!--label is a text that typically belongs to an input"box"-->
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter team name"> <!--input is a little box, where the user can input information. placeholder is text in inputfield, you dont have to delete. It dissapears, when you write in the field-->
                        </div>
                        <div class="form-group">
                            <label for="points">Points</label>
                            <input type="text" name="points" value="<?php echo $points; ?>" class="form-control" placeholder="Enter points">
                        </div>
                        <div class="form-group">
                            <label for="rank">Rank</label>
                            <input type="text" name="rank" value="<?php echo $rank; ?>" class="form-control" placeholder="Enter rank">
                        </div>
                        <div class="form-group">
                            <!--If edit is pressed the update varibele is true then let the save button be an update button-->
                            <?php if ($update == true): ?>
                                <button onclick="alert('Record has been updated!')" type="submit" class="btn btn-primary" name="update">Update</button>
                            <?php  else: ?>
                                <button onclick="alert('Record has been saved!')" type="submit" class="btn btn-primary" name="save">Save</button> <!--type= submit means the button submits form-data. btn btn-primary makes the button blue-->
                            <?php endif; ?>
                        </div>
                    </form>
                    <!--table to view data - has to be in a div, to make it a scrollbox -->
                    <div id="tablecontent">
                        <table>
                            <tr>
                                <th>ShipID</th>
                                <th>ShipName</th>
                                <th>ShipRank</th>
                                <th>ShipScore</th>
                                <th>Action</th>
                            </tr>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ShipID']; ?></td> <!--standard data cell-->
                                <td><?php echo $row['ShipName']; ?></td>
                                <td><?php echo $row['ShipRank']; ?></td>
                                <td><?php echo $row['ShipScore']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $row['ShipID']; ?>" class="btn btn-info">Edit</a> <!--edit-button-->

                                    <a onclick="alert('Record has been deleted!')" href="index.php?delete=<?php echo $row['ShipID']; ?>" class="btn btn-danger">Delete</a><!--delete-button-->
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </table>
                    </div>
                </div><!--admin-tab is done-->
            <?php else: ?> <!--if you aren't logged in, the content in the admin-tab isn't shown-->
                <style type="text/css">#Admin{display:none;}</style>
            <?php endif; ?>
        </div><!--tabcontent done-->>
        <!--down there\/ is standard bshtml (b4-$)-->  
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--up there^ is standard bshtml (b4-$)-->
    </body>
    <footer><div class="footer"><p>Copyright&copy;<?php echo date("Y"); ?></p></div></footer><!--footer of the site. copyright-tegn efterfulgt af php, som udskriver det nuværende år.-->
</html>