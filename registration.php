<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Form</title>
</head>
<style>
    .error {color: #FF0000}
      div {
        margin-bottom: 10px;
      }
      label {
        display: inline-block;
        width: 150px;
        text-align: right;
      }

      /*Positioning for the checkbox*/
      label[for="checkbox"] {
        display: inline-block;
        vertical-align: middle;
      } 
      
      /*style for the submit button*/ 
      input[type="submit"]{
        background-color: green;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
      }

      /*style for the reset button*/
      input[type="reset"]{
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
      }

      .button-container {
        text-align: middle;
      }

      label[for="checkbox"]{
        display: inline-block;
        vertical-align: top;
        margin-right: 10px;
      }

    </style>
<body>

      <?php
      //validation
      $nameErr = $emailErr = $passwordErr = $con_passErr = $genderErr = $terms_conErr ="";
      $name = $email = $password = $con_pass = $gender = $terms_con = "";

      if($_SERVER["REQUEST_METHOD"] == "POST")
      {
        if(empty($_POST["name"])) {
          $nameErr = "Name is required!";
        }
        else {
          $name = test_input($_POST["name"]);
        }

        if(empty($_POST["email"])) {
          $emailErr = "Email is required!";
        }
        else {
          $email = test_input($_POST["email"]);
        }

        if(empty($_POST["password"])) {
          $passwordErr = "Password is required!";
        }
        else {
          $password = test_input($_POST["password"]);
        }

        if(empty($_POST["confirm password"])) {
          $con_passErr = "Password is not confirm!";
        }
        else {
          $con_pass = test_input($_POST["confirm password"]);
        }

        if(empty($_POST["gender"])) {
          $genderErr = "Gender is required!";
        }
        else {
          $gender = test_input($_POST["gender"]);
        }

        if(empty($_POST["terms and condition"])) {
          $terms_conErr = "you must accept the term and condition!";
        }
        else {
          $terms_con = test_input($_POST["terms and condition"]);
        }
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      ?>

    <h1>Registration Form</h1>
    <p><span class="error">* required field</span></p>
    <form action = "regdb.php" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
        <label>Name: </label>
        <input type ="text" name="Name" placeholder="Enter name">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>

        <label>Email: </label>
        <input type ="Email" name="email" placeholder="Enter email">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>

        <label>Password: </label>
        <input type ="password" name="password" placeholder="Enter password">
        <span class="error">* <?php echo $passwordErr;?></span>
        <br><br>

        <label>Confirm password: </label>
        <input type ="password" name="confirm password" placeholder="Confirm password">
        <span class="error">* <?php echo $con_passErr;?></span>
        <br><br>

        <label>Gender: </label>
        <input type ="radio" name="gender" value="female">Female
        <input type ="radio" name="gender" value="Male">Male
        <span class="error">* <?php echo $genderErr;?></span>
        <br><br>

        <label>Website: </label>
        <input type ="text" name="website" placeholder="Website">
        <br><br>

        <label>Profile Picture: </label>
        <input id="myfile" type="file"/>
        <br><br>

      <div class="checkbox-container">
        <input id="checkbox" type="checkbox"/>
        <span class="error">* <?php echo $terms_conErr;?></span>
        <label for="checkbox">I accept the terms & conditions</label>
        <br><br>
    </div>

      <div class="button-container">
        <input type="submit" value="submit">
        <input type="reset" value="reset"><br>
      </div>  
    </form>
    
</body>
</html>


<?php
// STORING DATA INTO THE DATABASE USING A PHP SCRIPT
include("regdb.php");
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_pass = $_POST['confirm password'];
    $gender = $_POST['gender'];
    $website = $_POST['website'];
    $pro_pic = $_POST['filename'];

    $sql="INSERT INTO users (Name, Email, Password, con_pass, Website, pro_pic)
    VALUES ('$name', '$email', '$password', '$con_pass', '$gender', '$website', '$pro_pic')";
    if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
    }
    else {
        echo "Error: " . $sql . ":-" . mysql_error($conn);
    }
    mysqli_close($conn);
}




?>