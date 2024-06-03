<?php

namespace App\Repository;

use App\Localization\LocalizationInterface;
use App\Models\BaseModel;
use App\Utils\imageUploader;
use DB;

abstract class BaseRepository
{
    public const MODEL_CLASS = BaseModel::class;
    /** @var BaseModel */
    protected $model;
    protected $path;


    public function __construct()
    {
        $modelClass = static::MODEL_CLASS;
        $this->model = new $modelClass();
        $this->path = $this->model->getTable();
    }

    public function datatableView()
    {
        return $this->model->datatable();
    }

    public function datatable()
    {
        return $this->model
            ->select($this->model->datatable());
    }

    public function change_status($id, $status)
    {
        $data = ['status' => $status];
        $this->model->where(['id' => $id])->update($data);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getParentRepository()
    {
        return null;
    }

    public function detail($id)
    {
        return $this->model->whereKey($id);
    }

    public function all()
    {
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }


    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->_create($data);
        });
    }

    public function update(array $data, $id)
    {
        $resource = $this->model->findOrFail($id);
        return DB::transaction(function () use ($data, $resource) {
            return $this->_update($data, $resource);
        });
    }

    public function getTableColumnAndTypeList()
    {
        return $this->model->getTableColumnAndTypeList();
    }

    public function delete($id)
    {
        $this->model->where("id", $id)->update(["status" => 2]);
    }

    public function restore($id)
    {
        $this->model->where(array("id" => $id))->update(["status" => 1]);
    }

    public function reorder($values)
    {
        $array = json_decode($values["values"]);
        for ($i = 0; $i < count($array); $i++) {
            $oldEntity = $this->model->find($array[$i][0]);
            $newEntity = $this->model->find($array[$i][1]);
            $oldEntity->moveAfter($newEntity);
        }
        return "";
    }

    protected function _create(array $data)
    {
        $fillable = $this->model->fillable;
        $insert = [];
        foreach ($fillable as $key => $value) {
            if (array_key_exists($value, $data)) {
                $insert[$value] = $data[$value];
            }
        }
        if (in_array("created_by", $fillable)) {
            $insert["created_by"] = 1;
        }

        if ($this->model instanceof LocalizationInterface) {

            $localizations = $data['localizations'];
            unset($data['localizations']);
            $model = $this->model->create($insert);
            $locClass = $this->model::LOCALIZATION_CLASS;
            $locFields = $this->model->getLocalizationFields();
            foreach ($localizations as $localization) {
                $loc = new $locClass();
                foreach ($locFields as $column) {
                    if (array_key_exists($column, $localization)) {
                        $loc->{$column} = $localization[$column];
                    }
                }
                $loc->parent()->associate($model);
                $loc->save();
            }
        } else {
            $model = $this->model->create($insert);
        }
        $this->_updateImage($data, $model);
        $this->_createImages($data, $model);
        return "";
    }

    protected function _updateImage($data, $resource)
    {
        if (array_key_exists("path", $data) && ($data["path"] != null)) {
            $path = imageUploader::upload_s3($resource, $data["path"], $this->path, "", config("app.folder"));
            $resource->update([
                "path" => $path
            ]);
        }
    }

    protected function upload($resource, $file, $path, $type = "")
    {
        return imageUploader::upload_s3($resource, $file, $path, $type, config("app.folder"));
    }

    protected function _update(array $data, $resource)
    {
        if ($this->model instanceof LocalizationInterface) {
            $localizations = $data['localizations'];
            unset($data['localizations']);
            $dbLocalizations = $resource->localizations->keyBy('id');

            $locClass = $resource::LOCALIZATION_CLASS;
            $locFields = $resource->getLocalizationFields();
            foreach ($localizations as $localization) {
                if ($localization['id'] && isset($dbLocalizations[$localization['id']])) {
                    $dbLocalizations[$localization['id']]->update($localization);
                } else {
                    $loc = new $locClass();
                    foreach ($locFields as $column) {
                        $loc->{$column} = $localization[$column];
                    }
                    $loc->language_id = $localization['language_id'];
                    $loc->save();
                }
            }
        }
        $fillable = $this->model->fillable;
        foreach ($fillable as $key => $value) {
            if (array_key_exists($value, $data)) {
                $update[$value] = $data[$value];
            }
        }
        if (in_array("updated_by", $fillable)) {
            $update["updated_by"] = 1;
        }
        $resource->update($update);
        $this->_updateImage($data, $resource);
        $this->_createImages($data, $resource);
    }

    protected function _createImages($images, $resource)
    {
    }
}
