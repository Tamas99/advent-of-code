<?php

function read_input(string $file_path): string | false
{
    /**
     * Read a file from the given path.
     *
     * @param string $file_path The path to the file.
     * @return string The contents of the file.
     */
    return file_get_contents($file_path);
}

function isSantasTurn(int $direction_instructions_index): bool
{
    return $direction_instructions_index % 2 == 0;
}

function traverse_houses_with_robo(string $file_content): array
{
    /**
     * Count the number of houses where at least one present is present.
     *
     * @param string $file_content The contents of the file.
     * @return array The array with the positions of both trasses.
     */
    $house_coordinates = array_fill(0, 2 * strlen($file_content), array_fill(0, 2 * strlen($file_content), 0));
    $house_coordinates_robo = array_fill(0, 2 * strlen($file_content), array_fill(0, 2 * strlen($file_content), 0));
    $row = strlen($file_content);
    $col = strlen($file_content);
    $row_robo = strlen($file_content);
    $col_robo = strlen($file_content);
    $house_coordinates[$row][$col] += 1;
    $direction_instructions_index = 0;
    while ($direction_instructions_index < strlen($file_content)) {
        switch ($file_content[$direction_instructions_index]) {
            case '^':
                isSantasTurn($direction_instructions_index) ? $house_coordinates[--$row][$col] += 1 : $house_coordinates_robo[--$row_robo][$col_robo] += 1;
                break;
            case '>':
                isSantasTurn($direction_instructions_index) ? $house_coordinates[$row][++$col] += 1 : $house_coordinates_robo[$row_robo][++$col_robo] += 1;
                break;
            case 'v':
                isSantasTurn($direction_instructions_index) ? $house_coordinates[++$row][$col] += 1 : $house_coordinates_robo[++$row_robo][$col_robo] += 1;
                break;
            case '<':
                isSantasTurn($direction_instructions_index) ? $house_coordinates[$row][--$col] += 1 : $house_coordinates_robo[$row_robo][--$col_robo] += 1;
                break;
            default:
                break;
        }
        $direction_instructions_index++;
    }
    return [ 'santa' => $house_coordinates, 'robo' => $house_coordinates_robo];
}

function count_houses_with_present(array $house_coordinates): int
{
    $total = 0;
    for ($row = 0; $row < count($house_coordinates['santa']); $row++) {
        for ($col = 0; $col < count($house_coordinates['santa'][$row]); $col++) {
            if ($house_coordinates['santa'][$row][$col] > 0 || $house_coordinates['robo'][$row][$col] > 0) {
                $total++;
            }
        }
    }
    return $total;
}

function main()
{
    $file_content = read_input(__DIR__ . '/input.txt');
    $coordinates = traverse_houses_with_robo($file_content);
    $nr_of_houses = count_houses_with_present($coordinates);
    echo 'Number of houses with presents (Robo-Santa): ' . $nr_of_houses . PHP_EOL;
};

main();
