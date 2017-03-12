--TEST--
Bug #16965 - Segfault on interface code
--SKIPIF--
<?php
  if (version_compare(PHP_VERSION, '5.2.0', '<')) die("skip PHP 5.2 or later is required");
  $dir = dirname(__FILE__).'/';
  require($dir.'test-helper.php');
  make_bytecode($dir.'bug-16965-1.phpt', $dir.'bug-16965-1.phb');
?>
--FILE--
<?php
include("bug-16965-1.phb");
unlink(dirname(__FILE__).'/bug-16965-1.phb');
exit;
--CODE--
class Blargh implements Countable {

  public function count() {
      static $count = 0;
      return ++$count;
  }
}

$counter = new Blargh;

for($i=0; $i<10; ++$i) {
    echo "I have been count()ed " . count($counter) . " times\n";
}
--EXPECT--
I have been count()ed 1 times
I have been count()ed 2 times
I have been count()ed 3 times
I have been count()ed 4 times
I have been count()ed 5 times
I have been count()ed 6 times
I have been count()ed 7 times
I have been count()ed 8 times
I have been count()ed 9 times
I have been count()ed 10 times
