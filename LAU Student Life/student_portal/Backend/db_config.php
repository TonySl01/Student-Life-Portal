<?php


try {
    // Establish a database connection using PDO
    $pdo = new PDO('mysql:host=localhost; dbname=student_portal', 'root', '');

    // Create a new Table object using the PDO instance
    $table = new Table($pdo);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
class Table {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findSql($sql, $params = array()) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($table, $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }

      public function insert($tableName,array $data): bool {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
    
        $statement = $this->pdo->prepare("INSERT INTO $tableName ($columns) VALUES ($values)");
    
        return $statement->execute(array_values($data));
      }

      public function checkMeetingConflict($advisorId, $meetingTime) {
  
        $sql = "SELECT COUNT(*) FROM meeting 
                WHERE advisor_ID = :advisorId 
                AND (
                    date BETWEEN DATE_SUB(:meetingTime, INTERVAL 30 MINUTE) AND DATE_ADD(:meetingTime, INTERVAL 30 MINUTE)
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['advisorId' => $advisorId, 'meetingTime' => $meetingTime]);
        return $stmt->fetchColumn() > 0;
    }
    public function CheckRoomConflict($roomId, $meetingTime) {
  
        $sql = "SELECT COUNT(*) FROM study_room_reservation 
                WHERE room_ID = :roomId 
                AND (
                    date BETWEEN DATE_SUB(:meetingTime, INTERVAL 60 MINUTE) AND DATE_ADD(:meetingTime, INTERVAL 60 MINUTE)
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['roomId' => $roomId, 'meetingTime' => $meetingTime]);
        return $stmt->fetchColumn() > 0;
    }
}


?>