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
            max-width: 800px;
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

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 8px;
            width: 200px;
            border: 1px solid #e2a4a4;
            border-radius: 5px;
        }

        .search-container button {
            padding: 8px 12px;
            color: #fff;
            background-color: #d35d6e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #b24b5b;
        }

        /* Table structure */
        .table-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            gap: 10px;
            text-align: center;
        }

        .table-header {
            font-weight: bold;
            color: #d35d6e;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2a4a4;
        }

        /* Entry cells styling */
        .entry-cell {
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            color: #555;
        }

        /* Action buttons */
        .action-links a {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 12px;
            font-size: 0.9em;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .action-links .edit-btn {
            background-color: #7ca982;
        }
        .action-links .delete-btn {
            background-color: #d35d6e;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('../layout/header.php'); ?>
    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="entries-container">
                    <h2>Submitted Details</h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Campus</th>
                                        <th>College</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Campus</th>
                                        <th>College</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($entries as $index => $entry): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($entry['age'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($entry['gender'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($entry['campus'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($entry['college'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <a href="addForm.php?edit=<?php echo $index; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="showDetails.php?delete=<?php echo $index; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Include DataTable JS script -->
                    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#datatablesSimple').DataTable();
                        });
                    </script>

                    <a href="addForm.php" class="add-entry-link">Add New Form</a>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>
    <?php include('../layout/script.php'); ?>
</body>
</html>
