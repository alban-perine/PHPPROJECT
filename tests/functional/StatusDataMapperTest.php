<?php


class StatusDataMapperTest extends TestCase
{
    private $con;

    public function setUp()
    {
        $this->con = new \Model\Connection('sqlite::memory:',"uframework", "localhost", "uframework", "passw0rd");
    }

    public function testPersist()
    {
        $mapper = new \Model\StatusDataMapper($this->con);

        $statusDataMapper = new StatusDataMapper($this->connection);
        $date = new DateTime();
        $status = new \Model\Status(99,"Alban", "Message du test donctionnel", new DateTime());

        $this->assertTrue($statusDataMapper->persist($status));

    }
}