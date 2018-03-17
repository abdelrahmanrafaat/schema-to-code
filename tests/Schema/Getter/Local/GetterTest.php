<?php

namespace Tests\Schema\Getter\Local;

use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable;
use Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound;
use Abdelrahmanrafaat\SchemaToCode\Schema\Getters\Local\Getter;
use Abdelrahmanrafaat\SchemaToCode\Helpers\LocalFileHelpers;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;

class GetterTest extends TestCase
{
    public function setUp(): void
    {
        $this->fileSystemMock = $this->getMockBuilder(Filesystem::class)->getMock();
        parent::setUp();
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     *
     * @return void
     */
    public function testValidateThrowsNotFoundException(): void
    {
        $this->fileSystemMock
            ->method('exists')
            ->willReturn(false);

        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '');

        $this->expectException(NotFound::class);
        (new Getter($localFileHelpers))->validate();
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     *
     * @return void
     */
    public function testValidateThrowsNotFileException(): void
    {
        $this->fileSystemMock
            ->method('exists')
            ->willReturn(true);
        $this->fileSystemMock
            ->method('isFile')
            ->willReturn(false);

        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '');

        $this->expectException(NotFile::class);
        (new Getter($localFileHelpers))->validate();
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     *
     * @return void
     */
    public function testValidateThrowsNotReadableException(): void
    {
        $this->fileSystemMock
            ->method('exists')
            ->willReturn(true);
        $this->fileSystemMock
            ->method('isFile')
            ->willReturn(true);

        $this->fileSystemMock
            ->method('isReadable')
            ->willReturn(false);

        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '');

        $this->expectException(NotReadable::class);
        (new Getter($localFileHelpers))->validate();
    }

    /**
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\ExtensionNotTxt
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFile
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotFound
     * @throws \Abdelrahmanrafaat\SchemaToCode\Schema\Exceptions\Getters\Local\NotReadable
     *
     * @return void
     */
    public function testValidateThrowsNotTxtException(): void
    {
        $this->fileSystemMock
            ->method('exists')
            ->willReturn(true);
        $this->fileSystemMock
            ->method('isFile')
            ->willReturn(true);

        $this->fileSystemMock
            ->method('isReadable')
            ->willReturn(true);

        $this->fileSystemMock
            ->method('extension')
            ->willReturn('pdf');

        $localFileHelpers = new LocalFileHelpers($this->fileSystemMock, '');

        $this->expectException(ExtensionNotTxt::class);
        (new Getter($localFileHelpers))->validate();
    }

}