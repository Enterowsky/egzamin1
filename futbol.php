<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozgrywki futbolowe</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div id="baner">
        <h2>Światowe rozgrywki piłkarskie</h2>
        <img src="dane/obraz1.jpg" alt="boisko">
    </div>
    <div id="mecze">
    <?php
    $conn = mysqli_connect("localhost","root","","egzamin123");
    $sql = "SELECT zespol1, zespol2, wynik, data_rozgrywki FROM rozgrywka WHERE zespol1='EVG';";
    
    $result=mysqli_query($conn,$sql);

    if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<section>";
        echo "<h3>" . $row["zespol1"] . " - " . $row["zespol2"] . "</h3>";
        echo "<h4> " . $row["wynik"] . "</h4>";
        echo "<p>w dniu: " . $row["data_rozgrywki"] . "</p>";
        echo "</section>";
    }
} else {
    echo "Brak wyników.";
}
    ?>
    </div>
    <div id="main"><h2>Reprezentacja Polski</h2></div>
    <div id="lewy">
        <p>Podaj pozycję zawodników (1-bramkarze,2-obrońcy,3-pomocnicy,4-napastnicy)</p>
        <FORM method="POST">
            <input type="number" name="pozycja" min="1" max="4" required>
            <button type="submit">Sprawdź</button>
        </FORM>
        <ul>
      <?php
      if ($result === false) {
        echo "<li>Błąd zapytania SQL: " . mysqli_error($conn) . "</li>";
    } else {
      $pozycja = (int)$_POST["pozycja"];
      $sql = "SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id = $pozycja";
      $result = mysqli_query($conn, $sql);

      // Wyświetlanie wyników jako lista punktowana
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<li>" . $row['imie'] . " " . $row['nazwisko'] . "</li>";
          }
      } else {
          echo "<li>Brak zawodników dla podanej pozycji.</li>";
      }
    }
      
      mysqli_close($conn);
      ?>
        </ul>
    </div>
    <div id="prawy">
        <img src="dane/zad1.png" alt="piłkarz">
        <p>Autor: 000000000000</p>
    </div>
</body>
</html>