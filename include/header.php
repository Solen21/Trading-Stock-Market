<?php
// Set a default page title if one isn't provided
$page_title = isset($page_title) ? htmlspecialchars($page_title) : 'Welcome';
$system_name = isset($system_name) ? htmlspecialchars($system_name) : 'Product Management System';
$system_icon = isset($system_icon) ? $system_icon : 'fas fa-igloo';
$system_logo = isset($system_logo) ? $system_logo : '';
$primary_color = isset($primary_color) ? htmlspecialchars($primary_color) : '#007bff';
$sidebar_color = isset($sidebar_color) ? htmlspecialchars($sidebar_color) : '#343a40';
$navbar_color = isset($navbar_color) ? htmlspecialchars($navbar_color) : '#f8f9fa'; 
$system_font = isset($system_font) ? htmlspecialchars($system_font) : 'Poppins';
$favicon = !empty($system_logo) ? '../../public/' . htmlspecialchars($system_logo) : '';
?>
<?php
$base_path = '/project/abiel/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>
        // Apply dark mode immediately to prevent flash
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
    <style>
        :root {
            --primary-color: <?php echo $primary_color; ?>;
            --sidebar-color: <?php echo $sidebar_color; ?>;
            --navbar-color: <?php echo $navbar_color; ?>;
            --system-font: '<?php echo $system_font; ?>', sans-serif;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title . ' | ' . $system_name; ?></title>
    <?php if ($favicon): ?>
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>public/<?php echo htmlspecialchars($system_logo); ?>">
    <?php endif; ?>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
        // Generate the Google Fonts URL from the same list
        $fonts = ['Roboto', 'Open Sans', 'Lato', 'Montserrat', 'Poppins', 'Nunito', 'Merriweather', 'Playfair Display', 'Oswald', 'Raleway', 'Source Sans Pro', 'Ubuntu', 'Inter', 'Work Sans', 'Fira Sans', 'Rubik', 'Karla', 'Lora', 'Arimo', 'PT Sans', 'Exo 2', 'Quicksand', 'Josefin Sans', 'Dosis', 'Comfortaa', 'Pacifico', 'Lobster', 'Caveat', 'Dancing Script', 'Shadows Into Light', 'Indie Flower', 'Amatic SC', 'Bebas Neue', 'Anton', 'Abril Fatface', 'Cormorant Garamond', 'Vollkorn', 'Bitter', 'Crimson Text', 'PT Serif', 'Domine', 'EB Garamond', 'Zilla Slab', 'Noticia Text', 'Cardo', 'Gentium Book Basic', 'Spectral', 'Tinos', 'Alegreya', 'Neuton', 'Libre Baskerville', 'Source Serif Pro', 'Barlow', 'Cabin', 'Hind', 'Asap', 'Muli', 'Heebo', 'Kanit', 'Prompt', 'Sarabun', 'Teko', 'Titillium Web', 'Yantramanav', 'Alfa Slab One', 'Bangers', 'Fredoka One', 'Righteous', 'Patua One', 'Passion One', 'Ultra', 'Changa One', 'Graduate', 'Russo One', 'Staatliches', 'Unica One', 'Patrick Hand', 'Permanent Marker', 'Gochi Hand', 'Kalam', 'Architects Daughter', 'Sacramento', 'Satisfy', 'Courgette', 'Great Vibes', 'Kaushan Script', 'Roboto Mono', 'Source Code Pro', 'Inconsolata', 'Fira Mono', 'Space Mono', 'Cutive Mono', 'Anonymous Pro', 'Share Tech Mono', 'Ubuntu Mono', 'VT323'];
        $font_url_param = implode('&family=', array_map('urlencode', $fonts));
    ?>
    <link href="https://fonts.googleapis.com/css2?family=<?php echo $font_url_param; ?>&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/admin_style.css"> <!-- Your custom styles should come last -->
</head>
<body>
    <?php 
    if (isset($_SESSION['user_id'])) { // Only show sidebar and top nav if user is logged in
        include_once __DIR__ . '/nav.php';
    }
    ?>