<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .modal {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
        }
        .active {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .edit {
            width: 200px;
            height: 300px;
            background: yellow;
        }
    </style>
</head>
<body>
    <?php
        echo "<img src='./php/draw_image.php' id='chart' usemap='#map'>"
    ?>
    <map name="map" id='map'>
        <?php
        require('./php/create_map.php') 
        ?>
    </map>
    <div class="modal">
        <div class="edit">
            <input type="text" id="text"> <br/>
            <button id="save">Save temp</button> <br/>
            <button id="sick">Sick</button> <br/>
            <button id="no-data">No data</button> <br/>
            <button id="abort">Abort</button> <br/>
        </div>
    </div>
    <script src="./index.js"></script>
    <br>
    <br>
    <a href="./php/create_pdf.php">PDF</a>
</body>
</html>