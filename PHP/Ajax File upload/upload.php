<?php
class file
{
    //file upload manager
    private $file = [];
    private $name = "";
    private $directory = "upload"; //default upload folder
    private $max_size = "5"; //default max file size to upload
    private $error = "";

    public function set($f)
    {
        if (is_array($f)) {
            $this->file = $f;
        } else {
            $this->error = "Invalid upload file format";
        }

        return $this;
    }

    public function name($n)
    {
        $this->name = $n;
        return $this;
    }

    public function max_size($s)
    {
        if (is_int($s) and $s > 0) {
            $this->max_size = $s * 1024 * 1024; //
        } else {
            $this->error = "Maximum upload file size must be integer and greater than zero";
        }

        return $this;
    }

    public function directory($d)
    {
        $this->directory = $d;
        return $this;
    }

    public function get_extension()
    {
        $this->fn = explode(".", $this->file['name']);
        $this->ext = end($this->fn);

        return $this->ext;
    }

    public function get_size()
    {
        return $this->file['size'];
    }

    public function get_dir()
    {
        if (!is_dir($this->directory)) {
            mkdir($this->directory);
        }

        return $this->directory;
    }

    public function get_name()
    {
        if (empty($this->name)) {
            $this->name = date("YmdHis");
        }

        $this->fc = $this->get_dir() . DIRECTORY_SEPARATOR . $this->name
            . "." . $this->get_extension();
        //check filename is exist or not
        if (file_exists($this->fc)) {
            //generate new name
            $this->i = 0;
            do {
                $this->name = $this->name . $this->i;
                $this->fc = $this->get_dir() . DIRECTORY_SEPARATOR
                    . $this->name . "." . $this->get_extension();
                $this->i++;
            } while (file_exists($this->fc));
        }

        return $this->name;
    }

    private function destination()
    {
        $this->d = "";
        $this->d .= $this->get_dir() . DIRECTORY_SEPARATOR;
        $this->d .= $this->get_name();
        $this->d .= "." . $this->get_extension();

        return $this->d;
    }

    public function upload()
    {
        //check file size 
        if ($this->max_size < $this->get_size()) {
            $this->error = "File size is "
                . round($this->get_size() / (1024 * 1024), 2)
                . "MB, maximum to upload is "
                . round($this->max_size / (1024 * 1024), 2)
                . "MB.";
        }

        if (empty($this->error)) {
            return move_uploaded_file($this->file['tmp_name'], $this->destination());
        } else {
            return FALSE;
        }
    }

    public function report()
    {
        return $this->error;
    }
}
