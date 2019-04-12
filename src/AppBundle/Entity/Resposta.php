<?php

namespace AppBundle\Entity;

/**
 * Resposta
 */
class Resposta
{
    /**
     * @var string
     */
    private $texto;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Criterio
     */
    private $criterio;

    /**
     * @var \AppBundle\Entity\Candidatura
     */
    private $candidatura;


    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Resposta
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

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
     * Set criterio
     *
     * @param \AppBundle\Entity\Criterio $criterio
     *
     * @return Resposta
     */
    public function setCriterio(\AppBundle\Entity\Criterio $criterio = null)
    {
        $this->criterio = $criterio;

        return $this;
    }

    /**
     * Get criterio
     *
     * @return \AppBundle\Entity\Criterio
     */
    public function getCriterio()
    {
        return $this->criterio;
    }

    /**
     * Set candidatura
     *
     * @param \AppBundle\Entity\Candidatura $candidatura
     *
     * @return Resposta
     */
    public function setCandidatura(\AppBundle\Entity\Candidatura $candidatura = null)
    {
               
        $this->candidatura = $candidatura;

        return $this;
    }

    /**
     * Get candidatura
     *
     * @return \AppBundle\Entity\Candidatura
     */
    public function getCandidatura()
    {
        return $this->candidatura;
    }
    
    
    
    public function __toString() {
        return (string)$this->getId();
    }
}

