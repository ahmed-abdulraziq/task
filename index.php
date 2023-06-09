<?php
$endpoint = 'latest';
$access_key = '239da580925d2e724168af5c88bb2ca7';

$ch = curl_init('http://data.fixer.io/api/' . $endpoint . '?access_key=' . $access_key . '');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($ch);
curl_close($ch);

$exchangeRates = json_decode($json, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *:not(div) {
            margin: 5px 0;
            padding: 10px;
            font-size: 30px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: auto;
            display: flex;
            flex-direction: column;
            background-color: #aaa;
            width: 500px;
        }

        form label {
            color: #fff;
        }

        form select {
            width: 100%;
        }

        form input {
            width: auto;
        }
    </style>
</head>

<body>
    <h1>
        <?php
        echo $_SERVER['REQUEST_METHOD'] === "POST" ?
        round(($_POST['to'] * $_POST['num']) / $_POST['from']) : '1';
        ?>
    </h1>
    <form action="" method="post">
        <div>
            <label for="from">from</label>
            <select name="from" id="from">
                <?php
                $selected = $_SERVER['REQUEST_METHOD'] === "POST" && $_POST['from'];
                foreach ($exchangeRates['rates'] as $key => $value) {
                    echo "<option value='$value'>$key</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="to">to</label>
            <select name="to" id="to">
                <?php
                foreach ($exchangeRates['rates'] as $key => $value) {
                    echo "<option value='$value'>$key</option>";
                }
                ?>
            </select>
        </div>
        <input type="number" name="num" id="num" value="1">
        <input type="submit" value="submit">
    </form>
</body>

</html>