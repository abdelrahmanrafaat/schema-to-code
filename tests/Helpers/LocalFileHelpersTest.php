<?php

namespace Tests\Helpers;

use Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers;
use Orchestra\Testbench\TestCase;
use Illuminate\Filesystem\Filesystem;

/**
 * Class LocalFileHelpersTest
 *
 * @package Tests\Helpers
 */
class LocalFileHelpersTest extends TestCase
{
    /**
     * @var MockObject
     */
    protected $fileSystemMock;

    public function setUp(): void
    {
        $this->fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testFullPath(): void
    {
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt/');

        $this->assertEquals($localFileHelpers->path, base_path() . '/' . 'app/schema.txt');
    }

    /**
     * @return void
     */
    public function testGetContents(): void
    {
        $this->fileSystemMock->method('get')->willReturn('content');
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->assertEquals($localFileHelpers->getContents(), 'content');
    }

    /**
     * @return void
     */
    public function testExists(): void
    {
        $this->fileSystemMock
            ->expects($this->at(0))
            ->method('exists')
            ->willReturn(true);
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->fileSystemMock
            ->expects($this->at(1))
            ->method('exists')
            ->willReturn(false);
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->assertTrue($localFileHelpers->exists());
        $this->assertFalse($localFileHelpers->exists());
    }

    /**
     * @return void
     */
    public function testIsFile(): void
    {
        $this->fileSystemMock
            ->expects($this->at(0))
            ->method('isFile')
            ->willReturn(true);
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->fileSystemMock
            ->expects($this->at(1))
            ->method('isFile')
            ->willReturn(false);
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->assertTrue($localFileHelpers->isFile());
        $this->assertFalse($localFileHelpers->isFile());
    }

    /**
     * @return void
     */
    public function testIsReadable(): void
    {
        $this->fileSystemMock
            ->expects($this->at(0))
            ->method('isReadable')
            ->willReturn(true);
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->fileSystemMock
            ->expects($this->at(1))
            ->method('isReadable')
            ->willReturn(false);
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->assertTrue($localFileHelpers->isReadable());
        $this->assertFalse($localFileHelpers->isReadable());
    }

    /**
     * @return void
     */
    public function testIsTxt(): void
    {
        $this->fileSystemMock
            ->expects($this->at(0))
            ->method('extension')
            ->willReturn('txt');
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->fileSystemMock
            ->expects($this->at(1))
            ->method('extension')
            ->willReturn('pdf');
        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '/app/schema.txt');

        $this->assertTrue($localFileHelpers->isTxt());
        $this->assertFalse($localFileHelpers->isTxt());
    }

}