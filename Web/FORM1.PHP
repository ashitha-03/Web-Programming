<html>
<head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0 auto;
    height: 100%;
    width: 30%;
}
form {
    border: 2px solid #ccc;
    padding: 30px;
    background-color: #f9f9f9;
}
.error {
    color: red;
    font-size: 0.9em;
}
.output {
    margin-top: 20px;
    padding: 15px;
    border: 2px solid #ccc;
    background-color: #f9f9f9;
    width: 80%;
    margin: 20px auto;
}
.output div {
    margin: 10px 0;
}
.output label {
    font-weight: bold;
}
</style>
</head>
<body>
<?php
$name = $email = $gender = $address = $phone = $course = "";
$nameErr = $emailErr = $genderErr = $addressErr = $phoneErr = $courseErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required.";
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else if (!strpos($_POST["email"], "@")) {
        $emailErr = "Invalid email format.";
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required.";
    } else if (strlen($_POST["phone"]) != 10 || !is_numeric($_POST["phone"])) {
        $phoneErr = "Phone number must be exactly 10 digits.";
    } else {
        $phone = $_POST["phone"];
    }
    if (empty($_POST["address"])) {
        $addressErr = "Address is required.";
    } else {
        $address = $_POST["address"];
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required.";
    } else {
        $gender = $_POST["gender"];
    }
    if (empty($_POST["course"])) {
        $courseErr = "Please select a course.";
    } else {
        $course = $_POST["course"];
    }
}
?>
<br><br>
<h2><center>PHP Form Validation</center></h2><br>
<form method="post" action="">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <div class="error"><?php echo $nameErr; ?></div><br>
    E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <div class="error"><?php echo $emailErr; ?></div><br>
    Phone: <input type="text" name="phone" value="<?php echo $phone; ?>">
    <div class="error"><?php echo $phoneErr; ?></div><br>
    <label for="course">Course:</label><br>
    <input type="checkbox" name="course" value="CS" <?php if ($course == "CS") echo "checked"; ?>>Btech CS<br>
    <input type="checkbox" name="course" value="Civil" <?php if ($course == "Civil") echo "checked"; ?>>Btech Civil<br>
    <input type="checkbox" name="course" value="ECE" <?php if ($course == "ECE") echo "checked"; ?>>Btech ECE<br>
    <input type="checkbox" name="course" value="Mech" <?php if ($course == "Mech") echo "checked"; ?>>Btech Mech<br>
    <input type="checkbox" name="course" value="MCA" <?php if ($course == "MCA") echo "checked"; ?>>MCA<br>
    <div class="error"><?php echo $courseErr; ?></div><br>
    Address: <textarea name="address" rows="5" cols="40"><?php echo $address; ?></textarea>
    <div class="error"><?php echo $addressErr; ?></div><br>
    Gender:
    <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>>Female
    <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>>Male
    <input type="radio" name="gender" value="Other" <?php if ($gender == "Other") echo "checked"; ?>>Other
    <div class="error"><?php echo $genderErr; ?></div><br><br>
    <input type="submit" name="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) &&
    empty($emailErr) && empty($phoneErr) && empty($addressErr) && empty($genderErr)
    && empty($courseErr)) {
    echo "<div class='output'>";
    echo "<h3>Your Inputs:</h3>";
    echo "<div><label>Name:</label> " . $name . "</div>";
    echo "<div><label>Email:</label> " . $email . "</div>";
    echo "<div><label>Phone No:</label> " . $phone . "</div>";
    echo "<div><label>Course:</label> " . $course . "</div>";
    echo "<div><label>Address:</label> " . $address . "</div>";
    echo "<div><label>Gender:</label> " . $gender . "</div>";
    echo "</div>";
}
?>
</body>
</html>
