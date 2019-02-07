<?php

namespace OguzcanDemircan\LaravelStubGenerator;

use Exception;
// use Illuminate\Support\Collection;

class Generator  
{       
    // public $data;
    
    // public $stub;
    
    // public $source;

    public function __construct($instance)
    {
        $this->instance = $instance;
        $this->params = $this->instance->getParams();
    }
    
    public function generate()
    {
        $dir = $this->instance->getSource();
        $file = $this->instance->getSource($this->instance->getSourceFile());   

        if(! is_dir($dir)) {
            throw new Exception("[$dir] directory not found");
        }
        if(! file_exists($file)) {
            throw new Exception("[$file] file not found");
        }

        $data = file_get_contents($file);
        return strtr($data, $this->getParams());
    }

    public function getParams()
    {    
        return $this->params;
        // return (new Collection($this->params))->map(function ($value, $key) {
        //    
        // })->toArray();
    }

    // public function __construct(string $stub = null, string $source = null, array $data = null)
    // {
    //     $this->target = $target;
    //     $this->source = $source;
    //     $this->data = $data;
    // }

    // public function generate()
    // {
    //     return strtr(file_get_contents($this->source), $this->data);
    // }

}