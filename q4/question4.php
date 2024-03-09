<?php
// $item_tier_rarity = [1, 2, 3, 4, 5];
// $vip_ranks  = ["v1", "v2", "v3"];


// function roll_item($vip_rank_array) {
//     global $item_tier_rarity;
//     global $vip_rank;
//     $totalitem = count($item_tier_rarity);
//     $currentvip = 1 + array_search($vip_rank_array, $vip_rank);
    
    
    
    
//     echo $currentvip ;
    
//     // echo preg_replace('/\D/', '', $vip_rank_array[0]);

// }

// roll_item($vip_rank[0]); 

// function roll_item($vip_rank_array) {
//     global $item_tier_rarity;
//     global $vip_ranks;
//     $total_item = count($item_tier_rarity);
//     $current_vip = 1 + array_search($vip_rank_array, $vip_ranks);
    
//     $higherGet = $current_vip +2;
//     echo "Rolling items for VIP Rank: $current_vip\n";
    
//     // Simulating the item distribution
//     $item_distribution = [];

//     // Generate percentages for the first $numItems - 1 items
//     for ($i = 1; $i < $higherGet; $i++) {
//         $min = (100/($higherGet - 1 )) - rand(1, 10); // Minimum percentage to ensure increasing order
//         $max = (100/($higherGet - 1 )) + rand(1, 10); // Maximum percentage, leaving room for remaining items
//         $percentages[$i] = rand($min, $max);
//     }
//     $total_percentage = array_sum($percentages);
//     // Ensure the last item is less than 10%
//     $percentages[$higherGet] = 100 - $total_percentage ;
//     // Printing the item distribution result
//     for ($i = 1; $i <= $higherGet; $i++) {
//         echo "item{$i}_percentage - {$percentages[$i]}%\n";
//     }
    
//     echo "\n";
// }

// Looping 100 times for each VIP rank
// foreach ($vip_ranks as $rank) {
//     for ($i = 0; $i < 100; $i++) {
//         roll_item($rank);
//     }
// }
// roll_item($vip_ranks[0]);

// Initialize an array to hold the counts of each box getting at least one item
$boxCounts = [0, 0, 0, 0, 0];

// Perform 100 simulations
for ($simulation = 1; $simulation <= 100; $simulation++) {
    // Initialize an array with 5 items
    $items = range(1, 5);

    // Shuffle the items randomly
    shuffle($items);

    // Initialize an array to hold the boxes
    $boxes = array_fill(0, 5, []);

    // Set the probabilities for each box
    $baseProbability = 0.1; // Base probability for other boxes
    $randomFactor = mt_rand(50, 100) / 100; // Random factor between 0.5 and 1.0
    $probFirstBox = $randomFactor * 0.4; // Higher probability for first box
    $probSecondBox = $randomFactor * 0.4; // Higher probability for second box
    $probOtherBoxes = $baseProbability * (1 / $randomFactor); // Lower probability for other boxes
    $boxProbabilities = [$probFirstBox, $probSecondBox, $probOtherBoxes, $probOtherBoxes, $probOtherBoxes];

    // Distribute the items among the boxes based on probabilities
    foreach ($items as $item) {
        // Generate a random number to determine the box
        $randomNumber = mt_rand() / mt_getrandmax();
        $cumulativeProbability = 0;

        // Determine the box based on probabilities
        for ($i = 0; $i < 5; $i++) {
            $cumulativeProbability += $boxProbabilities[$i];
            if ($randomNumber <= $cumulativeProbability) {
                $boxIndex = $i;
                break;
            }
        }

        // Place the item in the selected box
        $boxes[$boxIndex][] = $item;
    }

    // Check if each box has at least one item
    foreach ($boxes as $boxIndex => $box) {
        if (!empty($box)) {
            $boxCounts[$boxIndex]++;
            break; // No need to continue checking other boxes
        }
    }
}

// Calculate percentages
$percentages = [];
foreach ($boxCounts as $count) {
    $percentages[] = ($count / 100) * 100;
}

// Output the percentage of each box getting at least one item
for ($i = 0; $i < 5; $i++) {
    // echo "Box " . ($i + 1) . " receives at least one item in " . $percentages[$i] . "% of the simulations.\n";
}
// $itemTierRarity = [1, 2, 3, 4, 5]; // 1 = common, 5 = legend
// $vipRank = ["v1", "v2", "v3", "v4", "v5"]; // v1 = lowest rank

// function rollItem($vipRank) {
//     global $itemTierRarity;
//     global $vipRank;

//     // Increase the probability of getting higher rarity items for higher VIP ranks
//     $weights = array_map(fn ($rank) => count($itemTierRarity) - $rank, range(0, count($vipRank) - 1));
//     $itemRarity = array_rand($itemTierRarity, 1, $weights);
//     return $itemTierRarity[$itemRarity];
//   }
  
//   function simulateItemDistribution($numRolls = 100) {
//     global $itemTierRarity;
//     global $vipRank;
//     $itemDistribution = [];
//     foreach ($vipRank as $rank) {
//       $itemDistribution[$rank] = array_fill(0, count($itemTierRarity), 0);
//       for ($i = 0; $i < $numRolls; $i++) {
//         $item = rollItem($rank);
//         $itemDistribution[$rank][$item - 1]++;
//       }
//     }
  
//     // Print the item distribution for each VIP rank
//     foreach ($itemDistribution as $rank => $counts) {
//       echo "VIP $rank distribution: " . implode(", ", $counts) . PHP_EOL;
//     }
//   }
  
//   simulateItemDistribution();

// function generatePercentages($numItems) {
//     $percentages = [];

