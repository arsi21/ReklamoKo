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

        (SELECT COUNT(id) count
        FROM solved_complaint)
        AS solved,
    
        (SELECT COUNT(id)
        FROM transferred_complaint)
        AS transferred');

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getComplaintCountsPerMonth($year) {
        $stmt = $this->connect()->prepare('SELECT 
        MONTH(pending_date) MONTH, 
        COUNT(complaint_id) COUNT
        FROM pending_complaint
        WHERE YEAR(pending_date) = ? 
        AND status = "approved"
        GROUP BY MONTH(pending_date)');

        if(!$stmt->execute(array($year))){
            $stmt = null;
            header("location: ../dashboard.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getResidentAccountCounts() {
        $stmt = $this->connect()->query('SELECT 
        (SELECT COUNT(id)
        FROM user
        WHERE access_type = "resident")
        AS with_account,
    
        (SELECT 
        COUNT(id) - 
            (SELECT COUNT(id)
            FROM user
            WHERE access_type = "resident")
            count
        FROM resident)
        AS without_account');

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }


    public function getResidentsWithMostNumberOfComplaint() {
        $stmt = $this->connect()->query('SELECT 
        CONCAT(r.first_name, " ", r.last_name) AS resident,
        r.id AS resident_id,
        COUNT(r.id) AS complaint_count
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        LEFT JOIN comment cm
        ON cm.complaint_id = c.id 
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE pc.is_archive != 1
        GROUP BY cct.complainant_id
        ORDER BY complaint_count DESC
        LIMIT 10');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function getMostComplainedAboutResidents() {
        $stmt = $this->connect()->query('SELECT 
        CONCAT(r.first_name, " ", r.last_name) AS resident,
        r.id AS resident_id,
        COUNT(r.id) AS complaint_count
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        LEFT JOIN comment cm
        ON cm.complaint_id = c.id 
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainee cc
        ON cc.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cc.complainee_id
        WHERE pc.is_archive != 1
        GROUP BY cc.complainee_id
        ORDER BY complaint_count DESC
        LIMIT 10');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function getComplaintTypesWithMostNumberOfComplaint() {
        $stmt = $this->connect()->query('SELECT ct.type,
        ct.id,
        COUNT(ct.id) AS type_count
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        WHERE pc.is_archive != 1
        GROUP BY c.complaint_type_id
        ORDER BY type_count DESC
        LIMIT 10');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


}