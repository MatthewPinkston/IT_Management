<?php
    $overLicensedQuery = "SELECT COUNT(*) as count FROM license_tracking WHERE LicenseStatus = 'Over Licensed'";
    $underLicensedQuery = "SELECT COUNT(*) as count FROM license_tracking WHERE LicenseStatus = 'Under Licensed'";
    $inComplianceQuery = "SELECT COUNT(*) as count FROM license_tracking WHERE LicenseStatus = 'In Compliance'";

    $resOverLicensed = mysqli_query($conn, $overLicensedQuery);
    $resUnderLicensed = mysqli_query($conn, $underLicensedQuery);
    $resInCompliance = mysqli_query($conn, $inComplianceQuery);

    $overLicensedCount = mysqli_fetch_assoc($resOverLicensed);
    $underLicensedCount = mysqli_fetch_assoc($resUnderLicensed);
    $inComplianceCount = mysqli_fetch_assoc($resInCompliance);

    // mysqli_close($conn);

    $widgetData['License_Tracking'] = array(
        'overLicensed' => $overLicensedCount['count'],
        'underLicensed' => $underLicensedCount['count'],
        'inCompliance' => $inComplianceCount['count']
    );
	
?>