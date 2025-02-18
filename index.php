<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Хамидуллин Михаил Константинович – 231-361 – Лабораторная работа 9, Вариант 2</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <h1>Хамидуллин Михаил Константинович – 231-361 – Лабораторная работа 9, Вариант 2</h1>
  </header>

  <?php
  $layoutType = isset($_GET['layout']) ? $_GET['layout'] : 'A'; 
  ?>

  <aside class="sidebar">
    <h2>Выберите тип верстки:</h2>
    <select id="layoutType" onchange="changeLayout()">
      <option value="A" <?php echo ($layoutType === 'A') ? 'selected' : ''; ?>>Тип верстки A</option>
      <option value="B" <?php echo ($layoutType === 'B') ? 'selected' : ''; ?>>Тип верстки B</option>
      <option value="C" <?php echo ($layoutType === 'C') ? 'selected' : ''; ?>>Тип верстки C</option>
      <option value="D" <?php echo ($layoutType === 'D') ? 'selected' : ''; ?>>Тип верстки D</option>
      <option value="E" <?php echo ($layoutType === 'E') ? 'selected' : ''; ?>>Тип верстки E</option>
    </select>
  </aside>

  <main>
    <?php
    $x = -10;
    $encounting = 20;
    $step = 2;
    $min_threshold = -1000;
    $max_threshold = 1000;

    $outputLines = [];
    $numericResults = [];
    $results = [];

    for ($i = 0; $i < $encounting; $i++, $x += $step) {
      if ($x <= 10) {
        if ($x == 0) {
          $f = "Значение не определено";
        } else {
          $f = (10 + $x) / $x;
          $f = round($f, 3);
        }
      } elseif ($x < 20) {
        $f = ($x / 7) * ($x - 2);
        $f = round($f, 3);
      } else {
        $f = ($x * 8) + 2;
        $f = round($f, 3);
      }

      $results[] = ['x' => $x, 'f' => $f];

      if (is_numeric($f)) {
        if ($f >= $max_threshold || $f < $min_threshold) {
          break;
        }
        $numericResults[] = $f;
      }

      $outputLines[] = "f({$x}) = {$f}";
    }

    switch ($layoutType) {
      case 'A':
        echo implode('<br>', $outputLines);
        break;
      case 'B':
        echo "<ul>";
        foreach ($outputLines as $line) {
          echo "<li>{$line}</li>";
        }
        echo "</ul>";
        break;
      case 'C':
        echo "<ol>";
        foreach ($outputLines as $line) {
          echo "<li>{$line}</li>";
        }
        echo "</ol>";
        break;
      case 'D':
        echo '<table>';
        echo '<tr><th>#</th><th>x</th><th>f(x)</th></tr>';
        $lineNumber = 1;
        foreach ($results as $pair) {
          echo "<tr><td>{$lineNumber}</td><td>{$pair['x']}</td><td>{$pair['f']}</td></tr>";
          $lineNumber++;
        }
        echo '</table>';
        break;
      case 'E':
        foreach ($outputLines as $line) {
          echo "<div class='block-item'>{$line}</div>";
        }
        break;
      default:
        echo implode('<br>', $outputLines);
    }

    if (!empty($numericResults)) {
      $sum = array_sum($numericResults);
      $min = min($numericResults);
      $max = max($numericResults);
      $avg = round($sum / count($numericResults), 3);
      echo "<hr>";
      echo "<p><strong>Статистика по вычисленным значениям функции:</strong></p>";
      echo "<p>Сумма: {$sum}</p>";
      echo "<p>Минимальное значение: {$min}</p>";
      echo "<p>Максимальное значение: {$max}</p>";
      echo "<p>Среднее арифметическое: {$avg}</p>";
    } else {
      echo "<p>Нет числовых значений для вычисления статистики.</p>";
    }
    ?>
  </main>

  <footer>
    <p>Тип верстки: <?php echo htmlspecialchars($layoutType); ?></p>
  </footer>

  <script>
    function changeLayout() {
      var layoutType = document.getElementById('layoutType').value;
      window.location.href = '?layout=' + layoutType;
    }
  </script>
</body>

</html>