<?php

function read_input(String $file_path) {
    /**
     * Read a file from the given path.
     *
     * @param string $file_path The path to the file.
     * @return string The contents of the file.
     */
    return file_get_contents($file_path);
}

// Formula: 2*l*w + 2*w*h + 2*h*l
function calculate_area($length, $width, $height) {
    return (2 * $length * $width) + (2 * $width * $height) + (2 * $height * $length);
}

function calculate_smallest_side($length, $width, $height) {
    return min($length * $width, $width * $height, $height * $length);
}

function calculate_dimensions($input_path) {
    $file_content = read_input($input_path);
    $lines = explode(PHP_EOL, $file_content);
    $total_dim = 0;
    foreach ($lines as $line) {
        $dimensions = explode('x', $line);
        $total_dim += calculate_area($dimensions[0], $dimensions[1], $dimensions[2]);
        $total_dim += calculate_smallest_side($dimensions[0], $dimensions[1], $dimensions[2]);
    }
    return $total_dim;
}

// Formula: side1 + side1 + side2 + side2
function calculate_ribbon($side1, $side2) {
    return $side1 + $side1 + $side2 + $side2;
}

// Formula: l*w*h
function calculate_bow($length, $width, $height) {
    return $length * $width * $height;
}

function calculate_ribbons($input_path) {
    $file_content = read_input($input_path);
    $lines = explode(PHP_EOL, $file_content);
    $total_ribbon = 0;
    foreach ($lines as $line) {
        $dimensions = explode('x', $line);
        sort($dimensions);
        $total_ribbon += calculate_ribbon($dimensions[0], $dimensions[1]);
        $total_ribbon += calculate_bow($dimensions[0], $dimensions[1], $dimensions[2]);
    }
    return $total_ribbon;
}

function main() {
    echo 'Total surface area: ' . calculate_dimensions(__DIR__ . '/input.txt') . PHP_EOL;
    echo 'Total feet of ribbon: ' . calculate_ribbons(__DIR__ . '/input.txt') . PHP_EOL;
};

main();
