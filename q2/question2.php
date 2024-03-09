<?php
function checkDiscount($price){
    if($price >= 500){
        $discount = 0.1; 
    } elseif ($price < 500 && $price >= 100) {
        $discount = 0.05; // 5% discount for purchases under 500 but above or equal to 100
    } else {
        $discount = 0; // No discount for purchases below 100
    }

    if ($discount > 0) {
        $DPercentage = $discount * 100;
        echo "Purchase Value is $price, discount is $DPercentage%";
    } else {
        echo "Purchase Value is $price, there are no discount.";
    }
}

echo "checkDiscount(300)";
echo "<br>";
checkDiscount(300);
echo "<br>";
echo "checkDiscount(80)"; 
echo "<br>";
checkDiscount(80);
echo "<br>";
echo "checkDiscount(600)"; 
echo "<br>";
checkDiscount(600);
?>