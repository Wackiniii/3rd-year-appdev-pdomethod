<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denmark Grocery Item Database</title>
    <style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
    <?php

    // // Selects Arrays of Denmark Grocery Items
    // // Prepares the SQL Statement (Selecting all records from the table) to be executed
    // $stmt = $pdo->prepare("SELECT * FROM denmark_grocery_items"); 

    // if ($stmt -> execute()) { //Executes the statement
    //     echo "<pre>"; // a preformatted text helping for a readable format by preserving spaces and line breaks
    //     print_r($stmt->fetchAll(PDO::FETCH_ASSOC)); // Fetches All reccord in an associative array (PDO::FETCH_ASSOC)
    //     echo "</pre>";
    // }


    
    // // Selects Array of Denmark Grocery Item with item id 67
    // $query = "SELECT * FROM denmark_grocery_items WHERE items_id = 67"; // a variable that stores a SQL query selecting item id 67
    // $stmt = $pdo->prepare($query); 

    // if ($stmt -> execute()) {
    //     $record = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches only one reccord in an associative array (PDO::FETCH_ASSOC)
    //     echo "<pre>";
    //     print_r($record); 
    //     echo "</pre>";
    // }


    
    // // Insertion Record 
    // $query = "INSERT INTO denmark_grocery_items (items_id, brand_name, product_name, 
    //     category, package_size, unit_price, expiration_date, date_added)
    //     VALUES (?, ?, ?, ?, ?, ?, ?, NOW()) -- ? serves as a positional placeholder preventing SQL injection
    // ";
    // $stmt = $pdo->prepare($query);

    // try { // try catch block 
    //     $stmt->execute([101, 'Mikkeller', 'Peter, Pale and Mary',  // inserts the record in database
    //         'Beverages', '330 ml', 28.50, '2027-12-01']);
    //     echo "Query successful!";

    //     $selectStmt = $pdo->prepare("SELECT * FROM denmark_grocery_items WHERE items_id = ?");
    //     $selectStmt->execute([101]);
    //     $record = $selectStmt->fetch(PDO::FETCH_ASSOC);

    //     echo "<pre>";
    //     print_r($record); //shows the new record added in database (just my preference)
    //     echo "</pre>";
    // } catch (PDOException $e) {
    //     echo "Query failed: " . $e->getMessage();
    // }



    // // Deleting a Record
    // $query = 'DELETE FROM denmark_grocery_items WHERE items_id = ?'; // a delete query
    // $stmt = $pdo->prepare($query);

    // try { // a try catch block that prevents crash when there's an error 
    //     $stmt->execute([101]); // execution of statement that deletes the item id 101
    //     echo "<br>Deletion successful!"; 
    // } catch (PDOException $e) {
    //     echo "<br>Query Failed: " . $e->getMessage();
    // }



    // // Update a Record 
    // $query = 'UPDATE denmark_grocery_items 
    //             SET unit_price = ?, package_size =? WHERE items_id = ?'; // an Update Query
    // $stmt = $pdo->prepare($query);

    // try {
    //     $stmt->execute([21.50, '1.5L', 99]); // Values modified in the record
    //     echo "<br>Record Update Successful!";

    //     $selectStmt = $pdo->prepare("SELECT * FROM denmark_grocery_items WHERE items_id = ?"); 
    //     $selectStmt->execute([99]); // Selects the new updated record
    //     $record = $selectStmt->fetch(PDO::FETCH_ASSOC);

    //     echo "<pre>";
    //     print_r($record); //shows the new record added in database (just my preference)
    //     echo "</pre>";
    // } catch (PDOException $e) {
    //     echo "<br>Query Failed: " . $e->getMessage();
    // }



    // For Number 10: displays top 10 grocery items with the highest unit price
    $query = 'SELECT items_id, brand_name, product_name, category, unit_price 
              FROM denmark_grocery_items 
              ORDER BY unit_price DESC  
              LIMIT 10';

    $stmt = $pdo->prepare($query);
    try {
        $stmt->execute();
        $grocery_items = $stmt->fetchAll(PDO::FETCH_ASSOC); // retrives all records from the database
    } catch (PDOException $e) {
        echo "<br>Query Failed: " . $e->getMessage();
    }
    ?>
    
    <h1>Top 10 Grocery Items with the Highest Unit Price</h1>
    <table> <!-- creates the HTML table that will display top 10 highest unit price grocery items  -->
        <tr> 
            <th>ID</th>
            <th>Brand Name</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
        </tr>
        <?php foreach ($grocery_items as $rows) {?> <!-- a loop that automatically goes through an array per item displaying each rows-->
        <tr>
            <td><?php echo $rows['items_id']?></td>
            <td><?php echo $rows['brand_name']?></td>
            <td><?php echo $rows['product_name']?></td>
            <td><?php echo $rows['category']?></td>
            <td><?php echo $rows['unit_price']?></td>
        </tr>
        <?php }?>
    </table>
</body>
</html>