<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Walletstore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/product.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/single-product.css">
    <script src="https://kit.fontawesome.com/33677d11cf.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Mthic</title>
    <?php wp_head(); ?>
</head>

<body id="lethi-wallet" class="body" <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="header-background">
        <div id="search-modal" class="searchModal">ABC ABC ACB ACBACB ABCABC
            <form action="search"></form>
            <div id="btn-cs" href=""><i class="fas fa-times"></i></div>
        </div>
        <div class="header">
            <?php 
			$logo = get_theme_mod('custom_logo');
			$logo_link = wp_get_attachment_image_src($logo, 'full');
		?>
            <div class="header__toggle">
                <div class="header__toggle-berger">
                    <div class="header__toggle-line1"></div>
                    <div class="header__toggle-line2"></div>
                    <div class="header__toggle-line3"></div>
                </div>
                <div class="header__toggle-search btn-search">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="header__logo">
                <a class="header__logo-brand" href="#">Navbar</a>
                <img class="header__logo-img" src="<?php echo $logo_link[0] ?>" alt="">
            </div>
            <div class="header__nav">
                <ul class="header__nav-list">
                    <li class="header__nav-item">
                        <a class="header__nav-link " aria-current="page" href="#">Ví</a>
                    </li>
                    <li class="header__nav-item">
                        <a class="header__nav-link" href="#">Ba lô</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="" class="header__nav-link ">Túi</a>
                    </li>
                </ul>
            </div>
            <div class="header__user">
                <div class="header__user-search btn-search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="header__user-user">
                    <i class="fas fa-user"></i>
                </div>
                <div class="header__user-cart">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div id="header-overlay" class="header__overlay"></div>
    </header>