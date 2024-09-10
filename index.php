
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Orders Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Client Orders Report</h1>
    
    
    <?php
    include 'query.php'; // Include query execution file
    
    // Get the data from query.php
    $data = include 'query.php';
    
    // Check if there are results and process them
    if (count($data) > 0) {
        // Output data in a table
        echo '<table>
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Cash</th>
                        <th>Change</th>
                    </tr>
                </thead>
                <tbody>';
        
        foreach ($data as $row) {
            // Calculate the change as Total - Cash
            $total = (float)$row["total"];
            $cash = (float)$row["cash"];
            $change = $cash - $total;
            
            echo '<tr>
                    <td>' . htmlspecialchars($row["client_id"]) . '</td>
                    <td>' . htmlspecialchars($row["full_name"]) . '</td>
                    <td>' . htmlspecialchars($row["contact"]) . '</td>
                    <td>' . htmlspecialchars($row["address"]) . '</td>
                    <td>' . htmlspecialchars($row["order_id"]) . '</td>
                    <td>' . htmlspecialchars($row["product_name"]) . '</td>
                    <td>' . htmlspecialchars('₱' . number_format((float)$row["price"], 2)) . '</td>
                    <td>' . htmlspecialchars($row["quantity"]) . '</td>
                    <td>' . htmlspecialchars('₱' . number_format($total, 2)) . '</td>
                    <td>' . htmlspecialchars('₱' . number_format($cash, 2)) . '</td>
                    <td>' . htmlspecialchars('₱' . number_format($change, 2)) . '</td>
                  </tr>';
        }
        
        echo '</tbody>
            </table>';
    } else {
        echo '<p class="no-results">No results found.</p>';
    }
    ?>
</body>
</html>
