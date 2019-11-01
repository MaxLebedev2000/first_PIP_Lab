<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LebedevME</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/script.js?<?=time()?>"></script>
    <script src="jq"></script>
    <script type="text/javascript">
        var x;
        var y;
        var r;


        function validate() {
            let vars = [];
            y = y.trim().replace(",", ".");
            if(y.includes('.')){ 
                alert(y);
                y = y.substr(0,6);
            }
        

            if (x === undefined) vars.push("X");
            if (y === undefined || y === "") vars.push("Y");
            if (r === undefined) vars.push("R");

            if (vars.length !== 0) return 'Значения ' + vars.join(', ') + ' не инициализированы';

            if (isNaN(y)) return 'Значение Y должно быть числом';

            if (!(y > -3 && y < 5)) return 'Значение Y должно быть в промежутке (-3; 5)';

            return 'good';
        }

        function checkButton(button) {
            const btnColor = "#C2C0C0";

            let allButtons = document.getElementsByName("x");
            for (let i = 0; i < allButtons.length; i++) {
                allButtons[i].style.backgroundColor = btnColor;
            }
            button.style.backgroundColor = "red";
            x = button.value;
        }

        function send() {

            y = document.getElementById("y").value;

            let select = document.getElementById("r-value");
            r = select.options[select.selectedIndex].value;

            let error = validate();

            if (error === "good") {
                document.getElementById("error").innerHTML="";
                let form = document.createElement("form");
                form.method = "GET";
                form.type = "hidden";
                //form.target = "_blank";

                form.innerHTML = "<input type=\"hidden\" name=\"x\" value=\"" + x + "\">" +
                    "<input type=\"hidden\" name=\"y\" value=\"" + y + "\">" +
                    "<input type=\"hidden\" name=\"r\" value=\"" + r + "\">" +
                    "<input type=\"hidden\" name=\"uniqid\" value=\"<?=uniqid()?>\">";

                    document.body.appendChild(form);

                form.submit();
            } else {

                let errorBlock = document.getElementById("error");
                errorBlock.innerHTML=error;
            }
        }
    </script>

    <link rel="stylesheet" href="styles/style.css?<?=time()?>">
    <style type="text/css">


        p {
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
        }

        body {
            background: #053f38;
        }

        input[type="text"] {
            border: 1px solid #98baba;
            background: transparent;
            padding: 1px 4px;
            color: #fff;
        }

        input[type="text"]::-webkit-input-placeholder {
            color: #084402;
        }


    </style>


</head>

<body>
<!-- Type your html here -->
<header>
    <div class="hat">
        <table class="head_table" border="3">
            <tr>
                <td rowspan="3" class="first"><h1 class="h1">Лабораторная работа №1 по Веб-Программированию</h1></td>
                <td><p>Студент: Лебедев Максим </p></td>
            <tr>
                <td><p>Группа: P3211 </p></td>
            </tr>
            <tr>
                <td><p>Вариант: 211012 </p></td>
            </tr>
            </tr>
        </table>
    </div>
</header>

<table class="table_main" border="3">
    <!-- ask value -->
    <tr>
        <td class="left">
            <table class="left_table">
                <tr>
                    <td>Выберите значение Х: <br>
                        <div id="x-buttons">
                            <input onclick="checkButton(this)" type="button" value="-2" name="x">
                            <input onclick="checkButton(this)" type="button" value="-1.5" name="x">
                            <input onclick="checkButton(this)" type="button" value="-1" name="x">
                            <input onclick="checkButton(this)" type="button" value="-0.5" name="x">
                            <input onclick="checkButton(this)" type="button" value="0" name="x">
                            <input onclick="checkButton(this)" type="button" value="0.5" name="x">
                            <input onclick="checkButton(this)" type="button" value="1" name="x">
                            <input onclick="checkButton(this)" type="button" value="1.5" name="x">
                            <input onclick="checkButton(this)" type="button" value="2" name="x">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Введите значение Y в диапозоне (-3,5): <br>
                        <div class="vars">
                            <div id="yField"><input type="text" placeholder="-2" id="y"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Выберите значение R:<br>
                        <div>
                            <select id="r-value">
                                <option value="0" name="r">Выберете значение R</option>
                                <option value="1" name="r">1</option>
                                <option value="2" name="r">2</option>
                                <option value="3" name="r">3</option>
                                <option value="4" name="r">4</option>
                                <option value="5" name="r">5</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="submit-btn" type="button" value="Проверить" onclick="send()">
                    </td>
                </tr>
            </table>
        </td>

        <!-- picture and answer -->
        <td class="right">
                <table class="right-table" >
                    <tr style="width: inherit">
                        <td class="picture_right">
                            <img src="graphicLast.png" alt="График">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="error"></div>
                        </td>
                    </tr>
                        <?php
