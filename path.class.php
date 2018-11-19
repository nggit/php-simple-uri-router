<?php

# Path class
# A Simple URI Router
# (c) 20161228 nggit

class Path {

    public $path = array(), $segment_separator, $after = array();

    public function __construct($path = null, $separator = '/') {
        $this->parse($path, $separator);
    }

    public function parse($path, $separator = '/') {
        static $path_str;
        if ($path !== $path_str) {
            $this->path = array_filter(explode($separator, $path), 'strlen');
        }
        $path_str = $path;
        $this->segment_separator = $separator;
        return $this;
    }

    public function first($tok = '?&') {
        return strtok(reset($this->path), $tok);
    }

    public function pos($path_segment) {
        return array_search($path_segment, $this->path);
    }

    public function after($path_segment, $length = 1, $tok = '?&') { // $length = null means array_slice with length omitted, the sequence will have everything from offset up until the end of the array: http://php.net/manual/en/function.array-slice.php
        $offset = $this->pos($path_segment);
        if ($offset === false) {
            return null;
        }
        $this->after = array_slice($this->path, $offset + 1, $length);
        return strtok(implode($this->segment_separator, $this->after), $tok);
    }

}
