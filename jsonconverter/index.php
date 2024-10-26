<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to JSON Converter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>XML to JSON Converter</h1>
    <form method="POST" action="index.php">
        <div class="textarea-container">
            <textarea name="xmlInput" placeholder="Enter XML here..."><?php echo isset($_POST['xmlInput']) ? htmlspecialchars($_POST['xmlInput']) : ''; ?></textarea>
            <textarea readonly><?php echo isset($jsonOutput) ? htmlspecialchars($jsonOutput) : ''; ?></textarea>
        </div>
        <button type="submit" name="convert">Convert!</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['convert'])) {
    $xmlInput = $_POST['xmlInput'];
    if (!empty($xmlInput)) {
        // Convert XML to JSON
        $jsonOutput = convertXmlToJson($xmlInput);
        echo '<script>document.querySelector("textarea[readonly]").innerText = ' . json_encode($jsonOutput) . ';</script>';
    }
}

// Function to convert XML to JSON
function convertXmlToJson($xmlString) {
    libxml_use_internal_errors(true); // Suppress XML parsing errors
    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
    
    if ($xml === false) {
        return json_encode(['error' => 'Invalid XML']);
    }
    
    $array = json_decode(json_encode($xml), true); // Convert XML to array
    return json_encode($array, JSON_PRETTY_PRINT);
}
?>

</body>
</html>
