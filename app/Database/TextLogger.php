<?php

require_once 'iLogger.php';

class TextLogger implements iLogger
{
    private $filePath;

    public function log($message)
    {
        file_put_contents($this->filePath, $this->getUpdatedContent($message));
    }

    private function getTime()
    {
        date_default_timezone_set('Pacific/Auckland');
        return date("M,d,Y h:i:s A");
    }

    private function getUpdatedContent($newContent)
    {
        $content = $this->getTime() . "\t\t" . $newContent;
        return $this->getFileContent() ."\n". $content;
    }

    private function getFileContent()
    {
        return file_get_contents($this->filePath);
    }

    public function __set($name, $value)
    {
        if (file_exists($value)) {
            $this->$name = $value;
        }
    }
}

//$t = new TextLogger();
//$t->filePath = './log.txt';
//$t->log('Hello World');