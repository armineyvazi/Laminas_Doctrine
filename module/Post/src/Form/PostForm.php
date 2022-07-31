<?php 


namespace Post\Form;

use Laminas\Form\Form;
class PostForm extends Form
{

    public function __construct()
    {
          // We will ignore the name provided to the constructor
          parent::__construct('post');

          $this->add([
              'name' => 'id',
              'type' => 'hidden',
          ]);
          $this->add([
              'name' => 'title',
              'type' => 'text',
              'options' => [
                  'label' => 'Title',
              ],
              'attributes'=>[
                'class'=>'form-control',#styli
                'size'=>40,
                'maxlength'=>25,
                'title'=>'Title must consict of alphanumeric Charectors only',
                'placeholder'=>'Enter Your Title',
            ]
          ]);
          $this->add([
              'name' => 'category',
              'type' => 'text',
              'options' => [
                  'label' => 'Category',
              ],
              'attributes'=>[
                'class'=>'form-control',#styli
                'size'=>40,
                'maxlength'=>25,
                'title'=>'Username must consict of alphanumeric Charectors only',
                'placeholder'=>'Enter Your Category',
            ]
          ]);
          $this->add([
            'name' => 'description',
            'type' => 'text',
            'options' => [
                'label' => 'description',
            ],
            'attributes'=>[
                'class'=>'form-control',#styli
                'size'=>40,
                'maxlength'=>25,
                'title'=>'Discription must consict of alphanumeric Charectors only',
                'placeholder'=>'Enter Your description',
            ]
        ]);
          $this->add([
              'name' => 'submit',
              'type' => 'submit',
              'attributes' => [
                  'value' => 'Go',
                  'id'    => 'submitbutton',
              ],
          ]);
    }
}