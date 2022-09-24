<?php 

class Dashboard extends Dbh {

    //get

    public function getComplaintCountsPerStatus() {
        $stmt = $this->connect()->query('SELECT 
        (SELECT COUNT(id)
        FROM pending_complaint
        WHERE status != "approved")
        AS pending,

        (SELECT COUNT(id)
        FROM ongoing_complaint
        WHERE complaint_id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND complaint_id
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint))
        AS ongoing,
    
        (SELECT COUNT(id)
        FROM transferred_complaint)
        AS transferred,
    
        (SELECT COUNT(id) count
        FROM solved_complaint)
        AS solved');

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getComplaintCountsPerMonth() {
        $stmt = $this->connect()->query('SELECT 
        MONTH(pending_date) MONTH, 
        COUNT(complaint_id) COUNT
        FROM pending_complaint
        WHERE YEAR(pending_date) = "2022" 
        AND status = "approved"
        GROUP BY MONTH(pending_date)');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getResidentAccountCounts() {
        $stmt = $this->connect()->query('SELECT 
        (SELECT COUNT(resident_id)
        FROM application
        WHERE status = "approved")
        AS with_account,
    
        (SELECT 
        COUNT(id) - 
            (SELECT COUNT(resident_id)
            FROM application
            WHERE status = "approved")
            count
        FROM resident)
        AS without_account');

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}