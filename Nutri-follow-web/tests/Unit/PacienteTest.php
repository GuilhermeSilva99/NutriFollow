<?php

namespace Tests\Unit;

use App\Http\Controllers\PacienteController;
use App\Http\Requests\StorePacienteRequest;
use App\Models\Paciente;
use App\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;

class PacienteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_paciente()
    {
        $data = new StorePacienteRequest(['nome'=>'Maria da silva', 
    'email'=>'maria_silva@email.br', 'cpf'=>'898.332.440-68',
    'telefone_1'=>'(82)98877-6655', 'telefone_2' => '(82)98877-6655',
    'sexo-select' => 'masculino','sexo-input' => null, 'obs' => null,
    'password'=>'12345678',  'password_confirmation' => '12345678',
    ]);
    // dd($data);
        $pasciente = new PacienteController();
        $pasciente->storePaciente( $data);
     

        
        $this->assertTrue(true);
    }
}
