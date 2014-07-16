<?php
/**
 * Created by PhpStorm.
 * User: Adik
 * Date: 15.7.2014
 * Time: 15:47
 */

namespace Product\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class ProductTable
{
    protected $tableGateway;
    protected $adapter;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->adapter = $this->tableGateway->getAdapter();
    }

    public function fetchAll($paginated=false)
    {
        if($paginated) {
            // create a new Select object for the table tovar
            $select = new Select('product');
            // create a new result set based on the Product entity
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Product());
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
            // our configured select object
                $select,
                // the adapter to run it against
                $this->tableGateway->getAdapter(),
                // the result set to hydrate
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getProduct($id)
    {
        $id = (int)$id;
/*
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from('tovar');
//        $select->columns(array('nazov' => 'nazov_sk'));
        $select->where(array('id' => $id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $this->adapter->query($selectString, $this->adapter);

        print_r($results);
        print_r($selectString);
//        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
*/

        /*
        $tovarTable = new TableGateway('tovar', $this->adapter);
        $rowset = $tovarTable->select(array('id' => $id));
        */
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("Could not find product with id $id");
        }
        return $row;

    }

    public function deleteProduct($id)
    {
        $id = (int)$id;
        $this->tableGateway->delete(array('id'=>$id));
    }

    public function editProduct($product)
    {
        $data = array(
            'nazov' => $product->nazov,
            'kod' => $product->kod,
            'ean' => $product->ean,
            'sklad' => $product->sklad,
            'cena'  => $product->cena
        );

        $id = (int)$product->id;
        if($this->getProduct($id)){
//            $tovarTable = new TableGateway('tovar', $this->tableGateway->getAdapter());
//            $result = $tovarTable->update($data,array('id'=>$id));

            $this->tableGateway->update($data, array('id' => $id));
        }else{
            throw new \Exception("Product doesn't exist yet.");
        }
    }
}
