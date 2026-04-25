<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Notes</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f6f9;
            text-align: center;
        }

        h2 {
            padding: 20px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: white;
            width: 260px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subject {
            color: #555;
            margin-bottom: 15px;
        }

        a {
            text-decoration: none;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }

        a:hover {
            background: #0056b3;
        }

        .top-btn {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<h2>📚 Available Notes</h2>

<a href="index.html" class="top-btn">Home</a>

<div class="container">

<?php
$query = "SELECT notes.title, notes.file_name, subjects.subject_name
          FROM notes
          JOIN subjects ON notes.subject_id = subjects.id";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){
?>

    <div class="card">
        <div class="title"><?php echo $row['title']; ?></div>
        <div class="subject"><?php echo $row['subject_name']; ?></div>

        <a href="uploads/<?php echo $row['file_name']; ?>" download>
            Download
        </a>
    </div>

<?php } ?>

</div>

</body>
</html>