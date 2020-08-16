<?php

namespace ApplicationTest\Entity;

use Application\Entity\Developer;
use PHPUnit\Framework\TestCase;

class DeveloperTest extends TestCase
{
    protected $traceError = true;

    public function testInitialDeveloperValuesAreNull()
    {
        $developer = new Developer();

        $this->assertNull($developer->getDatanascimento());
        $this->assertNull($developer->getHobby());
        $this->assertNull($developer->getId());
        $this->assertNull($developer->getIdade());
        $this->assertNull($developer->getNome());
        $this->assertNull($developer->getSexo());
    }

    public function testDeveloperSetters()
    {
        $developer = new Developer();
        $data = [
            'nome' => 'nome',
            'idade' => 1,
            'datanascimento' => '2000-02-02',
            'hobby' => 'develop',
            'sexo' => 'M',
            'id' => 1,
        ];

        $developer->setDatanascimento(\DateTime::createFromFormat('Y-m-d', $data['datanascimento']));
        $developer->setIdade($data['idade']);
        $developer->setHobby($data['hobby']);
        $developer->setId($data['id']);
        $developer->setNome($data['nome']);
        $developer->setSexo($data['sexo']);

        $this->assertSame($data['datanascimento'], $developer->getDatanascimento());
        $this->assertSame($data['idade'], $developer->getIdade());
        $this->assertSame($data['hobby'], $developer->getHobby());
        $this->assertSame($data['id'], $developer->getId());
        $this->assertSame($data['nome'], $developer->getNome());
        $this->assertSame($data['sexo'], $developer->getSexo());
    }


}