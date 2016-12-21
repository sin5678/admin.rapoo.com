<?php
/**
 * 业务基类
 */
namespace App\Services;

use App\Services\AbstractService;
use App\Services\ActionLog\Mark;

class BaseService extends AbstractService
{
	/**
     * 模型
     * 
     * @var object
     */
    protected $model;
    /**
     * 数据
     * 
     * @var object
     */
    protected $insertData = [];
    /**
     * 数据
     * 
     * @var object
     */
    protected $updateData = [];
    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取模型
     */
    public function getModel(){}

    /**
     * 设置模型
     */
    public function setModel($model)
    {
    	if(!isset($this->model)){
    		$this->model = $model;
    	}
    	return $this->model;
    }

    /**
     * 获取模型主键
     */
    public function getModelPrimaryKey()
    {
        return $this->getModel()->primaryKey;
    }

    /**
     * 获取新增数据
     */
    public function getInsertData()
    {
    	return $this->insertData;
    }

    /**
     * 设置新增数据
     */
    public function setInsertData($insertData)
    {
    	$this->insertData = $this->getModel()->fillInsertData($insertData);
    }

    /**
     * 获取编辑数据
     */
    public function getUpdateData()
    {
    	return $this->updateData;
    }

    /**
     * 设置编辑数据
     */
    public function setUpdateData($updateData)
    {
    	$this->updateData = $this->getModel()->fillEditData($updateData);
    }

    /**
     * 保存数据
     */
    public function storeData($data = array())
    {
    	
        if(!$this->getModel()->create($data)){
            return $this->setErrorMsg(self::ADD_ERROR);
        }
        return true;
    }

    /**
     * 编辑数据
     */
    public function updateData($id, $data = array())
    {
    	$oldObject = clone($object = $this->getModel()->find($id));
    	if($object->update($data)) return $oldObject->toArray();
    	return $this->setErrorMsg(self::UPDATE_ERROR);
    }

    /**
     * 判断数据提交状态 新增或者编辑 根据主键自动判断
     */
    public function getActionData($id = false)
    {
        return $id ? $this->getUpdateData() : $this->getInsertData();
    }

    /**
     * 判断数据提交状态 设置数据
     */
    public function setActionData(array $data, $id)
    {
        return $id ? $this->setUpdateData($data) : $this->setInsertData($data);
    }

    /**
     * 新增或者编辑 数据处理过程
     */
    public function processData(array $data, $id = false)
    {
        $this->setActionData($data, $id);
        $data = $this->getActionData($id);
        return $id ? $this->updateData($id, $data) : $this->storeData($data);
    }

    /**
     * 删除数据过程
     */
    public function processDeleteData($id)
    {
        if(!$id) return $this->setErrorMsg(self::NO_DATA_SELECTED);
        if(!is_array($id) && strpos($id, ',') === false){
            $idArr = [intval($id)];
        } else {
            $idArr = is_array($id) ? $id : (strpos($id,',') !== false ? explode(',',$id) : []);
        }
        $query = $this->getModel()->whereIn($this->getModelPrimaryKey(), $idArr);
        $objects = $query->get();
        if($query->delete()) return $objects;
        return $this->setErrorMsg('error');
    }

}
