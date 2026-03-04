<?php
/**
 * Footer template
 */
?>
    <footer class="site-footer">
        <div class="footer-content">
            <nav class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'fallback_cb' => 'wp_page_menu',
                    'container_class' => 'footer-menu'
                ));
                ?>
            </nav>
            <div class="footer-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <!-- Floating WhatsApp Button -->
    <?php get_template_part('template-parts/global/floating-whatsapp'); ?>
    
    <?php wp_footer(); ?>
</body>
</html>
