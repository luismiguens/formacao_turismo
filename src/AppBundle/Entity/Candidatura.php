<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Candidatura
 */
class Candidatura {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Categoria
     */
    private $categoria;

    /**
     * @var \AppBundle\Entity\FosUser
     */
    private $fosUser;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $respostas;

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
     * @var string
     */
    private $promotorDescricaoPt;

    /**
     * @var string
     */
    private $promotorDescricaoEn;

    /**
     * @var string
     */
    private $documento;
    private $documentoFile;
    
    /**
     * @var string
     */
    private $cv;
    private $cvFile;
    
    
        /**
     * @var string
     */
    private $imagem;
        private $imagemFile;
    
    
    
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct() {
        $this->respostas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Candidatura
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null) {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * Set fosUser
     *
     * @param \AppBundle\Entity\User $fosUser
     *
     * @return Candidatura
     */
    public function setFosUser(\AppBundle\Entity\User $fosUser = null) {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getFosUser() {
        return $this->fosUser;
    }

    /**
     * Add resposta
     *
     * @param \AppBundle\Entity\Resposta $resposta
     *
     * @return Candidatura
     */
    public function addResposta(\AppBundle\Entity\Resposta $resposta) {


        $resposta->setCandidatura($this);
        $this->respostas->add($resposta);

        //$this->respostas[] = $resposta;

        return $this;
    }

    /**
     * Remove resposta
     *
     * @param \AppBundle\Entity\Resposta $resposta
     */
    public function removeResposta(\AppBundle\Entity\Resposta $resposta) {
        $this->respostas->removeElement($resposta);
    }

    /**
     * Get respostas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespostas() {
        return $this->respostas;
    }

    public function __toString() {
        return (string) $this->getId();
    }

    /**
     * Set promotorNome
     *
     * @param string $promotorNome
     *
     * @return Candidatura
     */
    public function setPromotorNome($promotorNome) {
        $this->promotorNome = $promotorNome;

        return $this;
    }

    /**
     * Get promotorNome
     *
     * @return string
     */
    public function getPromotorNome() {
        return $this->promotorNome;
    }

    /**
     * Set promotorProjecto
     *
     * @param string $promotorProjecto
     *
     * @return Candidatura
     */
    public function setPromotorProjecto($promotorProjecto) {
        $this->promotorProjecto = $promotorProjecto;

        return $this;
    }

    /**
     * Get promotorProjecto
     *
     * @return string
     */
    public function getPromotorProjecto() {
        return $this->promotorProjecto;
    }

    /**
     * Set promotorEmail
     *
     * @param string $promotorEmail
     *
     * @return Candidatura
     */
    public function setPromotorEmail($promotorEmail) {
        $this->promotorEmail = $promotorEmail;

        return $this;
    }

    /**
     * Get promotorEmail
     *
     * @return string
     */
    public function getPromotorEmail() {
        return $this->promotorEmail;
    }

    /**
     * Set promotorTelefone
     *
     * @param string $promotorTelefone
     *
     * @return Candidatura
     */
    public function setPromotorTelefone($promotorTelefone) {
        $this->promotorTelefone = $promotorTelefone;

        return $this;
    }

    /**
     * Get promotorTelefone
     *
     * @return string
     */
    public function getPromotorTelefone() {
        return $this->promotorTelefone;
    }

    /**
     * Set promotorDescricaoPt
     *
     * @param string $promotorDescricaoPt
     *
     * @return Candidatura
     */
    public function setPromotorDescricaoPt($promotorDescricaoPt) {
        $this->promotorDescricaoPt = $promotorDescricaoPt;

        return $this;
    }

    /**
     * Get promotorDescricaoPt
     *
     * @return string
     */
    public function getPromotorDescricaoPt() {
        return $this->promotorDescricaoPt;
    }

    /**
     * Set promotorDescricaoEn
     *
     * @param string $promotorDescricaoEn
     *
     * @return Candidatura
     */
    public function setPromotorDescricaoEn($promotorDescricaoEn) {
        $this->promotorDescricaoEn = $promotorDescricaoEn;

        return $this;
    }

    /**
     * Get promotorDescricaoEn
     *
     * @return string
     */
    public function getPromotorDescricaoEn() {
        return $this->promotorDescricaoEn;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return AgencyDocuments
     */
    public function setDocumento($documento) {
        $this->documento = $documento;

        if ($this->documento instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * Get certidaoPermanente
     *
     * @return string
     */
    public function getDocumento() {
        return $this->documento;
    }

    function getDocumentoFile() {
        return $this->documentoFile;
    }

    function setDocumentoFile(File $documento = null) {
        $this->documentoFile = $documento;


        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($documento) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    
        /**
     * Set cv
     *
     * @param string $cv
     *
     * @return AgencyDocuments
     */
    public function setCv($cv) {
        $this->cv = $cv;

        if ($this->cv instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }
    
        /**
     * Get 
     *
     * @return string
     */
    public function getCv() {
        return $this->cv;
    }

    function getCvFile() {
        return $this->cvFile;
    }

    function setCvFile(File $cv = null) {
        $this->cvFile = $cv;


        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($cv) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
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

    
    
}
