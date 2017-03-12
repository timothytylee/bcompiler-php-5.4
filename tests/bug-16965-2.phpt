--TEST--
Bug #16965 - Segfault on inherited method call
--SKIPIF--
<?php
  if (version_compare(PHP_VERSION, '5.2.0', '<')) die("skip PHP 5.2 or later is required");
  $dir = dirname(__FILE__).'/';
  require($dir.'test-helper.php');
  make_bytecode($dir.'bug-16965-2.phpt', $dir.'bug-16965-2.phb');
?>
--FILE--
<?php
include("bug-16965-2.phb");
unlink(dirname(__FILE__).'/bug-16965-2.phb');
exit;
--CODE--
class QQQ
{
    function __construct()
    {
        $this->i();
    }
    function i()
    {}
};

class QQQ1 extends QQQ
{
    function q($addrs, $listenport)
    {
        if (is_string($addrs)) {
            echo('.');
            $addrs = explode(',', $addrs);
            echo('?');
        }

        echo('!');
    }
};

class QQQ2 extends QQQ1
{
    function i()
    {
        $this->q('test', 'whatever');
    }
};

$m = new QQQ2;
--EXPECT--
.?!
