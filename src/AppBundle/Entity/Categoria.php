<?php

namespace AppBundle\Entity;


use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Categoria
 */
class Categoria
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
     * @var string
     */
    private $imagem;
        private $imagemFile;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Candidatura
     */
    private $candidaturaVencedora;


    
       /**
     * @var string
     */
    private $promotorNome;

    /**
     * @var string
     */
    private $promotorProjecto;

    /**
     * @var string
     */
    private $promotorEmail;

    /**
     * @var string
     */
    private $promotorTelefone;


    
         /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $criterios;
    
    
      private $updatedAt;

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
    
    /**
     * Set tituloPt
     *
     * @param string $tituloPt
     *
     * @return Categoria
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
     * @return Categoria
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
     * @return Categoria
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
     * @return Categoria
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

    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imagem instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }


        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function setImagemFile(File $imagem = null) {
        $this->imagemFile = $imagem;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imagem) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImagemFile() {
        return $this->imagemFile;
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
     * Set candidaturaVencedora
     *
     * @param \AppBundle\Entity\Candidatura $candidaturaVencedora
     *
     * @return Categoria
     */
    public function setCandidaturaVencedora(\AppBundle\Entity\Candidatura $candidaturaVencedora = null)
    {
        $this->candidaturaVencedora = $candidaturaVencedora;

        return $this;
    }

    /**
     * Get candidaturaVencedora
     *
     * @return \AppBundle\Entity\Candidatura
     */
    public function getCandidaturaVencedora()
    {
        return $this->candidaturaVencedora;
    }
 
    /**
     * Set promotorNome
     *
     * @param string $promotorNome
     *
     * @return Categoria
     */
    public function setPromotorNome($promotorNome)
    {
        $this->promotorNome = $promotorNome;

        return $this;
    }

    /**
     * Get promotorNome
     *
     * @return string
     */
    public function getPromotorNome()
    {
        return $this->promotorNome;
    }

    /**
     * Set promotorProjecto
     *
     * @param string $promotorProjecto
     *
     * @return Categoria
     */
    public function setPromotorProjecto($promotorProjecto)
    {
        $this->promotorProjecto = $promotorProjecto;

        return $this;
    }

    /**
     * Get promotorProjecto
     *
     * @return string
     */
    public function getPromotorProjecto()
    {
        return $this->promotorProjecto;
    }

    /**
     * Set promotorEmail
     *
     * @param string $promotorEmail
     *
     * @return Categoria
     */
    public function setPromotorEmail($promotorEmail)
    {
        $this->promotorEmail = $promotorEmail;

        return $this;
    }

    /**
     * Get promotorEmail
     *
     * @return string
     */
    public function getPromotorEmail()
    {
        return $this->promotorEmail;
    }

    /**
     * Set promotorTelefone
     *
     * @param string $promotorTelefone
     *
     * @return Categoria
     */
    public function setPromotorTelefone($promotorTelefone)
    {
        $this->promotorTelefone = $promotorTelefone;

        return $this;
    }

    /**
     * Get promotorTelefone
     *
     * @return string
     */
    public function getPromotorTelefone()
    {
        return $this->promotorTelefone;
    }
    
    
    
    public function __toString() {
        return $this->getTituloPt();
    }
    
    
    
    
    /**
     * Add criterio
     *
     * @param \AppBundle\Entity\Criterio $criterio
     *
     * @return Candidatura
     */
    public function addCriterio(\AppBundle\Entity\Criterio $criterio)
    {
       
        
        $criterio->setCategoria($this);
         $this->criterios->add($criterio);
        
        //$this->criterios[] = $criterio;

        return $this;
    }

    /**
     * Remove criterio
     *
     * @param \AppBundle\Entity\Criterio $criterio
     */
    public function removeCriterio(\AppBundle\Entity\Criterio $criterio)
    {
        $this->criterios->removeElement($criterio);
    }

    /**
     * Get criterios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCriterios()
    {
        return $this->criterios;
    }
    
    
    
    
}
