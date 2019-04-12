<?php

namespace AppBundle\Entity;

/**
 * Votacao
 */
class Votacao
{
    /**
     * @var integer
     */
    private $respostaId;

    /**
     * @var integer
     */
    private $pontuacao;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\FosUser
     */
    private $fosUser;

    
    
      
         /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $votos;
    

    
      /**
     * Constructor
     */
    public function __construct()
    {
        $this->votos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    
    

    /**
     * Set respostaId
     *
     * @param integer $respostaId
     *
     * @return Votacao
     */
    public function setRespostaId($respostaId)
    {
        $this->respostaId = $respostaId;

        return $this;
    }

    /**
     * Get respostaId
     *
     * @return integer
     */
    public function getRespostaId()
    {
        return $this->respostaId;
    }

    /**
     * Set pontuacao
     *
     * @param integer $pontuacao
     *
     * @return Votacao
     */
    public function setPontuacao($pontuacao)
    {
        $this->pontuacao = $pontuacao;

        return $this;
    }

    /**
     * Get pontuacao
     *
     * @return integer
     */
    public function getPontuacao()
    {
        return $this->pontuacao;
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
     * Set fosUser
     *
     * @param \AppBundle\Entity\FosUser $fosUser
     *
     * @return Votacao
     */
    public function setFosUser(\AppBundle\Entity\User $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \AppBundle\Entity\FosUser
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }
    /**
     * @var \AppBundle\Entity\Candidatura
     */
    private $candidatura;


    /**
     * Set candidatura
     *
     * @param \AppBundle\Entity\Candidatura $candidatura
     *
     * @return Votacao
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
    
    
    
    
      
    
    /**
     * Add voto
     *
     * @param \AppBundle\Entity\Voto $voto
     *
     * @return Candidatura
     */
    public function addVoto(\AppBundle\Entity\Voto $voto)
    {
       
        
        $voto->setVotacao($this);
         $this->votos->add($voto);
        
        //$this->votos[] = $voto;

        return $this;
    }

    /**
     * Remove voto
     *
     * @param \AppBundle\Entity\Voto $voto
     */
    public function removeVoto(\AppBundle\Entity\Voto $voto)
    {
        $this->votos->removeElement($voto);
    }

    /**
     * Get votos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotos()
    {
        return $this->votos;
    }
    
    
    
    
    
}
