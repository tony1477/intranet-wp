<?php 
$session = session();
?>
columnDefs: [
    { targets: [<?=$session->get('lang') == 'en' ? '2' : '3'?>], visible: false},
]