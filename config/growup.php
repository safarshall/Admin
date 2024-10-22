<?php
$sales_data = [1200, 1900, 3000, 5000, 7000, 8000]; // Example sales data
$months = ['January', 'February', 'March', 'April', 'May', 'June']; // Example months

// Send data to the frontend
echo json_encode($sales_data);
echo json_encode($months);