//     // Generate percentages for the first $numItems - 1 items
//     for ($i = 1; $i < $numItems; $i++) {
//         $min = ($i == 1) ? 1 : $percentages[$i - 1] + 1; // Minimum percentage to ensure increasing order
//         $max = 100 - array_sum($percentages) - ($numItems - $i - 1) * 10; // Maximum percentage, leaving room for remaining items
//         $percentages[$i] = rand($min, $max);
//     }

//     // Ensure the last item is less than 10%
//     $percentages[$numItems] = rand(1, 9);

//     return $percentages;
// }

// // Number of items
// $numItems = 5;

// // Generate percentages for the specified number of items
// $percentages = generatePercentages($numItems);

// // Output the percentages
// for ($i = 1; $i <= $numItems; $i++) {
//     echo "item{$i}_percentage - {$percentages[$i]}%\n";
// }

// Define item tier rarity and VIP ranks
// $itemTierRarity = [1, 2, 3, 4, 5]; // 1 = common, 5 = legendary
// $vipRanks = ['v1', 'v2', 'v3', 'v4', 'v5']; // v1 = lowest rank

// // Function to roll an item based on VIP rank
// function rollItem($vipRank) {
//     global $itemTierRarity;
//     if ($vipRank == 'v1') {
//         return weightedRandom($itemTierRarity, [40, 40, 10, 5, 5]);
//     } elseif ($vipRank == 'v2') {
//         return weightedRandom($itemTierRarity, [35, 35, 20, 7, 3]);
//     } elseif ($vipRank == 'v3') {
//         return weightedRandom($itemTierRarity, [30, 30, 25, 10, 5]);
//     } elseif ($vipRank == 'v4') {
//         return weightedRandom($itemTierRarity, [25, 25, 30, 15, 5]);
//     } elseif ($vipRank == 'v5') {
//         return weightedRandom($itemTierRarity, [20, 20, 35, 20, 5]);
//     } else {
//         throw new Exception("Invalid VIP rank");
//     }
// }

// // Function to generate a weighted random value
// function weightedRandom($values, $weights) {
//     $totalWeight = array_sum($weights);
//     $random = mt_rand(1, $totalWeight);
//     $n = count($values);
//     for ($i = 0; $i < $n; $i++) {
//         if ($random <= $weights[$i]) {
//             return $values[$i];
//         }
//         $random -= $weights[$i];
//     }
// }

// // Function to simulate rolling items for each VIP rank and print distribution
// function simulateRolling() {
//     global $vipRanks;
//     global $itemTierRarity;

//     foreach ($vipRanks as $vip) {
//         echo "$vip player have higher chance to get an item in " . implode(',', array_slice($itemTierRarity, 0, array_search($vip, $vipRanks) + 1)) . " rarity\n";
//         $itemCounts = array_fill_keys($itemTierRarity, 0);
//         for ($i = 0; $i < 100; $i++) {
//             $item = rollItem($vip);
//             $itemCounts[$item]++;
//         }
//         echo "Item distribution:\n";
//         foreach ($itemCounts as $tier => $count) {
//             echo "Tier $tier: $count\n";
//         }
//         echo "\n";
//     }
// }

// // Run the simulation
// simulateRolling();

// Define the item tiers and their respective rarities
// $itemTierRarity = [1, 2, 3, 4, 5]; // 1 = common, 5 = legend

// Define the VIP ranks
// $vipRank = ['v1', 'v2', 'v3', 'v4', 'v5']; // v1 = lowest rank

// Define a function to generate probabilities for each VIP rank
// function generateProbabilities($numTiers) {
//     $probabilities = [];
//     for ($i = 0; $i < $numTiers; $i++) {
//         $weights = [];
//         $totalWeights = 0;
//         for ($j = 0; $j < $numTiers; $j++) {
//             $weights[] = rand(1, 100);
//             $totalWeights += $weights[$j];
//         }
//         $probabilities[] = array_map(function ($weight) use ($totalWeights) {
//             return $weight / $totalWeights;
//         }, $weights);
//     }
//     return $probabilities;
// }

// // Generate probabilities for each VIP rank
// $vipProbabilities = [];
// $numTiers = count($itemTierRarity);
// foreach ($vipRank as $rank) {
//     $vipProbabilities[$rank] = generateProbabilities($numTiers);
// }

// function rollItem($vipRank) {
//     global $vipProbabilities, $itemTierRarity;
//     $weights = $vipProbabilities[$vipRank];
//     $cumulativeWeights = [];
//     $cumulative = 0;

//     // Calculate cumulative weights
//     foreach ($weights as $weight) {
//         $cumulative += $weight;
//         $cumulativeWeights[] = $cumulative;
//     }

//     // Select a random value within the range of cumulative sum
//     $randomValue = rand(1, (int)end($cumulativeWeights));

//     // Find the corresponding index in the array
//     foreach ($cumulativeWeights as $key => $value) {
//         if ($randomValue <= $value) {
//             return $itemTierRarity[$key];
//         }
//     }
// }

// function printItemDistribution() {
//     global $vipRank;
//     global $itemTierRarity;
//     foreach ($vipRank as $rank) {
//         $itemsDistribution = array_fill_keys($itemTierRarity, 0);
//         for ($i = 0; $i < 100; $i++) { // Roll 100 times for each VIP rank
//             $itemTier = rollItem($rank);
//             $itemsDistribution[$itemTier]++;
//         }
//         echo "$rank player have higher chance to get an item in [" . implode(", ", array_keys($itemsDistribution)) . "] rarity\n";
//     }
// }

// // Example usage
// printItemDistribution();



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
