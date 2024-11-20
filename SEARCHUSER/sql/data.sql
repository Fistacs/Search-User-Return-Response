-- Create a table named 'applicants' to store job application details
CREATE TABLE applicants (
    -- Unique identifier for each applicant, automatically increments with each new entry
    applicant_id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Applicant's first name, stored as a string up to 255 characters
    fname VARCHAR(255),
    
    -- Applicant's last name, stored as a string up to 255 characters
    lname VARCHAR(255),
    
    -- Applicant's medical specialization, stored as a string up to 255 characters
    specialization VARCHAR(255),
    
    -- Timestamp indicating when the applicant record was created, defaults to the current time
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
