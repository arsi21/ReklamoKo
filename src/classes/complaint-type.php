<?php 

class ComplaintType extends Dbh {

    public function getComplaintType() {
        $stmt = $this->connect()->query('SELECT * 
        FROM complaint_type
        ORDER BY type');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}