<?php
namespace app\models;

use PDO;

class PublicationComment extends \app\core\Model {
    public $publication_comment_id;
    public $profile_id;
    public $publication_id;
    public $comment_text;
    public $timestamp;

    public function insert() {
        $sql = "INSERT INTO publication_comment (profile_id, publication_id, comment_text) VALUES (:profile_id, :publication_id, :comment_text)";
        $stmt = self::$_conn->prepare($sql);
        $stmt->execute([
            ':profile_id' => $this->profile_id,
            ':publication_id' => $this->publication_id,
            ':comment_text' => $this->comment_text,
        ]);
    }

    public function getByPublicationId($publication_id) {
        $sql = "SELECT * FROM publication_comment WHERE publication_id = :publication_id ORDER BY timestamp DESC";
        $stmt = self::$_conn->prepare($sql);
        $stmt->execute([':publication_id' => $publication_id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }
}

