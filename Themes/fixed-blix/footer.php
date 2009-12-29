            <hr class="low" />

            <div id="footer">
                <div id="footer-hack"></div>

                <p>
<?php
    $locale = get_locale();
    if (!$locale || $locale == 'en_US') {
?>
                    <strong>&copy; Copyright <?php echo date('Y'), ' '; bloginfo('name'); ?>. All rights reserved.</strong><br />
<?php } ?>
                    <a href="http://lettersandscience.net/Blix/"><strong>Blix</strong></a> theme.  <?php echo sprintf(__("Powered by <a href='http://wordpress.org/' title='%s'><strong>WordPress</strong></a>"), __('Powered by WordPress, state-of-the-art semantic personal publishing platform.')); ?> <?php bloginfo('version'); ?>.  <?php wp_loginout(); ?>
                </p>

<?php do_action('wp_footer'); ?>

            </div>
        </div>
    </body>
</html>
