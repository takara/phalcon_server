<?php

use Phalcon\Di;
use Phalcon\Test\UnitTestCase as PhalconTestCase;

abstract class UnitTestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;



    public function setUp()
    {
        parent::setUp();

        // テスト中に必要になる追加のサービスを読み込み
        $di = Di::getDefault();

        // ここで必要なDIコンポーネントを取得する。config があるなら、それを parent に渡すことを忘れずに

        $this->setDi($di);

        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError(
                "Please run parent::setUp()."
            );
        }
    }
}
