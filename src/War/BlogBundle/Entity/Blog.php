<?php

namespace War\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Gedmo\Translatable\Translatable;

/** 
* Class Blog
* @ORM\Entity(repositoryClass="War\BlogBundle\Entity\Repository\BlogRepository")
* @ORM\Table(name="blog")
* @ORM\HasLifecycleCallbacks()
* @Gedmo\TranslationEntity(class="War\BlogBundle\Entity\Translation\BlogTranslation")
*/
class Blog implements Translatable
{
/* @Gedmo\Slug(fields={"title"}, updatable=false, separator="_")*/
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

/**
* @Gedmo\Translatable
* @ORM\Column(type="string")
*/
protected $title;

/**
* @ORM\Column(type="string", length=100)
*/
protected $author;

/**
* @Gedmo\Translatable
* @ORM\Column(type="text")
*/
protected $blog;

/**
* @ORM\Column(type="string", length=20)
*/
protected $image;

/**
* @ORM\Column(type="text")
*/
protected $tags;

/**
* @ORM\OneToMany(targetEntity="Comment", mappedBy="blog")
*/
protected $comments;

public function addComment(Comment $comment)
{
$this->comments[] = $comment;
}

public function getComments()
{
return $this->comments;
}

/**
* @ORM\Column(type="datetime")
*/
protected $created;

/**
* @ORM\Column(type="datetime")
*/
protected $updated;

/**
* @Gedmo\Slug(fields={"title"}, updatable=false, separator="_")
* @ORM\Column(type="string")
*/
protected $slug;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Blog
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->setSlug($this->title);
    //    return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Blog
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set blog
     *
     * @param string $blog
     *
     * @return Blog
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return string
     */
    public function getBlog($length = null)
    {
    if (false === is_null($length) && $length > 0)
    {return substr($this->blog, 0, $length);}
    else
    {return $this->blog;}
    }
    
    /**
     * Set image
     *
     * @param string $image
     *
     * @return Blog
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return Blog
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Blog
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Blog
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
    public function __construct()
    {
    $this->comments = new ArrayCollection();

    $this->setCreated(new \DateTime());
    $this->setUpdated(new \DateTime());
    }

    /**
    * @ORM\PreUpdate
    */
    public function setUpdatedValue()
    {
    $this->setUpdated(new \DateTime());
    }

    /**
     * Remove comment
     *
     * @param \War\BlogBundle\Entity\Comment $comment
     */
    public function removeComment(\War\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }
    
    public function __toString()
    {
    return $this->getTitle();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Blog
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);
        //$this->slug = $slug;
//        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function slugify($text)
    {
    // replace non or letter digits by -
    $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
    // trim
    $text = trim($text, '-');
    // transliterate
    if (function_exists('iconv'))
    {$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);}
    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('#[^-\w]+#', '', $text);
    if (empty($text)) { return 'n-a';}
    return $text;
    }

    /**
    *
    * @Gedmo\Locale
    */
    protected $locale;

    /**
     * Sets translatable locale
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }    
}
