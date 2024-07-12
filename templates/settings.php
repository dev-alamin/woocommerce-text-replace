 <div class="wrap">
        <!-- Tab header  -->
   <?php include WTC_PLUGIN_PATH . 'templates/tabs/tab-header.php'; ?>
    <div class="tab-content">
        <!-- General Settings Tab -->
    <?php include WTC_PLUGIN_PATH . 'templates/tabs/general.php'; ?>
        <!-- Product Page Settings Tab -->
        <?php include WTC_PLUGIN_PATH . 'templates/tabs/product.php'; ?>
        <!-- Archive/Shop Page Settings Tab -->
        <?php include WTC_PLUGIN_PATH . 'templates/tabs/archieve.php'; ?>
        <!-- Cart Page Settings Tab -->
        <?php include WTC_PLUGIN_PATH . 'templates/tabs/cart.php'; ?>
        <!-- Checkout Page Settings Tab -->
        <?php include WTC_PLUGIN_PATH . 'templates/tabs/checkout.php'; ?>
        <!-- Thank You Page Settings Tab -->
        <?php include WTC_PLUGIN_PATH . 'templates/tabs/thank-you.php'; ?>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Switch tabs on click
    $('.nav-tab').on('click', function(e) {
        e.preventDefault();
        $('.nav-tab').removeClass('nav-tab-active text-light bg-primary bg-gradient');
        $(this).addClass('nav-tab-active text-light bg-primary bg-gradient');
        $('.tab-pane').removeClass('show active');
        $($(this).attr('href')).addClass('show active');
    });
});
</script>