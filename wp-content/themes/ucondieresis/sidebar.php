<?php
/**
 * Sidebar template
 */
?>
<aside class="sidebar">
    <?php
    if (is_active_sidebar('primary-sidebar')) {
        dynamic_sidebar('primary-sidebar');
    }
    ?>
</aside>
