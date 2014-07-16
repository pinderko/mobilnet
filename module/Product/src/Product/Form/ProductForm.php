<?php
/**
 * Created by PhpStorm.
 * User: Adik
 * Date: 16.7.2014
 * Time: 10:27
 */

namespace Product\Form;

use Zend\Form\Form;


class ProductForm extends Form{

    public function __construct($name = null)
    {
        parent::__construct('product');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'nazov',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Nazov',
            ),
        ));
        $this->add(array(
            'name' => 'kod',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Kod',
            ),
        ));
        $this->add(array(
            'name' => 'sklad',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Množstvo',
            ),
        ));
        $this->add(array(
            'name' => 'ean',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'EAN',
            ),
        ));
        $this->add(array(
            'name' => 'cena',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Cena',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
} 