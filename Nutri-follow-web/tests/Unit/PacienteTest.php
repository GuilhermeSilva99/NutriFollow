<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Models\Nutricionista;
use App\Models\Paciente;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use function PHPUnit\Framework\assertEquals;

class PacienteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_paciente_create()
    {
        $vetor = ['nome'=>'Joaquina', 
            'email'=>'jn@email.com', 'cpf'=>'242.411.040-96',
            'telefone_1'=>'(82)98877-6655', 'telefone_2' => '(82)98877-6655',
            'sexo-select' => 'masculino','sexo-input' => null, 'obs' => null,
            'password'=>'12345678',  'password_confirmation' => '12345678',
        ];

        $user = User::where('tipo_usuario', '=', 2)->where('cadastro_aprovado', '=', 1)->first();
        $this->actingAs($user)->post('/paciente/create', $vetor);

        $nutricionista = Nutricionista::where('user_id', '=', $user->id)->first();
        $user_equals = User::where('cpf', '=', '242.411.040-96')->first();

        assertEquals('242.411.040-96', $user_equals->cpf);

        // Limpando o banco
        
        // $paciente = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        // ->orderBy('created_at', 'desc')->first();
        // Paciente::destroy($paciente->id);
        // User::destroy($paciente->user_id);
    }

    public function test_paciente_edit()
    {
        //ciando paciente
        $vetor = ['nome'=>'Joaquina', 
        'email'=>'jn@email.com', 'cpf'=>'242.411.040-96',
        'telefone_1'=>'(82)98877-6655', 'telefone_2' => '(82)98877-6655',
        'sexo-select' => 'masculino','sexo-input' => null, 'obs' => null,
        'password'=>'12345678',  'password_confirmation' => '12345678',
         ];
        $user_nutri = User::where('tipo_usuario', '=', 2)->where('cadastro_aprovado', '=', 1)->first();
        $response = $this
            ->actingAs($user_nutri)
            ->post('/paciente/create', $vetor);
        
        // editar pacente
        $nutricionista = Nutricionista::where('user_id', '=', $user_nutri->id)->first();
        $paciente = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();

        $vetor['obs'] = 'Teste edite';
        $vetor['id'] = $paciente->user_id;
        $response = $this
        ->actingAs($user_nutri)
        ->post('/editar/paciente', $vetor);
        
        
        $paciente_equals = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();
        assertEquals('Teste edite', $paciente_equals->observacoes);
        
        // Limpando o banco
        Paciente::destroy($paciente->id);
        User::destroy($paciente->user_id);
    }
}
