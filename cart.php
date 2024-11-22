<?php
  // Inicio de la sesión
  session_start();

  // Variables que modifican el idioma a partir del valor de la Cookie 'language'
  if ($_COOKIE['language'] === 'spanish') {
    $_SESSION['btn'] = 'AÑADIR AL CARRITO';
    $_SESSION['titleLanguage'] = 'Idioma';
    $_SESSION['titleTheme'] = 'Tema';
    $_SESSION['titleCart'] = 'Carrito';
    $_SESSION['titleDelete'] = 'Eliminar';
    $_SESSION['titleEmpty'] = 'Carrito Vacío';
  } else {
    $_SESSION['btn'] = 'ADD TO CART';
    $_SESSION['titleLanguage'] = 'Language';
    $_SESSION['titleTheme'] = 'Theme';
    $_SESSION['titleCart'] = 'Cart';
    $_SESSION['titleDelete'] = 'Delete';
    $_SESSION['titleEmpty'] = 'Empty Cart';
  }

  // Algoritmo para eliminar el producto seleccionado a partir de su índice
  switch(true) {
    case isset($_POST['0']):
      $element = array_search('0', $_SESSION['cart']);
      array_splice($_SESSION['cart'], $element, 1);
      break;
    case isset($_POST['1']):
      $element = array_search('1', $_SESSION['cart']);
      array_splice($_SESSION['cart'], $element, 1);
      break;
    case isset($_POST['2']):
      $element = array_search('2', $_SESSION['cart']);
      array_splice($_SESSION['cart'], $element, 1);
      break;
    case isset($_POST['3']):
      $element = array_search('3', $_SESSION['cart']);
      array_splice($_SESSION['cart'], $element, 1);
      break;
    case isset($_POST['4']):
      $element = array_search('4', $_SESSION['cart']);
      array_splice($_SESSION['cart'], $element, 1);
      break;
    case isset($_POST['5']):
      $element = array_search('5', $_SESSION['cart']);
      array_splice($_SESSION['cart'], $element, 1);
      break;
  }

?>

<!-- Inicio de la estructura HTML para el carrito -->
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Enlace a los estilos de CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Enlace al JavaScript -->
  <script src="script.js" defer></script>

  <title>Guitar Lux</title>

</head>

<body class="light">

  <nav class="nav-bar">

    <a class="logo" href="index.php">
      <img src="assets/guitar.svg" alt="Logo">
    </a>

    <h3>GUITAR LUX</h3>
    
    <div>
      <!-- Formulario para cambiar el idioma -->
      <form method="POST">
        <button type="submit" class="language" id="languageBtn" title="<?php echo $_SESSION['titleLanguage']?>"></button>
      </form>
      <!-- Enlace para cambiar de tema -->
      <a class="theme" id="themeBtn" title="<?php echo $_SESSION['titleTheme']?>"></a>

      <!-- Carrito y contador de artículos -->
      <a href="cart.php" class="cart" id="cartBtn" title="<?php echo $_SESSION['titleCart']?>"></a>
      <?php 
        $count = count($_SESSION['cart']);
        echo "<span>{$count}</span>"
      ?>

    </div>

  </nav>

  <!-- Iteración para renderizar cada uno de los productos
      del carrito junto a un formulario para eliminar el producto deseado -->
  <form method="POST" class="wrapper-cart">

    <?php
      // Mensaje de 'carrito vacio' si no hay ningún producto
      if (empty($_SESSION['cart'])) {
        echo "<h3 class='empty-cart'>{$_SESSION['titleEmpty']}</h3>";
      } else {
        foreach($_SESSION['cart'] as $cart) {
          echo "
            <article class='guitar-cart'>
              <img src='assets/{$_SESSION['products']['image'][$cart]}' alt='telecaster'>
              <button type='submit' name='{$cart}' title='{$_SESSION['titleDelete']}'>
                <svg width='30px' height='30px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                  <g id='SVGRepo_iconCarrier'> 
                    <path d='M3 6.52381C3 6.12932 3.32671 5.80952 3.72973 5.80952H8.51787C8.52437 4.9683 8.61554 3.81504 9.45037 
                    3.01668C10.1074 2.38839 11.0081 2 12 2C12.9919 2 13.8926 2.38839 14.5496 3.01668C15.3844 3.81504 15.4756 4.9683 
                    15.4821 5.80952H20.2703C20.6733 5.80952 21 6.12932 21 6.52381C21 6.9183 20.6733 7.2381 20.2703 7.2381H3.72973C3.32671 
                    7.2381 3 6.9183 3 6.52381Z' fill='#000000'/>
                    <path d='M11.6066 22H12.3935C15.101 22 16.4547 22 17.3349 21.1368C18.2151 20.2736 18.3052 18.8576 18.4853 16.0257L18.7448 
                    11.9452C18.8425 10.4086 18.8913 9.64037 18.4498 9.15352C18.0082 8.66667 17.2625 8.66667 15.7712 8.66667H8.22884C6.7375 
                    8.66667 5.99183 8.66667 5.55026 9.15352C5.1087 9.64037 5.15756 10.4086 5.25528 11.9452L5.51479 16.0257C5.69489 18.8576 
                    5.78494 20.2736 6.66513 21.1368C7.54532 22 8.89906 22 11.6066 22Z' fill='#000000'/>
                  </g>
                </svg>
              </button>
              <h4>{$_SESSION['products']['name'][$cart]}</h4>
              <h3>{$_SESSION['products']['price'][$cart]}</h3>
            </article>";
        }
      }

    ?>

    <!-- Suma total del precio a pagar por los producto del carrito -->
    <div class="sum">

      <h4>Total:</h4>
      <?php 
        $sum = array();
        foreach($_SESSION['cart'] as $cart) {
          array_push($sum, $_SESSION['products']['price'][$cart]);
        }
        $total = array_sum($sum);
        echo "<h3>{$total} €</h3>";
      ?>
      
    </div>

  </form>  

</body>

</html>