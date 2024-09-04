<?php 

// ===========AllCompany counts==
$comp_count=$this->Admin_dashboard->getAllCompanyCount();
// ==========All sales==count==
$sales_count=$this->Admin_dashboard->getAllCompanySalesCount();

// =========INR Revenue============
$getInrRevenue=$this->Admin_dashboard->getInrRevenue();
$inrRevenue=$getInrRevenue[0]['cost'];

// =============USD ===Revenue==================
$getUsdRevenue=$this->Admin_dashboard->getUsdRevenue();
$usdRevenue=$getUsdRevenue[0]['usd_cost'];

// ============Get==all==order===
$getAllOrders=$this->Admin_dashboard->getAllOrders();


      date_default_timezone_set('Asia/Kolkata');
    $cdate=date('y-m-d');

// ===get==all ==today ===Orders===
$getTodayOrders=$this->Admin_dashboard->getTodayOrders($cdate);

// =========Get==clients counts====
$getClientsCount=$this->Admin_dashboard->getClientsCount();

// ========Get==Employee==Count==
$getEmpCount=$this->Admin_dashboard->getEmpCount();


// =========Charges====count==
$getChargesCount=$this->Admin_dashboard->getChargesCount();


// =========get==full=company==report==count==
$getFullComReportCount=$this->Admin_dashboard->getFullComReportCount();



// =========get==Track =company==report==count==
$gettrackCount=$this->Admin_dashboard->gettrackCount();


// =========get== Ticket Counts
$getTicketCounts=$this->Admin_dashboard->getTicketCounts();



// =========get== Waller user Counts
$getWalletUserCount=$this->Admin_dashboard->getWalletUserCount();





// ===============Wallet===function===


   $allWallelData=$this->Admin_dashboard->getWalletUserData();
   $getWalletUserReq=$this->Admin_dashboard->getWalletUserReq();

   $getCreditsvalue=$this->Admin_dashboard->getCreditsvalue();


   // ===============================User===functions===

      $getAllusers=$this->Admin_dashboard->getAllusers();
      $getProductionUsers=$this->Admin_dashboard->getProductionUsers();



 ?>