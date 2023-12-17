<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Database</title>
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
            color: #FCD232;
            font-size: 25px;
            text-align: left;
        }
        th{
            background-color: #FCD232;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Име и презиме</th>
            <th>Име на Компанија</th>
            <th>Имејл на компанијата</th>
            <th>Телефонски број</th>
            <th>Тип на студент</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "staff");
        if ($conn-> connect_error){
            die("Connection failed:" . $conn-> connect_error);
        }
        $sql = "SELECT id, name, company, email, phone, student-type from staff";
        $result = $conn-> query($sql);

        if ($result-> num_rows > 0){
            while ($row = $result-> fetch_assoc()){
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["company"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["student-type"] . "</td></tr>"; 
            }
            echo "</table>";

        }
        else{
            echo "0 result";

        }
        $conn-> close();
        ?>
    </table>
    
</body>
</html>
