<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    /**
     * construct
     * call function setModel
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get the corresponding model
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all
     * @return object
     */
    public function getAll()
    {
         $datModel = $this->model->all();
         return $datModel;
    }

    /**
     * Get one
     * @param $id
     * @return object
     */
    public function find($param)
    {
        if(is_numeric($param)){
            $result = $this->model::where('id','=', $param)
            ->get();
        }
        else{
            $result  = $this->model::where('title','=', $param)
            ->get();
        }

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return boolean
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return boolean
     */
    public function update($id, $attributes = [])
    {
        $result = $this->model::find($id);
        if ($result) {
             $result->update($attributes);
              return $result;
        }
        return false;
    }

    /**
     * Delete
     * @param $id
     * @return boolean
     */
    public function destroy($id)
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }
}
