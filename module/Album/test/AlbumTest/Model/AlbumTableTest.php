<?php
namespace AlbumTest\Model;

use Album\Model\AlbumTable;
use Album\Model\Album;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class AlbumTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllAlbums()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $albumTable = new AlbumTable($mockTableGateway);

        $this->assertSame($resultSet, $albumTable->fetchAll());
    }
}