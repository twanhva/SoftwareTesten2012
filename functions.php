<?php
function get_files_in_dir($dir) {
    $filenames = array();
    if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if(!in_array($entry, array('.', '..')) && stripos($entry,'opdracht') !== false) {
                //$stpos = (($stpos = strpos($entry, '_')) === false ? 0 : $stpos + 1);
                //$filenames[] = substr($entry, $stpos, strpos($entry, '.') - $stpos);
                $filenames[] = substr($entry, 0, strpos($entry, '.'));
            }
        }
        closedir($handle);
    }
    sort($filenames);
    return $filenames;
}

function get_include_contents($file) {
    if (!is_file($file) || !file_exists($file) || !is_readable($file)) return false;
    ob_start();
    include($file);
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
?>
