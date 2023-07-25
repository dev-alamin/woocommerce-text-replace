<?php
// Helper function to sanitize and set default values if empty
function wtc_sanitize_and_set_default($value) {
    return isset($value) ? sanitize_text_field($value) : '';
}