<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'DBConnection.php';

class KontaktModel extends DBConnection
{
    public function insert(
        $vorname,
        $nachname,
        $from,
        $to,
        $subject,
        $message,
        $dateSent
    ) {
        $dateSent = $dateSent->format('Y-m-d H:i:s');

        $sql =
            'INSERT INTO emails (vorname, nachname, from_email, to_email, email_subject, email_message, date_created) VALUES (?,?,?,?,?,?,?)';

        // $sql =
        // 'INSERT INTO emails (vorname, nachname, from, to, subject, message, date_created) VALUES (:vorname, :nachname, :from, :to, :subject, :message, :date_created)';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            $vorname,
            $nachname,
            $from,
            $to,
            $subject,
            $message,
            $dateSent,
        ]);
    }

    public function getOne($id)
    {
        $sql = 'SELECT * FROM emails WHERE id = :kontakt_id';

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':kontakt_id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            //echo $stmt;
            $email = $stmt->fetch();

            return $email;
        }
    }

    public function getAll()
    {
        //$data = $pdo->query('SELECT * FROM emails')->fetchAll();

        // $conn = new DBConnection();

        //$stmt = $this->pdo->prepare('SELECT * FROM emails');

        $sql = 'SELECT * FROM emails';

        $stmt = $this->pdo->query($sql)->fetchAll();

        return $stmt;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM emails WHERE id = :kontakt_id';

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':kontakt_id', $id, PDO::PARAM_INT);

        if ($statement->execute()) {
            echo 'Kontakt ' . $id . ' was deleted successfully.';
        }
    }

    public function deleteOlderThan2Weeks()
    {
        $sql =
            'DELETE FROM emails WHERE date_created < NOW() - INTERVAL 14 DAY';

        $statement = $this->pdo->prepare($sql);

        if ($statement->execute()) {
            echo 'Deleted contacts older than 2 weeks';
        }
    }
}
?>

