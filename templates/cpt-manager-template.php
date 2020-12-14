<div class="wrap">
        <h1>Custom Posts Manager</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php 
            settings_fields('alleycat_plugin_cpt_settings');
            do_settings_sections( 'alleycat_cpt' );
            submit_button();
        ?>
    </form>
</div >