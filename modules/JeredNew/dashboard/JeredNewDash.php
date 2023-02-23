<?php
    $overLicensedQuery = "SELECT COUNT(*) as count FROM jerednew WHERE complianceStatus = 'Over Licensed'";
    $underLicensedQuery = "SELECT COUNT(*) as count FROM jerednew WHERE complianceStatus = 'Under Licensed'";
    $inComplianceQuery = "SELECT COUNT(*) as count FROM jerednew WHERE complianceStatus = 'In Compliance'";

    $resOverLicensed = mysqli_query($conn, $overLicensedQuery);
    $resUnderLicensed = mysqli_query($conn, $underLicensedQuery);
    $resInCompliance = mysqli_query($conn, $inComplianceQuery);

    $overLicensedCount = mysqli_fetch_assoc($resOverLicensed);
    $underLicensedCount = mysqli_fetch_assoc($resUnderLicensed);
    $inComplianceCount = mysqli_fetch_assoc($resInCompliance);

    // mysqli_close($conn);

    $widgetData['JeredNew'] = array(
        'overLicensed' => $overLicensedCount['count'],
        'underLicensed' => $underLicensedCount['count'],
        'inCompliance' => $inComplianceCount['count']
    );
	
?>