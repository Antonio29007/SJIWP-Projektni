<?php
include("db_connection.php");
header('Content-Type: application/json');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "SELECT *, DATE_FORMAT(datum_rodenja, '%Y-%m-%d') AS formatted_datum FROM igraci WHERE ID_igraca = ?";
    $stmt = $conn->prepare($sql);   
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $data['datum_rodenja'] = $data['formatted_datum'];
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Igrač nije pronađen']);
    }
} else {
    echo json_encode(['error' => 'Nevažeći ID igrača']);
}
?>  