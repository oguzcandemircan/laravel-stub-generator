<?php

namespace OguzcanDemircan\LaravelStubGenerator;

use Exception;
use Illuminate\Support\Facades\Response;

class Stub
{   
    /**
     * File Data
     *
     * @var string
     */
    public $data;
    
    /**
     * Source file path
     *
     * @var string
     */
    public $source;
    
    /**
     * Target file path
     *
     * @var string
     */
    public $target; 

    /**
     * Parameters to be changed
     *
     * @var array
     */ 
    public $params = [];
    
    /**
     * Target file name
     *
     * @var string
     */
    public $file_name;

    /**
     * Source file name
     *
     * @var string
     */
    public $source_file;


    public function __construct()
    {
        $this->setSource(config('laravelstubgenerator.source_path'));
        $this->setTarget(config('laravelstubgenerator.target_path'));
    }

    /**
     * source file
     *
     * @param string $file
     * @return self
     */
    public function source(string $file)
    {   
        $this->source_file = "$file.stub";
        return  $this;
    }

    /**
     * params
     *
     * @param array $params
     * @return self
     */
    public function params(array $params)
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    /**
     * Param
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function param($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * 
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * set source path
     *
     * @param string $source
     * @return self
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * set target path
     *
     * @param string $target
     * @return selft
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * get source path
     *
     * @param string $file_name
     * @return string
     */
    public function getSource($file_name = null)
    {
        return $this->source.'/'.$file_name;
    }

    /**
     * get target path
     *
     * @param string $file_name
     * @return string
     */
    public function getTarget($file_name = null)
    {
        return $this->target.'/'.$file_name;
    }

    /**
     * get source file path
     *
     * @return string
     */
    public function getSourceFile()
    {
        return $this->source_file;
    }

    /**
     * Generate file
     *
     * @return self
     */
    public function generate()
    {   
        $file = $this->getSource($this->getSourceFile());
        $this->data = (new Generator($this))->generate();
        if(! $this->data) {
            throw new Exception("[$file] is empty !");
            
        }
        return $this;
    }

    /**
     * Save File
     *
     * @param string $file_name
     * @param boolean $force
     * @return self
     */
    public function save(string $file_name, bool $force = false)
    {   
        if(! $this->data) {
            return $this->generate()->save($file_name, $force);
        }

        if(! is_dir($this->getTarget())) {
            throw new Exception("[ {$this->getTarget()} ] directory not found");
        }

        $file = $this->getTarget($file_name);
        if(file_exists($file) && $force == false) {
            throw new Exception("[ $file ] allready exits!");
        }
        file_put_contents($file, $this->data);
        return $this;
    }

    /**
     * Download file
     *
     * @param string $file_name
     * @return Illuminate\Support\Facades\Response
     */
    public function download(string $file_name)
    {   
        if(! $this->data) {
            return $this->generate()->download($file_name);
        }

        $headers = [
            'Content-Disposition' => "attachment; filename=$file_name",
        ];
        return Response::make($this->data, 200, $headers);
    }
}