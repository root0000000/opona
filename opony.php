<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPONY</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'opony';

    $connection = mysqli_connect($server, $user, $password, $database);

    if (!$connection) {
        echo mysqli_error($connection);
    }
    ?>
    <main id="blok_glowny">
        <section id="blok_boczny">
            <?php
            header('refresh: 10; url=opony.php');
            ?>
            <?php

            $query = "SELECT opony.nr_kat, opony.producent, opony.model, opony.sezon, opony.cena FROM opony ORDER BY cena ASC LIMIT 10;";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_row($result)) {
                if ($row[3] == "letnia") {
                    $image = "lato";
                } elseif ($row[3] == "zimowa") {
                    $image = "zima";
                } elseif ($row[3] == "uniwersalna") {
                    $image = "uniwer";
                }
                echo "
            <div class='opona'>
                <img src='$image.png' class='icon' alt='snowflake'>
                <h4>Opona: $row[1] $row[2]</h2>
                    <h3>Cena: $row[4]</h3>
            </div>";
            }
            ?>
            <div>
                <p><a href="https://opona.pl">więcej ofert</a></p>
            </div>
        </section>
        <section id="sekcja_1">
            <img src="opona.png" alt="Opona">
            <h2>Opona dnia</h2>
            <?php
            $query = "SELECT opony.producent, opony.model, opony.sezon, opony.cena FROM opony WHERE opony.nr_kat = 9;";
            $result = mysqli_query($connection, $query);

            $row = mysqli_fetch_row($result);

            echo "<h2> $row[0] model $row[1]</h2>";
            echo "<h2>Sezon: $row[2] </h2>";
            echo "<h2>Tylko $row[3] zł!</h2>";
            ?>
        </section>
        <section id="sekcja_2">
            <h2>Najnowsze zamówenie</h2>
            <?php
            $query = "SELECT zamowienie.id_zam, zamowienie.ilosc, opony.model, opony.cena FROM zamowienie INNER JOIN opony ON opony.nr_kat=zamowienie.nr_kat ORDER BY RAND() LIMIT 1;";
            $result = mysqli_query($connection, $query);

            $row = mysqli_fetch_row($result);

            $wartosc = $row[1] * $row[3];

            echo "<h2> $row[0] $row[1] sztuki modelu $row[2] </h2>";
            echo "<h2>Wartość zamówienia $wartosc zł</h2>";

            $query = mysqli_close($connection);
            ?>
        </section>
    </main>
    <footer id="block_stopki">
        <p>Stronę wykonał: 00000000000</p>
    </footer>

</body>

</html>