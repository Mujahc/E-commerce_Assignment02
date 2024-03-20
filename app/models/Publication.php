<?php
namespace app\models;

use PDO;

class Publication extends \app\core\Model {
    public $publication_id; // PK
    public $profile_id;
    public $publication_title;
    public $publication_text;
    public $timestamp;
    public $publication_status; // 'public' or 'private'

    // CRUD operations

    // Create
    public function insert() {
        $SQL = 'INSERT INTO publication(profile_id, publication_title, publication_text, publication_status) VALUES (:profile_id, :publication_title, :publication_text, :publication_status)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'profile_id' => $this->profile_id,
            'publication_title' => $this->publication_title,
            'publication_text' => $this->publication_text,
            'publication_status' => $this->publication_status,
        ]);
    }

    // Read
    public function getByProfile($profile_id) {
        $SQL = 'SELECT * FROM publication WHERE profile_id = :profile_id ORDER BY timestamp DESC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['profile_id' => $profile_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Publication');
        return $STMT->fetchAll();
    }

    public function getAllPublic() {
        $SQL = 'SELECT * FROM publication WHERE publication_status = \'public\' ORDER BY timestamp DESC';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute();
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Publication');
        return $STMT->fetchAll();
    }

    // Update
    public function update() {
        $SQL = 'UPDATE publication SET publication_title = :publication_title, publication_text = :publication_text, publication_status = :publication_status WHERE publication_id = :publication_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'publication_id' => $this->publication_id,
            'publication_title' => $this->publication_title,
            'publication_text' => $this->publication_text,
            'publication_status' => $this->publication_status,
        ]);
    }

    // Delete
    public function delete() {
        $SQL = 'DELETE FROM publication WHERE publication_id = :publication_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['publication_id' => $this->publication_id]);
    }

    // Get a specific publication by ID
    public function getById($publication_id) {
        $SQL = 'SELECT * FROM publication WHERE publication_id = :publication_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['publication_id' => $publication_id]);
        $STMT->setFetchMode(PDO::FETCH_CLASS, 'app\models\Publication');
        return $STMT->fetch();
    }

    public function searchPublications($searchTerm) {
        $SQL = "SELECT * FROM publication WHERE publication_status = 'public' AND (publication_title LIKE :searchTerm)";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['searchTerm' => '%' . $searchTerm . '%']);
        return $STMT->fetchAll(PDO::FETCH_CLASS, 'app\models\Publication');
    }
}
