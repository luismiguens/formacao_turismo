<?php

namespace AppBundle\Entity;

/**
 * Criterio
 */
class Criterio
{
    /**
     * @var string
     */
    private $tituloPt;

    /**
     * @var string
     */
    private $tituloEn;

    /**
     * @var string
     */
    private $descricaoPt;

    /**
     * @var string
     */
    private $descricaoEn;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Categoria
     */
    private $categoria;

 
    
    
    /**
     * Set tituloPt
     *
     * @param string $tituloPt
     *
     * @return Criterio
     */
    public function setTituloPt($tituloPt)
    {
        $this->tituloPt = $tituloPt;

        return $this;
    }

    /**
     * Get tituloPt
     *
     * @return string
     */
    public function getTituloPt()
    {
        return $this->tituloPt;
    }

    /**
     * Set tituloEn
     *
     * @param string $tituloEn
     *
     * @return Criterio
     */
    public function setTituloEn($tituloEn)
    {
        $this->tituloEn = $tituloEn;

        return $this;
    }

    /**
     * Get tituloEn
     *
     * @return string
     */
    public function getTituloEn()
    {
        return $this->tituloEn;
    }

    /**
     * Set descricaoPt
     *
     * @param string $descricaoPt
     *
     * @return Criterio
     */
    public function setDescricaoPt($descricaoPt)
    {
        $this->descricaoPt = $descricaoPt;

        return $this;
    }

    /**
     * Get descricaoPt
     *
     * @return string
     */
    public function getDescricaoPt()
    {
        return $this->descricaoPt;
    }

    /**
     * Set descricaoEn
     *
     * @param string $descricaoEn
     *
     * @return Criterio
     */
    public function setDescricaoEn($descricaoEn)
    {
        $this->descricaoEn = $descricaoEn;

        return $this;
    }

    /**
     * Get descricaoEn
     *
     * @return string
     */
    public function getDescricaoEn()
    {
        return $this->descricaoEn;
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
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Criterio
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    
    
    public function __toString() {
        
        return $this->getTituloPt();
        
    }
    
}

