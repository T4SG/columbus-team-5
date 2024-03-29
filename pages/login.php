<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="styles7heet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "code4good";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $db_selected = mysqli_select_db($conn,'mysql');


    // $add = mysqli_query($conn, "INSERT INTO students (attendance, firstname, lastname, gpa, hours, id)
    // VALUES (90,'Jack','Jones',3.2,2,3);");

    // $add = mysqli_query($conn, "INSERT INTO students (attendance, firstname, lastname, gpa, hours, id)
    // VALUES (90,'Sara','Bailey',3.9,100,4);");

    //execute the SQL query and return records
    $result = mysqli_query($conn, "SELECT id, firstname, lastname FROM students");
    //var_dump($result);
    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . "\n";
        $message .= 'Whole query: ' . $result;
        die($message);
    }

    // //fetch tha data from the database
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       // echo "ID:".$row['id']." Name:".$row['firstname']." 
       // ".$row['lastname']."<br>";
    }
    $var = 0;
    echo $error;
    //$error = 'Enter your credentials please.'; 
    if ($_POST['submit']) {
        if (!$_POST['email']) $error .= "<br />Please enter your E-mail.";
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))  {
            $error .="<br />Email is invalid.";
        }
        if (!$_POST['password']) $error .= "<br />Please enter your password.";
        if ($error) {
            $error = "There were error(s) in your login information: ".$error;
        } else  {
            $pass = mysqli_real_escape_string($conn, $_POST['password']);
            $query = "SELECT * FROM students WHERE email='".mysqli_real_escape_string($conn, $_POST['email'])."' AND pass = '".$pass."' LIMIT 1";
            $result = mysqli_query($conn, $query);
            $results = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo $results;
            if ($row) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['gpa'] = $row['gpa'];
                $_SESSION['hours'] = $row['hours'];
                $_SESSION['attendance'] = $row['attendance']; 
                if ($_SESSION['email'] == 'admin@test.com') {
                    header('Location: http://ec2-54-147-207-171.compute-1.amazonaws.com/production/pages/tables.php');
                } else {
                    header('Location: http://ec2-54-147-207-171.compute-1.amazonaws.com/production/pages/index.php');              
                }

            } else if(!$results) {
                $error = "We could not find a user with those credentials. Please try again.";
            }
        }

    } else {
        $error = 'Enter your credentials, please.'; 
    }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form  method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" class="btn btn-lg btn-success btn-block" value="Sign Up" />
                            </fieldset>
                        </form>
                    </div>
                        <?php
                            if ($error == '' or $error == 'Enter your credentials, please.') {
                                 echo   '<div class="alert alert-info">'.$error.'</div>';   
                            } else {
                                echo   '<div class="alert alert-danger">'.$error.'</div>';
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
