<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        form {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            width: 300px;
        }
        input {
            margin: 10px 0;
            padding: 5px;
            width: 90%;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Electricity Bill Calculator</h1>
    <?php
        $result_str = '';
        $name = $consumer_id = $units = '';
        $nameErr = $consumerIdErr = $unitsErr = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $consumer_id = $_POST['consumer_id'];
            $units = $_POST['units'];

         
            if (empty($name)) {
                $nameErr = "Consumer name is required.";
            }
            if (empty($consumer_id)) {
                $consumerIdErr = "Consumer ID is required.";
            }
            if (empty($units) || !is_numeric($units) || $units <= 0) {
                $unitsErr = "Please enter a valid number of units.";
            }

            if (empty($nameErr) && empty($consumerIdErr) && empty($unitsErr)) {
                $result = calculate_bill($units);
                $result_str = "Consumer Name: " . $name . "<br>";
                $result_str .= "Consumer ID: " . $consumer_id . "<br>";
                $result_str .= "Total amount for " . $units . " units is ₹" . $result;
            }
        }

        function calculate_bill($units) {
            $rate1 = 5.00;    
            $rate2 = 7.50;    
            $rate3 = 10.00;   

            if ($units <= 100) {
                $bill = $units * $rate1;
            } else if ($units <= 200) {
                $bill = (100 * $rate1) + (($units - 100) * $rate2);
            } else {
                $bill = (100 * $rate1) + (100 * $rate2) + (($units - 200) * $rate3);
            }
            return number_format((float)$bill, 2, '.', '');
        }
    ?>

    <form method="post" action="">
        <label for="name">Consumer Name:</label><br>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required><br>
        <span class="error"><?php echo $nameErr; ?></span><br>

        <label for="consumer_id">Consumer ID:</label><br>
        <input type="text" name="consumer_id" id="consumer_id" value="<?php echo $consumer_id; ?>" required><br>
        <span class="error"><?php echo $consumerIdErr; ?></span><br>

        <label for="units">Enter number of units:</label><br>
        <input type="number" name="units" id="units" placeholder="Units consumed" value="<?php echo $units; ?>" required><br>
        <span class="error"><?php echo $unitsErr; ?></span><br>

        <input type="submit" value="Calculate Bill">
    </form>

    <div class="result">
        <?php echo $result_str; ?>
    </div>
</body>
</html>
