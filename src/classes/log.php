<?php 

class Log extends Dbh {


    //set
    protected function setLog($userId, $actionMade) {
        $stmt = $this->connect()->prepare('INSERT 
        INTO log 
            (user_id, action_made) 
        VALUES (?, ?)');
    
        if(!$stmt->execute(array($userId, $actionMade))){
            $stmt = null;
            header("location: ../dashboard.php?message=stmtfailed");
            exit();
        }

        $stmt = null;
    }




    //search
    public function searchLogs($search) {
        $stmt = $this->connect()->query("SELECT CONCAT(r.first_name, ' ', r.last_name) AS name,
        l.action_made,
        l.date_time
        FROM log l
        INNER JOIN application a
        ON a.user_id = l.user_id
        INNER JOIN resident r
        ON r.id = a.resident_id
        WHERE r.id
        IN (SELECT r.id
            FROM log l
            INNER JOIN application a
            ON a.user_id = l.user_id
            INNER JOIN resident r
            ON r.id = a.resident_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY l.date_time DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }





    //get

    public function getLogs() {
        $stmt = $this->connect()->query('SELECT CONCAT(r.first_name, " ", r.last_name) AS name,
        l.action_made,
        l.date_time
        FROM log l
        INNER JOIN application a
        ON a.user_id = l.user_id
        INNER JOIN resident r
        ON r.id = a.resident_id
        ORDER BY l.date_time DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

}