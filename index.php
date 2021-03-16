<!doctype html>
<html lang="en">
    <!--Jeg bruger stadig den gamle database, så alle kolonne-navnene er forkerte i forhold til den nye.-->
    <!--KØR PROGRAMMET: http://localhost/testen/-->
    <head>
        <title>oceanrace final</title>
        <!--down there\/ is standard bshtml (b4-$)-->
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--up there^ is standard bshtml (b4-$)-->

        <header><div class="header"><h1>Ocean Volvo Race</h1></div> <!--header of the website--></header>
        
    </head>
    <body>
        <?php require_once 'process.php';?> <!--index.php now knows the file process.php-->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <div id="navbar"> <!--navigation-bar-->
            <ul class="nav">
                <li class="active"><a data-toggle="pill" href="#Race">Race</a></li>
                <li><a data-toggle="pill" href="#Video">Video</a></li>
                <?php if ($admin == true):?> <!--This should only be shown, if an admin is logged in-->
                    <li><a data-toggle="pill" href="#Admin">Admin</a></li>
                    <button class="btn btn-info" id="logout" type="success">Log out</button>
                <?php else: ?>
                    <button class="btn btn-info" id="login" name="login" type="success">Log in</button>
                    <label id="username" for="username">username</label> <!--label is a text that typically belongs to an input"box"-->
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter username">
                    <label id="password" for="password">password</label> <!--label is a text that typically belongs to an input"box"-->
                    <input type="text" id="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Enter password">
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
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <?php  else: ?>
                            <button type="submit" class="btn btn-primary" name="save">Save</button> <!--type= submit means the button submits form-data. btn btn-primary makes the button blue-->
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

                                <a href="index.php?delete=<?php echo $row['ShipID']; ?>" class="btn btn-danger">Delete</a><!--delete-button-->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </table>
                </div>
            </div><!--admin-tab is done-->
        </div><!--tabcontent done-->

        
            
        <!--CSS - det her skal flyttes til sin egen fil-->
        <style>
            html, body 
            {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background: linear-gradient(rgb(255, 255, 255), rgb(50, 190, 235));
                display: flex;
                flex-direction: column;  
            }
            header
            {
                height: 10%;
                width: 100%;
                background: linear-gradient(rgb(10, 150, 195), rgb(210, 235, 240));
                display: flex;
            }
            #videoen
            {

            }
            .header h1
            {
                color: rgb(0, 255, 230);
                font-size: 30px;
                font-weight: bold;
                font-style: italic;
            }
            #navbar
            {
                background-color: white;
                text-align: center;
                
            }
            ul
            {
                border: solid black 1px;
            }
            li a /*items/links in the navigationbar */
            {
                display: block;
                color: rgb(10, 150, 195);
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
            li a:hover /*when you hover the mouse over the items in the navigation bar */
            {
                background-color: rgb(210, 235, 240);
            }
            li a.active /*when link is open */
            {
                font-weight: bold;
                text-decoration: underline blue;
            }
            #username, #password
            {
                width: 10%;
            }
            #logout, #login /*log out- and log in-button  */
            {
                align-self:  center;
                /*float: right;*/
            }
            #Admin h2 
            {
                font-family: Rockwell/*Gabriola*/;
                font-weight:bold;
                text-align: center;
                font-style: italic;
                color: rgb(45, 165, 245);
                padding: 20px;
            }
            .form-group
            {
                float: left;
                padding-left: 6%;
                padding-right:6%;
                text-align: center;
            }
            footer 
            {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 7%;
                background: linear-gradient(rgb(210, 235, 240), rgb(10, 150, 195));
                color: black;
                display: flex;
            }
            /*table*/
            table
            {
                width: 100%;
            }
            #tablecontent
            {
                width:100%;
                height:250px;
                line-height:3em;
                overflow:auto; /*makes t a scrollbox, when there is more content in the table than there's room for*/
                border: solid black 2px;
            }
            th 
            {
                background-color: #588c7e;
                color: white;
            }
            tr:nth-child(even) {background-color: #f2f2f2}
        </style>




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