<?php
include_once __DIR__ . '/../../../backend/admin/setting/config.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0">
            <i class="fas fa-cogs me-2 text-info"></i>System Configuration
        </h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="system_name" class="form-label">System Name:</label>
                <input type="text" id="system_name" name="system_name" class="form-control" value="<?php echo htmlspecialchars($current_name); ?>" required>
            </div>

            <div class="mb-3">
                <label for="system_font" class="form-label">System Font:</label>
                <select id="system_font" name="system_font" class="form-select">
                    <?php
                        $fonts = [
                            // Sans-Serif
                            'Roboto', 'Open Sans', 'Lato', 'Montserrat', 'Poppins', 'Nunito', 'Raleway', 
                            'Source Sans Pro', 'Ubuntu', 'Inter', 'Work Sans', 'Fira Sans', 'Rubik', 
                            'Karla', 'PT Sans', 'Exo 2', 'Quicksand', 'Dosis', 'Comfortaa', 'Bebas Neue',
                            'Anton', 'Oswald', 'Barlow', 'Cabin', 'Hind', 'Asap', 'Muli', 'Heebo',
                            'Kanit', 'Prompt', 'Sarabun', 'Teko', 'Titillium Web', 'Yantramanav',
                            
                            // Serif
                            'Merriweather', 'Playfair Display', 'Lora', 'Arimo', 'Vollkorn', 'Bitter',
                            'Crimson Text', 'PT Serif', 'Domine', 'EB Garamond', 'Cormorant Garamond',
                            'Zilla Slab', 'Noticia Text', 'Cardo', 'Gentium Book Basic', 'Spectral',
                            'Tinos', 'Alegreya', 'Neuton', 'Libre Baskerville', 'Source Serif Pro',
                            
                            // Display
                            'Lobster', 'Pacifico', 'Abril Fatface', 'Alfa Slab One', 'Bangers', 
                            'Fredoka One', 'Righteous', 'Patua One', 'Passion One', 'Ultra',
                            'Changa One', 'Graduate', 'Russo One', 'Staatliches', 'Unica One',

                            // Handwriting
                            'Caveat', 'Dancing Script', 'Shadows Into Light', 'Indie Flower', 'Amatic SC',
                            'Patrick Hand', 'Permanent Marker', 'Gochi Hand', 'Kalam', 'Architects Daughter',
                            'Sacramento', 'Satisfy', 'Courgette', 'Great Vibes', 'Kaushan Script',

                            // Monospace
                            'Roboto Mono', 'Source Code Pro', 'Inconsolata', 'Fira Mono', 'Space Mono',
                            'Cutive Mono', 'Anonymous Pro', 'Share Tech Mono', 'Ubuntu Mono', 'VT323'
                        ];
                        
                        // Sort fonts alphabetically for easier selection
                        sort($fonts);

                        foreach ($fonts as $font) {
                            $selected = ($current_font == $font) ? 'selected' : '';
                            echo "<option value='{$font}' {$selected} style='font-family:{$font}, sans-serif;'>{$font}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="primary_color" class="form-label">System Primary Color:</label>
                <input type="color" id="primary_color" name="primary_color" class="form-control form-control-color" value="<?php echo htmlspecialchars($current_color); ?>" title="Choose your color">
            </div>

            <div class="mb-3">
                <label for="sidebar_color" class="form-label">Sidebar Background Color:</label>
                <input type="color" id="sidebar_color" name="sidebar_color" class="form-control form-control-color" value="<?php echo htmlspecialchars($current_sidebar_color); ?>" title="Choose your color">
            </div>

            <div class="mb-3">
                <label for="navbar_color" class="form-label">Top Navbar Background Color:</label>
                <input type="color" id="navbar_color" name="navbar_color" class="form-control form-control-color" value="<?php echo htmlspecialchars($current_navbar_color); ?>" title="Choose your color">
            </div>

            <div class="mb-3">
                <label for="system_logo" class="form-label">System Logo:</label>
                <input type="file" id="system_logo" name="system_logo" class="form-control">
                <?php if ($current_logo): ?>
                    <div class="mt-3">
                        <p>Current Logo:</p>
                        <img src="<?php echo $base_url; ?>public/<?php echo htmlspecialchars($current_logo); ?>" alt="Current Logo" style="max-width: 200px; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>