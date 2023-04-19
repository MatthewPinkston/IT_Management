<?php
    $working = "SELECT COUNT(*) as count FROM asset_tracking WHERE status = 'Working'";
    $scrap = "SELECT COUNT(*) as count FROM asset_tracking WHERE status = 'Scrap'";
    $repair = "SELECT COUNT(*) as count FROM asset_tracking WHERE status = 'Repair'";

    $resworking = mysqli_query($conn, $working);
    $resscrap = mysqli_query($conn, $scrap);
    $resrepair = mysqli_query($conn, $repair);

    $workingCount = mysqli_fetch_assoc($resworking);
    $scrapCount = mysqli_fetch_assoc($resscrap);
    $repairCount = mysqli_fetch_assoc($resrepair);

    // mysqli_close($conn);

    $widgetData['Asset_Tracking'] = array(
        'working' => $workingCount['count'],
        'scrap' => $scrapCount['count'],
        'repair' => $repairCount['count']
    );
?>