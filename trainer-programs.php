<?php
$currentPage = "trainer-programs";
include 'common/header.php';
$ttc_id = '';
if (isset($_GET["id"])) {
    $ttc_id = $_GET["id"];
} else {
    echo '<script>location.href = "index.php";</script>';
}
$sql    = "SELECT * FROM product where id = $ttc_id AND type = 'ttc'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<section id="about_harsha"><div class="about_innr"><div class="container-fluid"><div class="row"><div class="col-xs-12 about_text"><h2 class="heading1 colr_h"><h2 class="heading1 colr_h">' . $row['title'] . '</h2><h3 class="heading2">Syllabus</h3>';
        $plnk = str_replace(' ', '-', strtolower($row['menu_text']));
        echo '<p><img src="assets/images/' . $plnk . '.jpg" class="floating_thumbcntr" alt="' . $row["title"] . ' image slide"></p>';
        echo $row['html_template'];
        echo '</div></div></div></div></section>';
        include 'common/footer.php';
        echo '</body></html>';
    }
} else {
    echo '<script>location.href = "index.php";</script>';
}
?>