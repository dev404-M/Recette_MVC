<?php
ob_start();
?>
<body>
<section class="filtered">
    <p>dffdf</p>
</section>
</body>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
