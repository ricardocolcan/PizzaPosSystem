<?php
include "dbconnect.php";
include_once('fpdf185/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        //LOGO
        $this->Image('logo/pizzaLogo.png',150,30,45);
	    $this->Ln(10);
        $this->SetFont('Arial','B',25);
        $this->Cell(100,10,'INVOICE',0,1,'L');
        $this->SetY(32);
        $this->SetFont('Arial','B',13);
        $this->Cell(70,8, 'Store Information',0,1,'L');
        $this->Line(10,40,120,40);
        $this->SetY(43);
        $this->SetFont('Arial','',13);
        $this->Cell(25,8,'Address:',0,0,'L');
        $this->MultiCell(60,8,'200 Old Carriage Dr, Kitchener, ON, N2P 0C7',0,'L');
        $this->Cell(25,8,'Website:',0,0,'L');
        $this->Cell(50,8,'www.pizzatime.ca',0,1,'L');
        $this->Cell(25,8,'Email:',0,0,'L');
        $this->Cell(50,8,'service@pizzatime.on.ca',0,1,'L');
        $this->Cell(25,8,'Phone:',0,0,'L');
        $this->Cell(50,8,'1-800-888-333',0,1,'L');
        // Title
        $this->Line(5,90,205,90);
        // Line break
        $this->Ln(5);
    }
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$orderNumber = $_GET['orderID'];; //Pass order number parameter to this variable.

$orderRecord = mysqli_query($conn, "SELECT * FROM pizza_sales.order where order.id = $orderNumber") or die("database error:". mysqli_error($conn));

$pdf = new PDF();
foreach($orderRecord as $order){

    $clientRecord = mysqli_query($conn, 
    "   SELECT * 
        FROM client 
        INNER JOIN pizza_sales.order ON client.id = order.client_id 
        WHERE order.id = ".$order["id"]) 
        or die("database error:". mysqli_error($conn));


    $paymentRecord = mysqli_query($conn, 
    "   SELECT * 
        FROM payment_type 
        INNER JOIN pizza_sales.order ON payment_type.id = order.payment_type
        WHERE order.id = ".$order["id"]) 
        or die("database error:". mysqli_error($conn));

    $subOrderRecord = mysqli_query($conn, 
    "   SELECT * 
        FROM sub_order
        INNER JOIN pizza_sales.order ON order.id = sub_order.order_id
        INNER JOIN pizza_sales.pizza ON pizza.id = sub_order.pizza_id  
        WHERE order.id = ".$order["id"]) 
        or die("database error:". mysqli_error($conn));

    $userRecord = mysqli_query($conn, 
    "   SELECT * 
        FROM user
        INNER JOIN pizza_sales.order ON user.id = order.user_id
        INNER JOIN pizza_sales.user_type ON user.type_user_id = user_type.id
        WHERE order.id = ".$order['id']." AND order.user_id = user.id") 
        or die("database error:". mysqli_error($conn));

    foreach($paymentRecord as $payment){
        $pdf->AddPage();
        $pdf->AliasNbPages();
        //page start
        $pdf->SetFont('Arial','B',13);
        $pdf->SetY(100);
    
        $pdf->Cell(0,0,'Bill To :',0,1,'L');
        $pdf->Line(10,105,120,105);
        $pdf->SetFont('Arial','',13);
        $pdf->SetY(110);
    
        $pdf->Cell(35,7,'Order Number: ',0,0,'L');
        $pdf->Cell(50,7, $order['id'],0,1,'L');
        $pdf->Cell(35,7,'Order Date: ',0,0,'L');
        $pdf->Cell(35,7, $order['order_time'],0,1,'L');
        $pdf->Cell(35,7,'Payment Type: ',0,0,'L');
        $pdf->MultiCell(35,7, $payment['type'],0,'L');
    
    }
    
    foreach($clientRecord as $client){
        
        $pdf->SetFont('Arial','B',13);
        $pdf->SetY(100);
        $pdf->Cell(115);
        $pdf->Cell(30,0,'Client Information :',0,1,'L');
        $pdf->Line(125,105,200,105);
        $pdf->SetFont('Arial','',13);
        $pdf->SetY(110);
        $pdf->Cell(115);
        $pdf->Cell(20,7,'Name:',0,0,'L');
        $pdf->Cell(30,7, $client['name'],0,1,'L');
        $pdf->Cell(115);
        $pdf->Cell(20,7,'Cell No.:',0,0,'L');
        $pdf->Cell(30,7, $client['phone_number'],0,1,'L');
        $pdf->Cell(115);
        $pdf->Cell(20,7,'Address:',0,0,'L');
        $pdf->MultiCell(30,7, ($client['address'].' '.$client['postal_code']),0,'L');
        
    }
    $pdf->SetY(150);
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(45, 7, 'Product', 1, 0, 'C');
    $pdf->Cell(95, 7, 'Description', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Size', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Unit Price', 1, 1, 'C');

    foreach($subOrderRecord as $subOrder){
        $pdf->SetFont('Arial','',13);
        $pdf->Cell(45, 7, $subOrder['name'], 1, 0, 'C');
        $pdf->Cell(95, 7, $subOrder['description'], 1, 0, 'C');
        $pdf->Cell(25, 7, $subOrder['size'], 1, 0, 'C');
        $pdf->Cell(25, 7, ($subOrder['price'].'.00'), 1, 1, 'C');
        
    }
    $pdf->Cell(0,14,'',0,1);
    $pdf->Cell(130);
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(30, 7, 'Total Cost: ', 0, 0, 'C');
    $pdf->SetFont('Arial','B'.'U',13);
    $pdf->Cell(30, 7, '$ '.$order['total_price'].'.00', 0, 1, 'C');
    
    $pdf->SetY(230);
    foreach($userRecord as $user){
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(45, 7, 'Sold by', 0, 1, 'L');
        $pdf->Line(10,237,100,237);
        $pdf->Cell(0, 3, '',0,1);
        $pdf->SetFont('Arial','',13);
        $pdf->Cell(30, 7, 'User id:', 0, 0, 'L');
        $pdf->Cell(30, 7, $user['user_id'], 0, 1, 'L');
        $pdf->Cell(30, 7, 'User Name:', 0, 0, 'L');
        $pdf->Cell(30, 7, $user['full_name'], 0, 1, 'L');
        $pdf->Cell(30, 7, 'User type:', 0, 0, 'L');
        $pdf->Cell(30, 7, $user['type'], 0, 1, 'L');
    }
    
    
}
$pdf->Output();
?>

