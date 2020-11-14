#!/usr/bin/php

<?php
    /** 
     * A script to generate a directory and a file based on the input
     * Example, if the 1st argument is `/home/test/whatever` and if `/home/test` doesn't exist
     * it will create the directory along with the `whatever` file. 
     */

    if (count($argv) !== 2) {
        echo "The 1st argument has to exist.";
    }

    $path = $argv[1];

    if (is_dir($path) || is_file($path)) {
        echo "'$path' already exists!";
        exit(0);
    }

    $path_parts = explode(DIRECTORY_SEPARATOR, $path);

    $preceding_dir_path = implode(
        DIRECTORY_SEPARATOR,
        array_slice(
            $path_parts,
            0,
            count($path_parts) - 1
        )
    );

    if (!is_dir($preceding_dir_path)) {
        mkdir($preceding_dir_path, 0777 /* Mode */, true /* Is recursive */);
    }

    touch($path);

    exit(0);