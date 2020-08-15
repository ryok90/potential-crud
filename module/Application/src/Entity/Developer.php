<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;
/**
 * @ORM\Entity(repositoryClass="Application\Repository\DeveloperRepository")
 * @ORM\Table(name="developer")
 */
class Developer
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(name="nome", type="string", length=64, nullable=false)
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(name="sexo", columnDefinition="CHAR(2)")
     * @var string
     */
    protected $sexo;

    /**
     * @ORM\Column(name="idade", type="integer", nullable=true)
     * @var int
     */
    protected $idade;

    /**
     * @ORM\Column(name="hobby", type="string", length=64, nullable=true)
     * @var string
     */
    protected $hobby;

    /**
     * @ORM\Column(name="datanascimento", type="date", nullable=true)
     * @var DateTime
     */
    protected $datanascimento;

    /**
     * @return DateTime
     */
    public function getDatanascimento($format = 'Y-m-d')
    {
        if ($this->datanascimento instanceof DateTime && !empty($format)) {
            return $this->datanascimento->format($format);
        }
        return $this->datanascimento;
    }

    /**
     * @param DateTime $datanascimento
     */
    public function setDatanascimento($datanascimento)
    {
        $this->datanascimento = $datanascimento;
    }

    /**
     * @return string
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * @param string $hobby
     */
    public function setHobby($hobby)
    {
        $this->hobby = $hobby;
    }

    /**
     * @return int
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param int $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer  $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
