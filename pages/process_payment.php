<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];

    switch ($payment_method) {
        case 'razorpay':
            header("Location: razorpay_payment.php?amount=" . $total_amount);
            break;
        case 'paypal':
            header("Location: paypal_payment.php?amount=" . $total_amount);
            break;
        case 'googlepay':
            header("Location: googlepay_payment.php?amount=" . $total_amount);
            break;
        case 'phonepe':
            header("Location: phonepe_payment.php?amount=" . $total_amount);
            break;
        default:
            echo "Invalid Payment Method!";
            break;
    }
    exit;
}
?>
