<?php
 = glob('resources/lang/en/*.php');
 = [];
foreach ( as ) {
     = basename();
     = 'resources/lang/ar/' . ;
     = include ;
     = file_exists() ? include  : [];
     = new RecursiveIteratorIterator(new RecursiveArrayIterator());
    foreach ( as  => ) {
         = [];
        for ( = 0;  <= ->getDepth(); ++) {
            [] = ->getSubIterator()->key();
        }
         = ;
         = true;
        foreach ( as ) {
            if (!is_array() || !array_key_exists(, )) {
                [][] = implode('.', );
                 = false;
                break;
            }
             = [];
        }
        if (!) {
        }
    }
}
echo json_encode(, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\n";
