<?php
include 'db_config.php'; // Include database configuration

// SQL query to perform an inner join between client, orders, and payment tables
$sql = "SELECT client.client_id, client.full_name, client.contact, client.address, 
               orders.order_id, orders.product_name, orders.price, orders.quantity,
               payment.payment_id, payment.total, payment.cash, payment.change
        FROM client 
        INNER JOIN orders ON client.client_id = orders.client_id
        INNER JOIN payment ON orders.order_id = payment.order_id";

// Execute the query
$result = $conn->query($sql);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Store results in an array
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Return data as array (no direct output here)
return $data;
?>
