<?php

namespace AppBundle\Entity\Portfolio;

use Nz\PortfolioBundle\Entity\BaseWork as BaseWork;

class Work extends BaseWork
{

    /**
     * @var int $id
     */
    protected $id;

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
}
