<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: ../index.php');
    exit();
}

if (!isset($_SESSION['entries'])) {
    $_SESSION['entries'] = [];
}


if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $gender = htmlspecialchars($_POST['gender']);
    $campus = htmlspecialchars($_POST['campus']);
    $college = htmlspecialchars($_POST['college']);
   
    if (isset($_POST['edit_index'])) {
        $index = $_POST['edit_index'];
        $_SESSION['entries'][$index] = compact('name', 'age', 'gender', 'campus', 'college');
    } else {
        
        $_SESSION['entries'][] = compact('name', 'age', 'gender', 'campus', 'college');
    }
    
    header('Location: showDetails.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Form</title>
    <?php include('../layout/style.php'); ?>
    <style>
        .form-container {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #e1b3cb;
            border-radius: 8px;
            background-color: #ffeaf1; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            color: #b15c85; 
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            font-weight: bold;
            color: #854d68; 
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #d08ab6;
            font-size: 1em;
        }
        .form-container input, .form-container select {
            background-color: #fbe7ef; 
            color: #5b3c4e; 
        }
        .form-container button[type="submit"] {
            background-color: #b15c85; 
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .form-container button[type="submit"]:hover {
            background-color: #993f6d; 
        }
        a {
            color: #b15c85;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    </style> 
</head>
<body class="sb-nav-fixed">
    <?php include('../layout/header.php'); ?>

    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="container">
                        <div class="form-container">
                            <h2><?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Form</h2>
                            <form action="" method="POST">
    <?php if (isset($_GET['edit'])): ?>
        <?php 
            $index = $_GET['edit'];
            $entry = $_SESSION['entries'][$index];
        ?>
        <input type="hidden" name="edit_index" value="<?php echo $index; ?>">
    <?php endif; ?>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" 
           value="<?php echo isset($entry) ? htmlspecialchars($entry['name']) : ''; ?>" 
           placeholder="Enter name" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" 
           value="<?php echo isset($entry) ? htmlspecialchars($entry['age']) : ''; ?>" 
           placeholder="Enter age" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="" disabled selected>Select gender</option>
        <option value="Male" <?php echo isset($entry) && $entry['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo isset($entry) && $entry['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
    </select>

 
    <label for="campus">Campus:</label>
    <select id="campus" name="campus" required>
        <option value="" disabled selected>Select campus</option>
        <option value="Sta. Cruz" <?php echo isset($entry) && $entry['campus'] === 'Sta. Cruz Campus' ? 'selected' : ''; ?>>Sta. Cruz Campus</option>
        <option value="Boac" <?php echo isset($entry) && $entry['campus'] === 'Boac Campus' ? 'selected' : ''; ?>>Boac Campus</option>
        <option value="Torrijos" <?php echo isset($entry) && $entry['campus'] === 'Torrijos Campus' ? 'selected' : ''; ?>>Torrijos Campus</option>
        <option value="Gasan" <?php echo isset($entry) && $entry['campus'] === 'Gasan Campus' ? 'selected' : ''; ?>>Gasan Campus</option>
    </select>

  
    <label for="college">College:</label>
    <select id="college" name="college" required>
        <option value="" disabled selected>Select college</option>
        <option value="Governance" <?php echo isset($entry) && $entry['college'] === 'Governance' ? 'selected' : ''; ?>>College of Governance</option>
        <option value="Computing Sciences" <?php echo isset($entry) && $entry['college'] === 'Computing Sciences' ? 'selected' : ''; ?>>College of Computing Sciences</option>
        <option value="Engineering" <?php echo isset($entry) && $entry['college'] === 'Engineering' ? 'selected' : ''; ?>>College of Engineering</option>
        <option value="Accountancy" <?php echo isset($entry) && $entry['college'] === 'Accountancy' ? 'selected' : ''; ?>>College of Accountancy</option>
    </select>

    <button type="submit" name="submit"><?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Form</button>
</form>

                            <br>
                            <a href="showDetails.php">View Details</a>
                        </div> 
                    </div>
                </main>
                <?php include('../layout/footer.php'); ?>
            </div>
        </div>
        <?php include('../layout/script.php'); ?>
    </body>
</html>
