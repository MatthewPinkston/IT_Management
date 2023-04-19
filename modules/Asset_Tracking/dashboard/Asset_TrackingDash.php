<?php
    $yes = "SELECT COUNT(*) as count FROM asset_tracking WHERE isActive = 'Yes'";
    $no = "SELECT COUNT(*) as count FROM asset_tracking WHERE isActive = 'No'";
    $na = "SELECT COUNT(*) as count FROM asset_tracking WHERE isActive = 'NA'";

    $resYes = mysqli_query($conn, $yes);
    $resNo = mysqli_query($conn, $no);
    $resNa = mysqli_query($conn, $na);

    $yesCount = mysqli_fetch_assoc($resYes);
    $noCount = mysqli_fetch_assoc($resNo);
    $naCount = mysqli_fetch_assoc($resNa);

    // mysqli_close($conn);

    $widgetData['Asset_Tracking'] = array(
        'yes' => $yesCount['count'],
        'no' => $noCount['count'],
        'na' => $naCount['count']
    );
?>