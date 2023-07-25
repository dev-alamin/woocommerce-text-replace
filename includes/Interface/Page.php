<?php
namespace ADS\WTC\Interface;

interface Page{
    public function fire_hook() : void;
    public function submit_form() : void;
}