<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TbOsRepository")
 */
class TbOs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $sequence;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $desconto;

    /**
     * @ORM\Column(type="float")
     */
    private $valor_total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_servico;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TbTecnicos")
     * @ORM\JoinColumn(name="tecnico_id", referencedColumnName="id", nullable=false)
     */
    private $tecnico;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TbFerramentas")
     * @ORM\JoinTable(name="tb_os_tb_ferramentas",
     *      joinColumns={@ORM\JoinColumn(name="os_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ferramenta_id", referencedColumnName="cod_ferramenta")}
     *      )
     * @Assert\Count(
     *      min = 1,
     *      minMessage = "ferramenta.one_least"
     * )
     */
    private $ferramentas;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TbServicos")
     * @ORM\JoinColumn(name="servicos_id", referencedColumnName="id", nullable=false)
     */
    private $servicos;

    public function __construct()
    {
        $this->ferramentas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSequence(): ?string
    {
        return $this->sequence;
    }

    public function setSequence(string $sequence): self
    {
        $this->sequence = $sequence;

        return $this;
    }

    public function getDesconto(): ?float
    {
        return $this->desconto;
    }

    public function setDesconto(float $desconto): self
    {
        $this->desconto = $desconto;

        return $this;
    }

    public function getValorTotal(): ?float
    {
        return $this->valor_total;
    }

    public function setValorTotal(float $valor_total): self
    {
        $this->valor_total = $valor_total;

        return $this;
    }

    public function getDataServico(): ?\DateTimeInterface
    {
        return $this->data_servico;
    }

    public function setDataServico(\DateTimeInterface $data_servico): self
    {
        $this->data_servico = $data_servico;

        return $this;
    }

    public function getTecnico(): ?TbTecnicos
    {
        return $this->tecnico;
    }

    public function setTecnico(TbTecnicos $tecnico): self
    {
        $this->tecnico = $tecnico;

        return $this;
    }

    /**
     * @return Collection|TbFerramentas[]
     */
    public function getFerramentas(): Collection
    {
        return $this->ferramentas;
    }

    public function addFerramenta(TbFerramentas $ferramenta): self
    {
        if (!$this->ferramentas->contains($ferramenta)) {
            $this->ferramentas[] = $ferramenta;
        }

        return $this;
    }

    public function removeFerramenta(TbFerramentas $ferramenta): self
    {
        if ($this->ferramentas->contains($ferramenta)) {
            $this->ferramentas->removeElement($ferramenta);
        }

        return $this;
    }

    public function getServicos(): ?TbServicos
    {
        return $this->servicos;
    }

    public function setServicos(TbServicos $servicos): self
    {
        $this->servicos = $servicos;

        return $this;
    }
}
