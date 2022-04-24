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
        
        $paciente = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();
        Paciente::destroy($paciente->id);
        User::destroy($paciente->user_id);
    }

    public function test_paciente_edit()
    {
        //ciando paciente
        $vetor = ['nome'=>'Joaquina', 
        'email'=>'jn.teste@email.com', 'cpf'=>'242.411.040-96',
        'telefone_1'=>'(82)98877-6655', 'telefone_2' => '(82)98877-6655',
        'sexo-select' => 'masculino','sexo-input' => null, 'obs' => null,
        'password'=>'12345678',  'password_confirmation' => '12345678',
         ];

        $user_nutri = User::where('tipo_usuario', '=', 2)->where('cadastro_aprovado', '=', 1)->first();
        $this->actingAs($user_nutri)->post('/paciente/create', $vetor);
        
        // editar pacente
        $nutricionista = Nutricionista::where('user_id', '=', $user_nutri->id)->first();
        $paciente = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();

        $vetor['id'] = $paciente->user_id;
        $vetor['nome'] = 'Joaquina da Silva';
        $vetor['cpf'] = '043.986.260-42';
        $vetor['email'] = 'jn.silva@email.com';
        $vetor['telefone_1'] = '(81)98877-6655';
        $vetor['telefone_2'] = '(81)98877-6600';
        $vetor['sexo-select'] = 'feminino';
        $vetor['obs'] = 'Teste edition';


        $this->actingAs($user_nutri)->post('/editar/paciente', $vetor);
        
        
        $paciente_equals = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();
        $user_equals = User::find($paciente_equals->user_id);
        assertEquals('Joaquina da Silva', $user_equals->nome);
        assertEquals('043.986.260-42', $user_equals->cpf);
        assertEquals('jn.silva@email.com', $user_equals->email);
        assertEquals('(81)98877-6655', $user_equals->telefone_1);
        assertEquals('(81)98877-6600', $user_equals->telefone_2);
        assertEquals('feminino', $paciente_equals->sexo);
        assertEquals('Teste edition', $paciente_equals->observacoes);
        
        // Limpando o banco
        Paciente::destroy($paciente->id);
        User::destroy($paciente->user_id);
    }

    public function test_paciente_view()
    {
        //ciando paciente
        $vetor = ['nome'=>'Joaquina', 
        'email'=>'jn.teste@email.com', 'cpf'=>'242.411.040-96',
        'telefone_1'=>'(82)98877-6655', 'telefone_2' => '(82)98877-6655',
        'sexo-select' => 'masculino','sexo-input' => null, 'obs' => null,
        'password'=>'12345678',  'password_confirmation' => '12345678',
         ];

        $user_nutri = User::where('tipo_usuario', '=', 2)->where('cadastro_aprovado', '=', 1)->first();
        $this->actingAs($user_nutri)->post('/paciente/create', $vetor);

        // listando o paciente
        $nutricionista = Nutricionista::where('user_id', '=', $user_nutri->id)->first();
        $paciente = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();

        $response = $this->actingAs($user_nutri)->get('/view/paciente/'. $paciente->user_id);
        $this->assertEquals(200, $response->status());

        // Limpando o banco
        Paciente::destroy($paciente->id);
        User::destroy($paciente->user_id);
    }
}
