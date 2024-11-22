<?php
  // Inicio de la sesión 
  session_start();

  // Bases de Datos con todos los productos que tiene la tienda
  $_SESSION['products'] = [
    'image' => [
      'gibson.png', 
      'ibanez.png', 
      'prs.png', 
      'stratocaster.png', 
      'telecaster.png', 
      'suhr.png'
    ],
    'name' => [
      'Gibson Les Paul 59 GPB Heavy Aged', 
      'Ibanez JS2GD Joe Satriani', 
      'PRS Custom 24/08 PS Tiger Eye Glow', 
      'Fender Custom 50S Strat HR MBDB SB', 
      'Fender 60 Telecaster Custom SB MBAH', 
      'Suhr Standard Reb Beach Signature'
    ],
    'price' => ['9.199 €', 
    '5.222 €', 
    '11.099 €', 
    '9.899 €', 
    '8.799 €', 
    '6.099 €'
    ]
  ];

  // Variables que modifican el idioma a partir del valor de la Cookie 'language'
  if (!isset($_COOKIE['language'])) {
    $_SESSION['btn'] = 'AÑADIR AL CARRITO';
    $_SESSION['titleLanguage'] = 'Idioma';
    $_SESSION['titleTheme'] = 'Tema';
    $_SESSION['titleCart'] = 'Carrito';
  } else {
    if ($_COOKIE['language'] === 'spanish') {
      $_SESSION['btn'] = 'AÑADIR AL CARRITO';
      $_SESSION['titleLanguage'] = 'Idioma';
      $_SESSION['titleTheme'] = 'Tema';
      $_SESSION['titleCart'] = 'Carrito';
    } else {
      $_SESSION['btn'] = 'ADD TO CART';
      $_SESSION['titleLanguage'] = 'Language';
      $_SESSION['titleTheme'] = 'Theme';
      $_SESSION['titleCart'] = 'Cart';
    }
  }  
  
  // Array de los productos que se añaden al carrito
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  // Algoritmo para guardar el índice del producto añadido
  switch(true) {
    case isset($_POST['btn-0']):
      array_push($_SESSION['cart'], '0');
      break;
    case isset($_POST['btn-1']):
      array_push($_SESSION['cart'], '1');
      break;
    case isset($_POST['btn-2']):
      array_push($_SESSION['cart'], '2');
      break;
    case isset($_POST['btn-3']):
      array_push($_SESSION['cart'], '3');
      break;
    case isset($_POST['btn-4']):
      array_push($_SESSION['cart'], '4');
      break;
    case isset($_POST['btn-5']):
      array_push($_SESSION['cart'], '5');
      break;
  }

?>

<!-- Inicio de la estructura HTML para la página principal -->
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
      junto a un formulario para añadir el producto al carrito -->
  <form method="POST" class="wrapper">

    <?php
      for ($i = 0; $i < count($_SESSION['products']['image']); $i++) {
        echo "
        <article class='guitar'>
          <img src='assets/{$_SESSION['products']['image'][$i]}' alt='guitar'>
          <h4>{$_SESSION['products']['name'][$i]}</h4>
          <h3>{$_SESSION['products']['price'][$i]}</h3>
          <input type='submit' name='btn-{$i}' value='{$_SESSION['btn']}'></input>
        </article>";
      }
    ?>
      
  </form>

</body>

</html>