<?php 
    function print_pre($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";

    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/show.css">
    <title>Фильмы</title>
</head>
<body>
    <?php 
        require_once 'db.php';

        if (@$_GET['type'] == 'rand') {
            $id = $_GET['id'];
        }elseif (@$_GET['type'] == 'yearFilter') {
            $id = $_GET['id'];
        }elseif (@$_GET['type'] == 'search'){
             $id = $_GET['id'];
        }elseif(empty($_GET)){
            //берем все фильмы и строим каталог
            $maxId = R::count( 'film' ); //всего количество фильмов
            $id = [];
            for ($i=1; $i <=  $maxId; $i++) { //делаем фейковый каталог айдишек
                $id[$i] = $i;
            }
            shuffle($id);// перемешивание элементов массива

        }elseif (@$_GET['type'] == 'pages'){
             $id = $_GET['id'];
         }



        $films =[];//массив в котором будут храниться фильмы

        foreach ($id as $key => $value) {//взятие всех уникальных фильмов
            $films[$key] = R::findOne('film', 'id = ?', [$value]);
        }

        $posters = [];//массив для постеров
        $names = [];//массив для имен фильмов
        $links = [];//массив для ссылок на фильмы
        $id = [];//массив для айди фильмов

        foreach ($films as $key => $value) {//разбиение глобального массива фильмы на три специалезированных массива
            $posters[$key] = $value['poster'];
            $names[$key] = $value['name'];
            $links[$key] = $value['link'];
            $id[$key] = $value['id'];
        }

        $i = 0;

        echo "<table class = \"filmtable\" align=\"center\"> ";
       
        foreach ($posters as $key => $value) {
            if ($i >= 4) {//количество картинок в ряду
                echo "</tr>";
                $i = 0;
                echo "<tr>";
            }
            $i++;
            echo "<th>";
            echo "<div class=\"plates\">";            
            echo "<a href=\"http://localhost:8080/cgi/view.php?id=$id[$key]\"><img src=\"$posters[$key]\" width=\"201\" height=\"300\" class = \"posterInDiv\"></a>"; 
            echo "<xmp class = \"filmNameDiv\">$names[$key]</xmp>";
            echo "</div>";
            echo "</th>";

        }
       echo "</table>";
        ?>
       
</body>
</html>




