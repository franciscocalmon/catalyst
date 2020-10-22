<?php
  $line='';
  for($i=1;$i<101;$i++){

    if(($i % 3 == 0) && ($i % 5 != 0)){
      $line .=  'foo, ';
    }elseif(($i % 5 == 0) && ($i % 3 !=0)){
        $line .=  'bar, ';
    }elseif( ($i % 5 == 0) && ($i % 3 == 0)){
        $line .=  'foobar, ';
    }else{
        $line .=  $i.', ';
    }

  }
  print rtrim($line,', ').PHP_EOL;

?>
