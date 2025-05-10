<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $spec1 = $_POST['spec1'];
    $spec2 = $_POST['spec2'];
    $spec3 = $_POST['spec3'];
    $spec4 = $_POST['spec4'];
    $spec5 = $_POST['spec5'];
    $spec6 = $_POST['spec6'];
    $description = $_POST['description'];

    // Check if an image has been uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get the image data and type
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $imageType = "image/jpeg";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO watch 
            (name, brand, color, price, stock, image, image_type, spec1, spec2, spec3, spec4, spec5, spec6, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssdisssssssss", 
            $name, $brand, $color, $price, $stock, $imageData, 
            $imageType, $spec1, $spec2, $spec3, $spec4, $spec5, $spec6, $description);

        // Send the image data as long data
        $null = NULL; // Placeholder for the blob parameter
        $stmt->send_long_data(6, $imageData); // Send the image to the BLOB column (index 5)

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully!'); window.location.href='stock.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Show an error if no image was uploaded or there was an issue with the file
        echo "Error: No image uploaded or image upload failed. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
