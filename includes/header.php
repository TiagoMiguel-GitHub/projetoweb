<?php
if (!isset($pageTitle)) $pageTitle = 'Planaluga';
if (!isset($extra_css)) $extra_css = [];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="Autor" content="Tiago Miguel/Francisco Coimbra">
    <meta name="Descrição" content="Empresa/Aluguer/Andaimes">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/icon.ico">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <?php foreach ($extra_css as $css): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $css; ?>">
    <?php endforeach; ?>
</head>
<body<?php if (!empty($bodyClass)) echo ' class="'.htmlspecialchars($bodyClass).'"'; ?>>

<header>
    <div class="logo-wrapper">
        <a href="index.php">
            <img class="logo" src="./img/logo.png" class="img-fluid" width="450">
        </a>
    </div>

    <div class="menu-wrapper">
        <input type="checkbox" id="hamburger" class="hamburger">
        <label for="hamburger" class="hamburger">
            <i></i>
        </label>

        <section class="drawer-list">
            <ul>
                <li><a href="index.php">Planaluga</a></li>
                <li><a href="servicos.php">Serviços</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="pedidoorcamento.php">Pedido de Orçamento</a></li>
            </ul>
        </section>
    </div>
</header>
