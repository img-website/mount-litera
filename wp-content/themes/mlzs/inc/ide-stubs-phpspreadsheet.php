<?php
/**
 * IDE stubs for PhpOffice\PhpSpreadsheet.
 * Not loaded at runtime – Cursor/Intelephense parses this file to resolve "undefined type" warnings.
 * Actual Excel import uses class_exists() before loading; CSV works without this library.
 */

namespace PhpOffice\PhpSpreadsheet {

    class IOFactory {
        /** @return Spreadsheet */
        public static function load($filename, $readerType = null, $readDataOnly = false) {}
    }

    class Spreadsheet {
        /** @return Worksheet */
        public function getActiveSheet() {}
    }

    class Worksheet {
        /** @return array */
        public function toArray($nullValue = null, $calculateFormulas = true, $formatData = true, $returnCellRef = false) {}
    }
}
