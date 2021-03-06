<?php
/*
Template Name: Blank
*/

if ( ! apply_filters( 'dt_blank_access', false ) ){
    echo 'Access to this page not permitted';
    exit;
}
?>
<!doctype html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">

    <!-- Force IE to use the latest rendering engine available -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">
    <!-- If Site Icon isn't set in customizer -->
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <meta name="apple-mobile-web-app-title" content="Disciple.Tools">
        <meta name="application-name" content="Disciple.Tools">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/favicon-16x16.png">
        <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/site.webmanifest">
        <link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/safari-pinned-tab.svg" color="#3f729b">
        <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#3f729b">
        <meta name="msapplication-TileImage" content="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="<?php echo esc_url( get_template_directory_uri() ); ?>/dt-assets/favicons/browserconfig.xml">
        <meta name="theme-color" content="#3f729b">
    <?php } ?>

    <title><?php do_action( 'dt_blank_title' ) ?></title>

    <?php do_action( 'dt_blank_head' ) ?>

</head>
<body>
    <!-- Page Body -->
    <?php do_action( 'dt_blank_body' ); ?>

    <!-- Page Footer-->
    <?php do_action( 'dt_blank_footer' ) ?>

</body>
</html>
