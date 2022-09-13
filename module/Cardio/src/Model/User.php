<?php
namespace Cardio\Model;

use Laminas\Db\Sql\Ddl\Column\BigInteger;
use Laminas\Db\Sql\Ddl\Column\Boolean;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Mvc\Exception\DomainException;
use Laminas\Validator\StringLength;

class User implements InputFilterAwareInterface{

    public $id;
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $isAdmin;
    public $idClinic;

    private $inputFilter;

    public function exchangeArray(array $data){
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->username     = !empty($data['username']) ? $data['username'] : null;
        $this->password     = !empty($data['password']) ? $data['password'] : null;
        $this->firstName     = !empty($data['firstName']) ? $data['firstName'] : null;
        $this->lastName     = !empty($data['lastName']) ? $data['lastName'] : null;
        $this->isAdmin     = !empty($data['isAdmin']) ? $data['isAdmin'] : null;
        $this->idClinic     = !empty($data['idClinic']) ? $data['idClinic'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter){
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter(){
        if($this->inputFilter){
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => BigInteger::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'username',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'firstName',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'lastName',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'isAdmin',
            'required' => true,
            'filters' => [
                ['name' => Boolean::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'idClinic',
            'required' => true,
            'filters' => [
                ['name' => BigInteger::class],
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}