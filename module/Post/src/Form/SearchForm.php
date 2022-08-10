<?php



namespace Post\Form;

use Laminas\Form\Form;
use Laminas\Filter\StripTags;
use Laminas\Filter\StringTrim;
use Laminas\Validator\NotEmpty;
use Laminas\Filter\StringToLower;
use Laminas\Filter\StripNewlines;
use Laminas\Validator\StringLength;
use Laminas\InputFilter\InputFilter;



class SearchForm extends Form
{
    public function __construct()
    {
        // We will ignore the name provided to the constructor
        parent::__construct('post');
        $this->addElement();
        $this->validator();
    }
    public function addElement()
    {
        $this->add([
            'name' => 'search',
            'type' => 'text',
            'options' => [
                'label' => 'Search',
            ],
            'attributes' => [
                'class' => 'form-control form-control mr-sm-2 w-50', #styli
                'id'=>'search',
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Title must consict of alphanumeric Charectors only',
                'placeholder' => 'Search',
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'search',
                'class'=>'btn btn-info my-2 my-sm-0',
                'id' => 'submitbutton',
            ],
        ]);
    }
    private function validator()
    {
        $inputFilter = new InputFilter;
        $this->setInputFilter($inputFilter);
        $inputFilter->add([
            'name' => 'search',
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StringToLower::class],
                ['name' => StripTags::class],
                ['name' => StripNewlines::class],
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'options' => [
                        'break_chain_on_failure' => true,
                        'messages' => [
                          NotEmpty::IS_EMPTY => 'Title is not Empty',
                        ]
                    ]
                ],
               
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}