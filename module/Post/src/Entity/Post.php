<?php


namespace Post\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Input\Input;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\Validator\StringLength;

use DomainException;

/**
 * This class represents a single post in a blog.
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")   
     */
    protected $id;
    /** 
     * @ORM\Column(name="title",type="string")  
     */
    protected $title;
    /** 
     * @ORM\Column(name="category",type="string")  
     */
    protected $category;
    /** 
     * @ORM\Column(name="description",type="string")  
     */
    protected $description;
    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
        $this->category = !empty($data['category']) ? $data['category'] : null;
        $this->description = !empty($data['description']) ? $data['description'] : null;

    }
    public function setInputFilter(InputFilterInterface $inputFilterInterface)
    {
        throw new DomainException(\sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }
    public function getArrayCopy()
    {
        return
        [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'description' => $this->description,
        ];
    }
    // Returns ID of this post.
    public function getId()
    {
        return $this->id;
    }
    // Returns title.
    public function getTitle()
    {
        return $this->title;
    }
    // Sets title.
    public function setTitle($title)
    {
        $this->title = $title;
    }
    // Returns Category.
    public function getCategory()
    {
        return $this->category;
    }
    // Set Category.
    public function setCategory($category)
    {
        $this->category = $category;
    }
    // Get Descriptions
    public function getDescription()
    {
        return $this->description;
    }
    // Set Description
    public function setDescription($description)
    {
        $this->description = $description;
    }

}