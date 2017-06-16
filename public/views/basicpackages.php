<?php 
$title = 'Basic Package';
$items = [];
if($_GET['type'] =='bp'){
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","100 Programs","100 Prayer Cards/Book Markers",
        "TVJ's Death Announcement",
    ];
}
else if($_GET['type'] =='bpp'){
    $title = 'Basic Personal';
    $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","SingleVault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement",
    ];
}
else if($_GET['type'] =='bpd'){
     $title = 'Basic Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Vault 1/2 Double (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons"
    ];
}

else if($_GET['type'] =='bpdp'){
     $title = 'Basic Package - Deluxe Personal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons"
    ];
}
else if($_GET['type'] =='bps'){
     $title = 'Basic Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons", "Bands for Set UP"
    ];
}
?>

 <div class="container">
	<div class="row">
	<table class=
    "plan table table-hover table-bordered table-striped text-center">
        <thead>
            <tr>
                <th colspan="6">
                    <h2>Features</h2>
                </th>

                <th colspan="2">
                     <h5> Basic Package </h5>
                </th>

                <th colspan="2">
                    <h5>Basic Package - Personal</h5>
                </th>

                <th colspan="2">
                    <h5>Basic Package - Deluxe</h5>
                </th>

                
                <th colspan="2">
                    <h5>Basic Package - Deluxe Personal</h5>
                </th>

                
                <th colspan="2">
                    <h5>Basic Package - Super</h5>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="6">NUMBER OF
                LICENSES</td>

                <td colspan="2">1 LICENSE</td>

                <td colspan="2">1 LICENSE</td>

                <td colspan="2">CUSTOM TEAM
                SIZE</td>
            </tr>

            <tr>
                <td colspan="6">UNLIMITED MEETINGS AND ATTENDEES</td>

                <td colspan="2">4 MEETINGS PER MONTH</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">STREAMLINED MEETING PLANNING FUNCTION</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">CLONE PREVIOUS MEETINGS FOR RAPID PLANNING</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">AUTOMATED AGENDA CREATION AND CALENDAR INVITE
                DISTRIBUTION</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">INTEGRATION WITH EVERNOTE, DROPBOX AND GOOGLE
                DOCS</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">STREAMLINED MEETING EXECUTION FUNCTION</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">EASILY CAPTURE KEY MEETING INFORMATIN (NOTES,
                ACTION ITEMS, DECISIONS)</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">AUTOMATED CREATION AND DISTRIBUTION OF MEETING
                SUMMARY REPORT</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">BRANDED MEETING AGENDAS AND SUMMARY REPORTS
                (PDF)</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">CLOUD SYNC AND ARCHIVE OF MEETING DATA</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">FULL ENCRYPTION OF DATA IN TRANSIT</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">ATTENDEE DASHBOARD FOR PERSONAL VIEW OF MEETING
                INFO & ASSIGNMENTS</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">AUTOMATED EMAIL DISTRIBUTION OF MEETING
                ASSIGNMENTS</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">AUTOMATED WORKFLOW TO CAPTURE STATUS UPDATES
                FOR ASSIGNMENTS</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">ADVANCED FREE FORM TEXT SEARCH ACROSS ALL
                MEETING DATA</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">PROJECT LEVEL MEETING ANALYTICS WITH OVER 20
                KEY METRICS</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">EASILY TAG & INFORM OUTSIDE PARTIES ON KEY
                MEETING INFORMATION</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">COMPLETE ONLINE ACCESS TO ALL MEETING DATA</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">SECURE BACKUP AND RESTORE FROM CLOUD</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>

            <tr>
                <td colspan="6">PREMIUM SUPPRORT
                ACCESS TO ASSIST WITH QUESTIONS & ENHANCEMENT REQUESTS</td>

                <td colspan="2">✗</td>

                <td colspan="2">✔</td>

                <td colspan="2">✔</td>
            </tr>
        </tbody>
    </table>