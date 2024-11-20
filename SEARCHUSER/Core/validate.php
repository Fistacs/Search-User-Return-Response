<?php

// Function to sanitize user input for security and reliability
function sanitizeInput($data){
    // Remove any leading or trailing whitespace, tabs, or newlines
    $data = trim($data);
    
    // Strip backslashes from the input to avoid unintended escape characters
    $data = stripslashes($data);
    
    // Convert special characters into HTML entities to prevent XSS (Cross-Site Scripting)
    // For example, '<' becomes '&lt;', and '>' becomes '&gt;'
    $data = htmlspecialchars($data);
    
    // Return the sanitized data for safe use in the application
    return $data;
}
