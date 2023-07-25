<?php
namespace ADS\WTC\Traits;

trait Validate_Input{
    
    public function sanitize( $value ) {
        return isset( $value ) ? sanitize_text_field( $value ) : '';
    }
}