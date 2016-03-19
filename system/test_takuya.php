<?php

require_once('./require.php');

$inst = new SYS_Genre();
// $result = $inst->addGenre("testMain", "testSub");
//$post = array('genreMain'=>'main', 'genreSub'=>'sub');
$result = $inst->getAllGenre();

echo "Debug success."."</br>";
echo "result: ";
print_r($result);

