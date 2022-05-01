<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Models\Nutricionista;
use App\Models\Paciente;
use App\Models\User;
use Database\Factories\NutricionistaFactory;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\PseudoTypes\True_;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

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
        
        $paciente_equals = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();
        
        $user_equals = User::where('cpf', '=', '242.411.040-96')->first();
        assertEquals('242.411.040-96', $user_equals->cpf);
        assertEquals('Joaquina', $user_equals->nome);
        assertEquals('jn@email.com', $user_equals->email);
        assertEquals('(82)98877-6655', $user_equals->telefone_1);
        // assertTrue(true);

        // Limpando o banco
        // Paciente::destroy($paciente_equals->id);
        DB::table('pacientes')->where('id', $paciente_equals->id)->delete();
        DB::table('users')->where('id', $user_equals->id)->delete();
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
        DB::table('pacientes')->where('id', $paciente->id)->delete();
        DB::table('users')->where('id', $paciente->user_id)->delete();
        
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
        //  dd($user_nutri);
        // listando o paciente
        $nutricionista = Nutricionista::where('user_id', '=', $user_nutri->id)->first();
        $paciente = Paciente::where('nutricionista_id', '=', $nutricionista->id)
        ->orderBy('created_at', 'desc')->first();

        $response = $this->actingAs($user_nutri)->get('/view/paciente/'. $paciente->user_id);
        $this->assertEquals(200, $response->status());

        // Limpando o banco
        DB::table('pacientes')->where('id', $paciente->id)->delete();
        DB::table('users')->where('id', $paciente->user_id)->delete();
    }

    public function test_paciente_reset_password()
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
        $vetor['password'] = 'password';
        $vetor['password_confirmation'] = 'password';

        $this->actingAs($user_nutri)->post('/paciente/password', $vetor);
        
        $user_equals = User::find($paciente->user_id);
        assertTrue(Hash::check('password', $user_equals->password));
        
        // Limpando o banco
        DB::table('pacientes')->where('id', $paciente->id)->delete();
        DB::table('users')->where('id', $paciente->user_id)->delete();
    }


    public function test_teste()
    {
        $nutri = Nutricionista::factory(1)->create()[0];
        $nutri->user->cadastro_aprovado = 1;
        $nutri->user->save();

        $vetor = ['nome'=>'Joaquina', 
        'email'=>'jn.teste@email.com', 'cpf'=>'242.411.040-96',
        'telefone_1'=>'(82)98877-6655', 'telefone_2' => '(82)98877-6655',
        'sexo-select' => 'masculino','sexo-input' => null, 'obs' => null,
        'password'=>'12345678',  'password_confirmation' => '12345678',
         ];
        
        $user = User::find($nutri->user->id);
        
        // dd($user);
        $this->actingAs($user)->post('/paciente/create', $vetor);
        assertTrue(true);

        $paciente = Paciente::where('nutricionista_id', '=', $nutri->id)
        ->orderBy('created_at', 'desc')->first();
        
        // dd($nutri->id);
        DB::table('users')->where('id', $paciente->user_id)->delete();
        // DB::table('users')->where('id', $nutri->user_id)->delete();
    }

}
