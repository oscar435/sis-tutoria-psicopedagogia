<?php
require_once("../config/connection.php");

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = ($page - 1) * $limit;
$searchBy = isset($_GET['searchBy']) ? $_GET['searchBy'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';

try {
    if ($searchBy && $query) {
        $stmt = $connection->prepare("SELECT * FROM estudiante WHERE $searchBy LIKE :query LIMIT :limit OFFSET :offset");
        $likeQuery = "%$query%";
        $stmt->bindParam(':query', $likeQuery, PDO::PARAM_STR);
    } else {
        $stmt = $connection->prepare("SELECT * FROM estudiante LIMIT :limit OFFSET :offset");
    }

    // Bind limit and offset as integers
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count total number of records
    if ($searchBy && $query) {
        $stmt = $connection->prepare("SELECT COUNT(*) AS total FROM estudiante WHERE $searchBy LIKE :query");
        $stmt->bindParam(':query', $likeQuery, PDO::PARAM_STR);
    } else {
        $stmt = $connection->prepare("SELECT COUNT(*) AS total FROM estudiante");
    }
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    echo json_encode([
        'students' => $students,
        'total' => $total,
        'page' => $page,
        'limit' => $limit
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
