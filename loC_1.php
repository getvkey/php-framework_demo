<?php

/**
 * 假设应用程序有储存需求，若直接在高层的应用程序中调用低层模块API，导致应用程序对低层模块产生依赖。
 * 假设程序要移植到另一个平台，而该平台使用USB磁盘作为存储介质，则这个程序无法直接重用，
 * 必须加以修改才行。本例由于低层变化导致高层也跟着变化，不好的设计。
 */
/**
 * 高层
 */
// class Business
// {
//     private $writer;

//     public function __construct()
//     {
//         $this->writer = new FloppyWriter();
//     }

//     public function save()
//     {
//         $this->writer->saveToFloppy();
//     }
// }

// /**
//  * 低层，软盘存储
//  */
// class FloppyWriter
// {
//     public function saveToFloppy()
//     {
//         echo __METHOD__;
//     }
// }

// $biz = new Business();
// $biz->save(); // FloppyWriter::saveToFloppy


/**
 * 程序不应该依赖于具体的实现，而是要依赖抽像的接口
 */
/**
 * 接口
 */
interface IDeviceWriter
{
    public function saveToDevice();
}

/**
 * 高层
 */
class Business
{
    /**
     * @var IDeviceWriter
     */
    private $writer;

    /**
     * @param IDeviceWriter $writer
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }

    public function save()
    {
        $this->writer->saveToDevice();
    }
}

/**
 * 低层，软盘存储
 */
class FloppyWriter implements IDeviceWriter
{

    public function saveToDevice()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

/**
 * 低层，USB盘存储
 */
class UsbDiskWriter implements IDeviceWriter
{

    public function saveToDevice()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

$biz = new Business();
$biz->setWriter(new UsbDiskWriter());
$biz->save(); // UsbDiskWriter::saveToDevice

$biz->setWriter(new FloppyWriter());
$biz->save(); // FloppyWriter::saveToDevice
