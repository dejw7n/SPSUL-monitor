<?php

class Sis
{
    public function getPosts($center)
    {
        // API endpoint URL
        $apiUrl = 'https://sis-api.spsul.cz/api/monitor/posts/' . $center;

        // Initialize cURL session
        $curl = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL session
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        } else {
            // Parse the JSON response into a PHP array
            $data = json_decode($response, true);
        }

        // Close the cURL session
        curl_close($curl);
        return json_encode($data);
    }
}
