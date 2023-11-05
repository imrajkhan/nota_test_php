<?php
/**
 * Script to find and display files in /datafiles folder with specific criteria.
 *
 * This script finds files in the /datafiles folder with names consisting of numbers and letters
 * of the Latin alphabet, having the .ixt extension, and displays their names ordered by name.
 *
 * @author Imraj Khan
 */

// Define the directory path
$directory = './datafiles';

// Define the file pattern using a regular expression
$pattern = '/^[a-zA-Z0-9]+\.ixt$/';

// Initialize an array to store matching file names
$matchingFiles = [];

// Open the directory
if ($handle = opendir($directory)) {
    // Read files from the directory
    while (false !== ($entry = readdir($handle))) {
        // Check if the entry is a file and matches the pattern
        if (is_file("$directory/$entry") && preg_match($pattern, $entry)) {
            $matchingFiles[] = $entry;
        }
    }

    // Close the directory handle
    closedir($handle);
}

// Sort the matching files array
sort($matchingFiles);

// Display the matching file names
foreach ($matchingFiles as $file) {
    echo $file . "\n";
}
