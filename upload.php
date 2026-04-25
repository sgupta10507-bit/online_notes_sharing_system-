<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="file"] {
            border: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .top-links {
            margin-bottom: 15px;
        }

        .top-links a {
            margin: 0 5px;
            text-decoration: none;
            color: #007bff;
        }

        .top-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="upload-box">

    <div class="top-links">
        <a href="index.html">Home</a> |
        <a href="view_notes.php">View Notes</a> |
        <a href="logout.php">Logout</a>
    </div>

    <h2>📤 Upload Notes</h2>

    <form action="" method="POST" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="Enter Title" required>

        <select name="subject" required>
            <option value="">Select Subject</option>

            <?php
            $sub = mysqli_query($conn, "SELECT * FROM subjects");
            while($row = mysqli_fetch_assoc($sub)){
                echo "<option value='".$row['id']."'>".$row['subject_name']."</option>";
            }
            ?>
        </select>

        <input type="file" name="file" required>

        <button type="submit" name="upload">Upload</button>
    </form>

</div>

</body>
</html>

<?php
if(isset($_POST['upload'])){

    $title = $_POST['title'];
    $subject = $_POST['subject'];

    $file_name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];

    move_uploaded_file($temp_name, "uploads/".$file_name);

    $query = "INSERT INTO notes(title, subject_id, file_name) 
              VALUES('$title','$subject','$file_name')";

    mysqli_query($conn, $query);

    echo "<script>alert('File Uploaded Successfully');</script>";
}
?>