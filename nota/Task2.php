<?php
include('simplehtmldom_1_9_1\simple_html_dom.php');

// URL of the website
$url = 'https://www.wikipedia.org/';

// Get the HTML content of the page
$html = file_get_contents($url);

$data = []; // Initialize an empty array

if ($html !== false) {
    // Create a DOM object
    $dom = new simple_html_dom();
    $dom->load($html);

    // Find all elements with class "other-project"
    $projects = $dom->find('.other-project');

    foreach ($projects as $project) {
        $link = $project->find('.other-project-link', 0)->href;
        $title = $project->find('.other-project-title', 0)->plaintext;
        $tagline = $project->find('.other-project-tagline', 0)->plaintext;

        // Add values to the $data array
        $data[] = [
            'link' => $link,
            'title' => $title,
            'tagline' => $tagline
        ];
    }

    // Clean up memory
    $dom->clear();
    unset($dom);
}
// Now $data contains an array of extracted values
// You can insert them into the database or perform any other operation as needed

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nota";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// print_R($data);die;
$values = [];

foreach ($data as $row) {
    $title = mysqli_real_escape_string($conn, $row['title']);
    $url = mysqli_real_escape_string($conn, $row['link']);
    $abstract = mysqli_real_escape_string($conn, $row['tagline']);
    $date = date('Y-m-d H:i:s');

    $values[] = "('$title', '$url', '$abstract', '$date')";
}

if (!empty($values)) {
    $sql = "INSERT INTO wiki_sections (title, url, abstract, date_created) VALUES " . implode(", ", $values);

    if ($conn->query($sql) === TRUE) {
        echo "Records inserted successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();

// Table schema
// CREATE TABLE wiki_sections (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     date_created DATETIME,
//     title VARCHAR(230),
//     url VARCHAR(240) UNIQUE,
//     picture VARCHAR(240) UNIQUE,
//     abstract VARCHAR(256) UNIQUE,
//     INDEX (url(100)),
//     INDEX (picture(100)),
//     INDEX (abstract(100))
// );
