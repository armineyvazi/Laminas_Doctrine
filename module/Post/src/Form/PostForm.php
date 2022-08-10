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



class PostForm extends Form
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
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Title must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your Title',
            ]
        ]);
        $this->add([
            'name' => 'category',
            'type' => 'text',
            'options' => [
                'label' => 'Category',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Username must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your Category',
            ]
        ]);
        $this->add([
            'name' => 'description',
            'type' => 'text',
            'options' => [
                'label' => 'description',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Discription must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your description',
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id' => 'submitbutton',
            ],
        ]);
    }
    private function validator()
    {
        $inputFilter = new InputFilter;
        $this->setInputFilter($inputFilter);
        $inputFilter->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StringToLower'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
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
                [
                    'name' => 'StringLength',
                    'options' => [
                        'break_chain_on_failure' => true,
                        'min' => 2,
                        'max' => 50,
                        'messages' => [
                            StringLength::TOO_SHORT => 'String is more than %min% ',
                            StringLength::TOO_LONG => 'String most be down than %max%'
                        ]
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'category',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StringToLower'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'category is not Empty',
                        ]
                    ]
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'min' => 3,
                        'max' => 50,
                        'messages' => [
                            StringLength::TOO_SHORT => 'String is more than %mnin% ',
                            StringLength::TOO_LONG => 'String most be down than %max%'
                        ]
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'description',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StringToLower'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'description is not Empty',
                        ]
                    ]
                ],
                [
                    'name' => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'min' => 3,
                        'max' => 50,
                        'messages' => [
                            StringLength::TOO_SHORT => 'String is more than %mnin% ',
                            StringLength::TOO_LONG => 'String most be down than %max%'
                        ]
                    ],
                ],
            ],
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;

    }
}