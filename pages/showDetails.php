<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: ../index.php');
    exit();
}

// Check if form data exists in the session
if (isset($_SESSION['entries']) && !empty($_SESSION['entries'])) {
    $entries = $_SESSION['entries'];
} else {
    echo "No information available. Please go back and submit the form.";
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    unset($_SESSION['entries'][$deleteIndex]);
    $_SESSION['entries'] = array_values($_SESSION['entries']);  // Re-index array
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
    <title>Show Details</title>
    <?php include('../layout/style.php'); ?>
    <style>
    .entries-container {
    max-width: 600px;
    margin: 30px auto;
    padding: 20px;
    background-color: #ffe3e3; /* Soft pink background */
    border: 1px solid #e2a4a4;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.entries-container h2 {
    text-align: center;
    color: #d35d6e; /* Dark pink heading */
    font-size: 1.8em;
    margin-bottom: 20px;
}
.entry-card {
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #e2a4a4;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.entry-card p {
    margin: 5px 0;
    color: #555;
}
.entry-card .action-links a {
    display: inline-block;
    margin-right: 10px;
    padding: 8px 12px;
    font-size: 0.9em;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
}
.entry-card .action-links .edit-btn {
    background-color: #7ca982; /* Light green for edit */
}
.entry-card .action-links .delete-btn {
    background-color: #d35d6e; /* Soft red for delete */
}
.add-entry-link {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #5a9ad4; /* Light blue for add new entry */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1em;
}
.add-entry-link:hover {
    background-color: #487a9e; /* Darker blue on hover */
}

    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('../layout/header.php'); ?>
    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="entries-container">
                        <h2>Submitted Details</h2>
                        <?php foreach ($entries as $index => $entry): ?>
                            <div class="entry-card">
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p><strong>Age:</strong> <?php echo htmlspecialchars($entry['age'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p><strong>Gender:</strong> <?php echo htmlspecialchars($entry['gender'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <div class="action-links">
                                    <a href="addForm.php?edit=<?php echo $index; ?>" class="edit-btn">Edit</a>
                                    <a href="showDetails.php?delete=<?php echo $index; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <a href="addForm.php" class="add-entry-link">Add New Form</a>
                    </div>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>
    <?php include('../layout/script.php'); ?>
</body>
</html>
