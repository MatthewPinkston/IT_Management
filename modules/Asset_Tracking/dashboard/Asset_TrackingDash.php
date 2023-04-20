<?php
    $computers = "SELECT COUNT(*) as count FROM asset_tracking WHERE type = 'Computers'";
    $io = "SELECT COUNT(*) as count FROM asset_tracking WHERE type = 'IO'";
    $storage = "SELECT COUNT(*) as count FROM asset_tracking WHERE type = 'Storage'";

    $rescomputers = mysqli_query($conn, $computers);
    $resio = mysqli_query($conn, $io);
    $resstorage = mysqli_query($conn, $storage);

    $computersCount = mysqli_fetch_assoc($rescomputers);
    $ioCount = mysqli_fetch_assoc($resio);
    $storageCount = mysqli_fetch_assoc($resstorage);

    // mysqli_close($conn);

    $widgetData['Asset_Tracking'] = array(
        'computers' => $computersCount['count'],
        'io' => $ioCount['count'],
        'storage' => $storageCount['count']
    );
	
?>