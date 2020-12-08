<div class="wrap">
    <h1>AlleyCat</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php 
            settings_fields('alleycat_options_group');
            do_settings_sections( 'alleycat_plugin' );
            submit_button();
        ?>
    </form>
</div>