<?php
/**
 * Imagick – IDE stubs only. This file is NOT loaded by WordPress.
 * Removes "undefined type" warnings in Cursor/VS Code (Intelephense) for Imagick/ImagickPixel.
 * Delete this file if you don't use the Imagick extension.
 */

class Imagick {
    public const ALPHACHANNEL_ACTIVATE = 1;

    /** @param string|array|null $files */
    public function __construct($files = null) {}
    /** @param string $format */
    public function setImageFormat($format) {}
    /** @param int $channel */
    public function setImageAlphaChannel($channel) {}
    /** @param ImagickPixel $background */
    public function setBackgroundColor($background) {}
    /** @param int $quality */
    public function setImageCompressionQuality($quality) {}
    /** @param string|null $filename */
    public function writeImage($filename = null) {}
    public function clear() {}
    public function destroy() {}
}

class ImagickPixel {
    /** @param string|null $color */
    public function __construct($color = null) {}
}
