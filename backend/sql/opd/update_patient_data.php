<?php
include './db_connection.php'; // เชื่อมต่อฐานข้อมูล

// รับข้อมูลจาก POST
$data = json_decode(file_get_contents('php://input'), true);

// ตรวจสอบข้อมูลที่ได้รับ
if (isset($data['name'], $data['disease'], $data['symptoms'], $data['treatmentPlan'], $data['startDate'], $data['nextVisitDate'], $data['notes'])) {
    // ดำเนินการอัพเดตข้อมูล
    $sql = "INSERT INTO appointments (patient_name, disease, symptoms, treatment_plan, start_date, next_visit_date, notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $data['name'], $data['disease'], $data['symptoms'], $data['treatmentPlan'], $data['startDate'], $data['nextVisitDate'], $data['notes']);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Data updated successfully']);
    } else {
        echo json_encode(['error' => 'Error updating data: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid input']);
}

$conn->close();
?>
