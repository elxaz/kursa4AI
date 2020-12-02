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
    <link rel="stylesheet" type="text/css" href="../styles/template.css">
    <link rel="stylesheet" type="text/css" href="../styles/new_tem.css">
    <link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
    <title>Фильмы</title>
</head>
<body>


    <div class="header" align="center">

    <table border="0" width="100%" class="headerTable">
    <td>
    <a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
    <a href="index.php"><img src="../img/login.png" class="loginImg"></a>
    </td>
    <td>
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">Фильтры</button>
      <div id="myDropdown" class="dropdown-content">
        <form method="GET" action="search.php">
          <input type="text" name="filmSearch" placeholder="Название фильма" id="myInput">
          <br>
          <input type="submit" name="btn" value="Поиск" id="myInputBtn">
        </form>

        <a href="filters/year/yearFilter.php">Фильтр по году</a>
        <a href= "randomFilms.php">Что посмотреть</a>
        <a href="filters/country/countryFilter.php">Фильтр по стране</a>
        <a href="filters/genre/genreFilter.php">Фильтр по жанру</a>
        
         </div>
    </div>
    </td>
    </table>
    <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    </script>
  </div>


    <?php 
        require_once 'db.php';

        if (@$_GET['type'] == 'rand') {
            $id = $_GET['id'];
            $label = 'Что посмотреть';
        }elseif (@$_GET['type'] == 'yearFilter') {
            $id = $_GET['id'];
        }elseif (@$_GET['type'] == 'countryFilter') {
            $id = $_GET['id'];
        }elseif (@$_GET['type'] == 'genreFilter') {
            $id = $_GET['id'];
        }elseif (@$_GET['type'] == 'search'){
             $id = $_GET['id'];
        }elseif(empty($_GET)){
            //берем все фильмы и строим каталог
            // $maxId = R::count( 'film' ); //всего количество фильмов
            $maxId = R::getCol( 'SELECT `id` FROM film' );
            $maxId = max($maxId);
            $id = [];
            for ($i=1; $i <=  $maxId; $i++) { //делаем фейковый каталог айдишек
                $id[$i] = $i;
            }
            shuffle($id);// перемешивание элементов массива

        }

        $films =[];//массив в котором будут храниться фильмы

        foreach ($id as $key => $value) {//взятие всех уникальных фильмов
            $films[$key] = R::findOne('film', 'id = ?', [$value]);
        }

        $posters = [];//массив для постеров
        $names = [];//массив для имен фильмов
        $links = [];//массив для ссылок на фильмы
        $id = [];//массив для айди фильмов

        foreach ($films as $key => $value) {//разбиение глобального массива фильмы на четыре специалезированных массива
            if (!empty($films[$key])) {
                $posters[$key] = $value['poster'];
                $names[$key] = $value['name'];
                $links[$key] = $value['link'];
                $id[$key] = $value['id'];
            }
            
        }

        $i = 0;
        if (preg_match('(Android)', $_SERVER['HTTP_USER_AGENT'])
            ||preg_match('(iPod)', $_SERVER['HTTP_USER_AGENT'])
            ||preg_match('(iPhone)', $_SERVER['HTTP_USER_AGENT'])
        ) {
            $num = 1;
        }else {
            $num = 4;
        }

        echo "<table class = \"filmtable\" align=\"center\"> ";
        
        foreach ($posters as $key => $value) {
            if ($i >= $num) {//количество картинок в ряду
                echo "</tr>";
                $i = 0;
                echo "<tr>";
            }
               $i++;
               echo "<th>";
               echo "<div class=\"plates\">";            
               echo "<a href=\"view.php?id=$id[$key]\"><img src=\"$posters[$key]\" width=\"201\" height=\"300\" class = \"posterInDiv\"></a>"; 
               echo "<xmp class = \"filmNameDiv\">$names[$key]</xmp>";
               echo "</div>";
               echo "</th>"; 

            

        }
       echo "</table>";
        ?>
        <br><br>

            <div class="footer">
        <table class="headerTable">
        <th>
        <div align="left" class="copy">&#169; ICS-media <?php echo date('Y'); ?></div>
        </th>
        <th>
        <span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
        </th>
        </table>
    </div>
        </body> 
       
</body>
</html>