$begin = microtime(true);
global $results;
$results = [];

if (count($_GET) == 4) {
    $x = $_GET['x'];
    $y = $_GET['y'];
    $r = $_GET['r'];
    
    $x = str_replace(",", ".", $x);
    $y = str_replace(",", ".", $y);
    $r = str_replace(",", ".", $r);

        if(strpos($x, ".")){
            $x = substr($x, 0, 6);
        }
        if(strpos($y, ".")){
            $y = substr( $y, 0, 6);
        }
        if(strpos($r, ".")){
            $r = substr($r,     0, 6);

        }
    $correct = false;
    
    $X_VALUES = [-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2];
    $R_VALUES = [1, 2, 3, 4, 5];
    
    $is_numeric = is_numeric($x) && is_numeric($y) && is_numeric($r);
    $is_correct = in_array($x, $X_VALUES) && ($y > -3 && $y < 5) && in_array($r, $R_VALUES);
    if ($is_numeric && $is_correct) {
        
        //$result = "Данная точка Х= $x, Y= $y не входит в синюю область, при R= $r";
        $result = "Не попали";
        if ($x < 0) {
            if (0 <= $y && $y < $r / 2 && -$r < $x && $x < 0) {
                // $result = "Данная точка Х= $x, Y= $y входит в синюю область,\n при R= $r";
                $result = "Попадание";
            }
        } else {
            if ($y <= 0 && (pow($x, 2) + pow($y, 2) < pow($r, 2))) {
                //$result = "Данная точка Х= $x, Y= $y входит в синюю область,\n при R= $r";
                $result = "Попадание";
            } elseif ((pow($x, 2) + pow($y, 2) < pow($r, 2)) && $x < $r / 2 && $y < $r) {
                //$result = "Данная точка Х= $x, Y= $y входит в синюю область,n при R= $r";
                $result = "Попадание";
            }
        }
         setlocale(LC_ALL, 'ru_RU.UTF-8');
        
        $time        = strftime('%d %b %Y %H:%M:%S', time()+3*60*60);
        $script_time = round((microtime(true) - $begin) * 1000, 5);
        $uniqid = $_GET['uniqid'];
        
        $res = isset($_SESSION['results']) && is_array($_SESSION['results']) ? $_SESSION['results'] : [];
        if (!isset($res[0]) || $res[0]['uniqid'] !== $uniqid||(($res[0]['r'] !== $r)||($res[0]['x'] !== $x)||($res[0]['y']!== $y))) {
            array_unshift($res, [
                'x' => $x,
                'y' => $y,  
                'r' => $r,
                'result' => $result,
                'current_time' => $time,
                'elapsed_time' => $script_time,
                'uniqid' => $uniqid
            ]);
        }

        $_SESSION['results'] = $res;
    } else {
        if (!$is_numeric) {
            $error_message = "Введенные данные не являются числом";
        } else if (!$is_correct) {
            $error_message = " Введённое значение переменной некорректно, попробуйте снова";
        }
?>
                    <tr>
                        <td>
                            <div class="result"><?= $error_message ?></div>
                            <div class="result"><?= $script_time ?></div>
                        </td>
                    </tr>
                        <?php
    }
?>
                    <tr>
                        <td>
                            <div class="answer-table-wrapper">
                                <table border="3" class="answer-table">
                                    <thead>
                                        <tr>
                                            <th>X</th>
                                            <th>Y</th>
                                            <th>R</th>
                                            <th>Результат</th>
                                            <th>Текущее время</th>
                                            <th>Время работы скрипта</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
$res = isset($_SESSION['results']) && is_array($_SESSION['results']) ? $_SESSION['results'] : [];    
foreach ($res as $val):
    ?>
                                        <tr>
                                            <td><div class="result"><?= $val['x'] ?></div></td>
                                            <td><div class="result"><?= $val['y'] ?></div></td>
                                            <td><div class="result"><?= $val['r'] ?></div></td>
                                            <td><div class="result"><?= $val['result'] ?></div></td>
                                            <td><div class="result"><?= $val['current_time'] ?></div></td>
                                            <td><div class="result"><?= $val['elapsed_time'] ?> мс</div></td>
                                        </tr>
<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
<?php
}
?>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

