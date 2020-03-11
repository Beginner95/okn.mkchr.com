<?php

namespace App\Http;


class UploadFile
{
    public $file;
    public $fileName;
    public $fileExtension;

    public function uploadFile($currentFile)
    {
        $this->file = request()->file('file');
        $this->fileExtension = $this->file->getClientOriginalExtension();
        $this->fileName = strtolower($this->file->getClientOriginalName());

        if ($this->file->isValid()) {
            $this->deleteCurrentFile($currentFile);
            return $this->saveFile();
        }
        return null;
    }

    private function generateFilename()
    {
        if ($this->fileExists($this->fileName) === true) {
            $this->fileName = ('1_' . $this->fileName);
            return $this->generateFilename();
        }
        return $this->fileName;
    }

    public function deleteCurrentFile($currentFile)
    {
        if ($this->fileExists($currentFile) === true) {
            unlink($this->getFolder() . $currentFile);
        }
    }

    private function fileExists($currentFile)
    {
        if (!empty($currentFile) && $currentFile != null) {
            return file_exists($this->getFolder() . $currentFile);
        }
    }

    private function getFolder()
    {
        return public_path() . '/files/';
    }

    private function saveFile()
    {
        $this->file->move($this->getFolder(), $this->generateFilename());
        return $this->fileName;
    }
}