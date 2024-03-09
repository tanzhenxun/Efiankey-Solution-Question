<?php
// Define the item tiers and their rarities
$item_tier_rarity = [1, 2, 3, 4, 5]; // 1 = common, 5 = legend

// Define the VIP ranks
$vip_rank = ['v1', 'v2', 'v3']; // v1 = lowest rank

// Function to generate a random item based on VIP rank
function roll_item($vip_rank, $lowerchance) {
    global $item_tier_rarity;
    $newchance = 0;
    if($lowerchance == true){
        $newchance = 1;
    }
    // Determine the maximum tier based on VIP rank
    $max_tier = array_search($vip_rank, $GLOBALS['vip_rank']) + 2 + $newchance;
    // Generate a random tier within the maximum tier
    $random_tier = mt_rand(1, $max_tier);
    // Determine the rarity based on the random tier
    $rarity = $item_tier_rarity[$random_tier - 1];

    return $rarity;
}

// Function to simulate rolling items for each VIP rank
function simulate_rolls($extraVip = [], $extraRarities = []) {
    global $vip_rank;
    global $item_tier_rarity;
    // Loop through each VIP rank
    $item_tier_rarity = array_merge($item_tier_rarity, $extraRarities);
    $vip_rank = array_merge($vip_rank, $extraVip);
    foreach ($vip_rank as $rank) {
        $result = [];
        // Simulate 100 rolls for the current VIP rank
        for ($i = 0; $i < 100; $i++) {
            $lowerchance = false; // Initialize $add as false for each iteration
            // Check if $i matches any of the specified values
            if ($i == 10 || $i == 20 || $i == 30 || $i == 40 || $i == 50 || $i == 60 || $i == 70 || $i == 80 || $i == 90 || $i == 100) {
                $lowerchance = true; // If $i matches, set $add to true
            }        
            $item = roll_item($rank, $lowerchance);
            $result[] = $item;
        }

        // Count the occurrences of each rarity
        $counts = array_count_values($result);

        // Fill in missing rarities with zero count
        foreach ($item_tier_rarity as $rarity) {
            if (!isset($counts[$rarity])) {
                $counts[$rarity] = 0;
            }
        }
        // Sort the rarity numbers in ascending order
        ksort($counts);
        // Output the distribution result for the current VIP rank
        echo "VIP $rank player has a distribution of items:\n";
        foreach ($counts as $rarity => $count) {
            echo "  Rarity $rarity: $count\n";
            
        }
        echo "<br>";
    }
}

// Simulate rolls for each VIP rank and print the distribution results
simulate_rolls(['v4', 'v5'], [6, 7, 8]);


?>
