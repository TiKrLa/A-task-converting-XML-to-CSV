<?php
	// Open xml file that is present in 
// your folder 
$xmldata = 'finvoice.xml';

// Check if file mentioned above 
// is exists or not 
if (file_exists($xmldata)) {

    // If file exists then load your xml
    // data using simplexml_load_file 
    // function, this function is used to convert an XML document to an object
    $xml_data = simplexml_load_file($xmldata);

    // Open xml file using fopen in write 
    // mode and download the data as 
    // finvoice.csv
    $i = fopen('finvoice.csv', 'w'); // w is one of the modes, which means w (write mode)

    // Function call
    Csv($xml_data, $i);

    // This function is used to close the opened file
    fclose($i);
}

// Function to create csv file 
function Csv($xml_data, $i) {

    // Count data for data present in 
    // xml using children function
    foreach ($xml_data->children() as $data) {
        $hasChild = (count($data->children())
         > 0) ? true : false;

        // Data is present, then store into 
        // csv by using fputcsv function 
        if( ! $hasChild) {
            $arr = array($data->getName(),$data);
            fputcsv($i, $arr ,',', '"'); // syntax, for example fputcsv(file, fields, separator)
                                         // fields is required to specify where array to get data from 
        }
        else {
            // Call function 
            Csv($data, $i);
        }
    }
}
?>
