<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <title>Gidget Store - Dashboard</title>
    <!-- bootstap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Khmer OS Battambang', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #306238;
            color: white;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-sizing: border-box;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .sidebar {
            width: 250px;
            background-color: #349327;
            color: white;
            height: 100vh;
            position: fixed;
            top: 70px;
            left: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            font-size: 18px;
            border-bottom: 1px solid #ffffff;
            padding-bottom: 10px;
            text-align: center;
        }

        .sidebar a {
            color: #ffffff;
            display: block;
            padding: 12px 0;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: white;
            padding-left: 10px;
        }

        .main-content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 30px 50px;
        }
        .main-content h2{
            color: #333;
            text-align: center;
        }
        .alert-content{
            margin-left: 270px;
            margin-top: 80px;
            padding: 15px 50px;
            width: 500px;
            height: 50px; 
        }
        .cards {
            display: flex;
            gap: 20px;
        }

        .cards a {
            flex: 1;
            text-decoration: none;
            display: flex;
        }

        .card {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 35px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            flex: 1;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin: 0;
            color: #7f8c8d;
            font-size: 16px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #2b6a23f3;
            color: white;
        }


        .status-low {
            color: red;
            font-weight: bold;
        }

        .status-ok {
            color: green;
        }

        .add-btn {
            background: #306238;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
            
        }

        .form-content h2{
            text-align: center;
            color: #252525;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #3a3a3a;
        }
        .form-contain {
            margin-left: 250px;
            margin-top: 70px;
            padding: 30px 200px;
        }

        .btn-update {
            background-color: #3498db;
            color: white;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
            display: flex;
            gap: 5px;
            justify-content: center;
            align-items: center;
        }
        .center{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-update:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            width: 100px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .action-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            padding:1px;
        }
        .form-box { 
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            width: 80%; 
}
        .form-content{
            margin-left: 250px;
            margin-top: 100px;
            padding: 10px 100px;
            font-family: 'Khmer OS Battambang', sans-serif; 
            display: flex; 
            justify-content: center; 
            background-color: #f4f4f4; 
        }
        input { 
            width: 100%; 
            padding: 10px; 
            margin: 5px 0; 
            border: 1px solid #8f8d8d; 
            border-radius: 4px; 
            box-sizing: border-box; 
            color: #535353;}
        .update-btn { 
            background: #349327f3; 
            color: white; 
            border: none; 
            width: 100%; 
            padding: 10px; 
            cursor: pointer; 
            border-radius: 4px; }
        .update-btn:hover{
            background-color: #349327ae;
        }
    </style>
</head>

<body>

    <!-- Navbar Section -->
    <div class="navbar">
        <div class="navbar-brand">Gidget Store</div>
        <div class="user-profile" style="margin-right: 150px;">
            <img src="imgs/image.png" alt="Profile" style="margin-right: 20px;">
            <span>Hem Keopisey</span>

        </div>
    </div>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Inventory System</h2>
        <a href="dashboard.php">🏠 ទំព័រដើម</a>
        <a href="list.php">📦 បញ្ជីទំនិញ</a>
        <a href="add.php">➕ បន្ថែមទំនិញ</a>
    </div>