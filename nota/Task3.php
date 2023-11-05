<?php
/**
 * Class TableCreator
 *
 * This class creates a table "Test" and provides methods to interact with it.
 */
final class TableCreator {
    private $conn; // Database connection

    /**
     * TableCreator constructor.
     *
     * Constructor for TableCreator. It establishes a database connection and
     * executes the create and fill methods.
     *
     * @param string $servername Database server name
     * @param string $username Database username
     * @param string $password Database password
     * @param string $database Database name
     */
    public function __construct($servername, $username, $password, $database) {
        // Establish a database connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Execute create and fill methods
        $this->create();
        $this->fill();
    }

    /**
     * Creates the table "Test" with specified fields.
     *
     * @access private
     */
    private function create() {
        $sql = "CREATE TABLE Test (
            id INT AUTO_INCREMENT PRIMARY KEY,
            script_name VARCHAR(25),
            start_time DATETIME,
            end_time DATETIME,
            result ENUM('normal', 'illegal', 'failed', 'success')
        )";
        $this->conn->query($sql);
    }

    /**
     * Fills the "Test" table with random data.
     *
     * @access private
     */
    private function fill() {
        $scriptNames = ['ScriptA', 'ScriptB', 'ScriptC'];
        $results = ['normal', 'illegal', 'failed', 'success'];

        for ($i = 0; $i < 10; $i++) {
            $scriptName = $scriptNames[array_rand($scriptNames)];
            $startTime = date('Y-m-d H:i:s', mt_rand(1635788400, 1667324400));
            $endTime = date('Y-m-d H:i:s', strtotime($startTime) + rand(3600, 21600));
            $result = $results[array_rand($results)];

            $sql = "INSERT INTO Test (script_name, start_time, end_time, result)
                    VALUES ('$scriptName', '$startTime', '$endTime', '$result')";
            $this->conn->query($sql);
        }
    }

    /**
     * Selects data from the "Test" table based on the criterion: result is either 'normal' or 'success'.
     *
     * @return array Associative array of selected rows
     */
    public function get() {
        $sql = "SELECT * FROM Test WHERE result IN ('normal', 'success')";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Destructor for TableCreator
     */
    public function __destruct() {
        // Close the database connection
        $this->conn->close();
    }
}

// Usage Example:
$servername = "localhost";
$username = "root";
$password = "";
$database = "nota";

$tableCreator = new TableCreator($servername, $username, $password, $database);
$selectedData = $tableCreator->get();

print_r($selectedData);
?>
