<?php
$target_time = time() + 5*60; // waktu target 5 menit dari sekarang
while (time() < $target_time) {
  $remaining_seconds = $target_time - time();
  $remaining_minutes = floor($remaining_seconds / 60);
  $remaining_seconds = $remaining_seconds % 60;
  echo "Waktu mundur: " . $remaining_minutes . ":" . $remaining_seconds . "\n";
  sleep(1); // jeda 1 detik
}
echo "Waktu habis!";
?>
