<?php
require_once("../config/connection.php");

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = ($page - 1) * $limit;
$searchBy = isset($_GET['searchBy']) ? $_GET['searchBy'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';

try {
    if ($searchBy && $query) {
        $stmt = $connection->prepare("SELECT * FROM tutor WHERE $searchBy LIKE :query LIMIT :limit OFFSET :offset");
        $likeQuery = "%$query%";
        $stmt->bindParam(':query', $likeQuery, PDO::PARAM_STR);
    } else {
        $stmt = $connection->prepare("SELECT * FROM tutor LIMIT :limit OFFSET :offset");
    }

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $tutors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($searchBy && $query) {
        $stmt = $connection->prepare("SELECT COUNT(*) AS total FROM tutor WHERE $searchBy LIKE :query");
        $stmt->bindParam(':query', $likeQuery, PDO::PARAM_STR);
    } else {
        $stmt = $connection->prepare("SELECT COUNT(*) AS total FROM tutor");
    }
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    echo json_encode([
        'tutors' => $tutors,
        'total' => $total,
        'page' => $page,
        'limit' => $limit
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
