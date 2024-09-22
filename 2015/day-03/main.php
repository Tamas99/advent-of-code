<?php

function read_input(string $file_path)
{
    /**
     * Read a file from the given path.
     *
     * @param string $file_path The path to the file.
     * @return string The contents of the file.
     */
    return file_get_contents($file_path);
}

function traverse_houses(string $file_content): array
{
    /**
     * Count the number of houses where at least one present is present.
     *
     * @param string $file_content The contents of the file.
     * @return array The 2D houses array with the positions Santa and Robo traversed by.
     */
    $house_coordinates = array_fill(0, 2 * strlen($file_content), array_fill(0, 2 * strlen($file_content), 0));
    $row = strlen($file_content);
    $col = strlen($file_content);
    $house_coordinates[$row][$col] += 1;
    $direction_instructions_index = 0;
    while ($direction_instructions_index < strlen($file_content)) {
        switch ($file_content[$direction_instructions_index]) {
            case '^':
                $house_coordinates[--$row][$col] += 1;
                break;
            case '>':
                $house_coordinates[$row][++$col] += 1;
                break;
            case 'v':
                $house_coordinates[++$row][$col] += 1;
                break;
            case '<':
                $house_coordinates[$row][--$col] += 1;
                break;
            default:
                break;
        }
        $direction_instructions_index++;
    }
    return $house_coordinates;
}

function count_houses_with_present(array $house_coordinates) {
    $total = 0;
    for ($row = 0; $row < count($house_coordinates); $row++) {
        for ($col = 0; $col < count($house_coordinates[$row]); $col++) {
            if ($house_coordinates[$row][$col] > 0) {
                $total++;
            }
        }
    }
    return $total;
}

function main()
{
    $file_content = read_input(__DIR__ . '/input.txt');
    $house_coordinates = traverse_houses($file_content);
    $nr_of_houses = count_houses_with_present($house_coordinates);
    echo 'Number of houses with presents: ' . $nr_of_houses . PHP_EOL;
};

main();
