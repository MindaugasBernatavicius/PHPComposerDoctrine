<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="students")
 */
class Student
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * One Student has One Mentor.
     * @ORM\OneToOne(targetEntity="Student")
     * @ORM\JoinColumn(name="mentor_id", referencedColumnName="id")
     */
    private $mentor;
}