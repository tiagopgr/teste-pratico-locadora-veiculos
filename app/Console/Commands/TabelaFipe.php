<?php

namespace App\Console\Commands;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class TabelaFipe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TabelaFipe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recupera dados da tabela Fipe';

    /**
     * @var int Código de referencia para consulta, por padrão os dados
     */
    protected $codigoReferencia = 264;

    /**
     * @var int[] Marcas permitidas
     */
    protected $marcasPermitidas = [6, 7, 161, 13, 21, 23, 25, 26, 39, 44, 56];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $request = Http::post('https://veiculos.fipe.org.br/api/veiculos//ConsultarTabelaDeReferencia');
        $this->codigoReferencia = $request->json()[0]["Codigo"];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->warn("Pesquisando na base de dados da tabela FIPE pelo código de referencia $this->codigoReferencia");

        /**
         * Recupera a lista de todas as marcas referentes ao ultimo código encontrado
         * e retorna um array com as informações
         */
        $marcas = $this->getMarcas();

        /**
         * Registra as marcas no banco de dados.
         */
        if ($marcas) {
            $this->registraMarcas($marcas);
        }

        /**
         * Percorre a lista de marcas e consulta todos os modelos referentes a cada marca e registra no banco de dados.
         */
        $this->getModelos();
        return 0;
    }

    /**
     * Recupera todos os modelos, lista as marcas e registra no banco de dados.
     */
    public function getModelos()
    {
        $marcas = Marca::all();
        foreach ($marcas as $marca) {

            $form_data = [
                "codigoTabelaReferencia" => $this->codigoReferencia,
                "codigoTipoVeiculo" => 1,
                "codigoMarca" => $marca->id,
            ];
            $request = Http::post('https://veiculos.fipe.org.br/api/veiculos//ConsultarModelos', $form_data);
            $modelos = $request->json();
            $this->registraModelos($marca, $modelos);
        }

    }

    /**
     * Registra as marcas recebidas no parametro $marcas
     * @param array $marcas
     */
    public function registraMarcas($marcas)
    {
        foreach ($marcas as $marca) {

            if (in_array($marca["Value"], $this->marcasPermitidas)) {
                $m = Marca::find($marca["Value"]);
                if (!$m) {

                    $create = Marca::create([
                        "id" => $marca["Value"],
                        "nome" => $marca["Label"]
                    ]);

                    if ($create) {
                        $this->info("Marca " . $marca["Label"] . " salva com sucesso");
                    } else {
                        $this->danger("Erro ao registrar marca: " . $marca["Label"]);
                    }
                }
            }
        }
    }

    /**
     * Resgata todas as marcas referentes ao codigo de referencia do tipo 1 = "CARROS"
     * @return array
     */
    public function getMarcas()
    {
        $form_data = [
            "codigoTabelaReferencia" => $this->codigoReferencia,
            "codigoTipoVeiculo" => 1
        ];
        $request = Http::post('https://veiculos.fipe.org.br/api/veiculos//ConsultarMarcas', $form_data);
        return $request->json();
    }

    public function processaModelos(Marca $marca)
    {
        $form_data = [
            "codigoTipoVeiculo" => 1,
            "codigoTabelaReferencia" => $this->codigoReferencia,
            "codigoMarca" => $marca->id,
        ];

        $request = Http::post('https://veiculos.fipe.org.br/api/veiculos//ConsultarModelos', $form_data);
        $modelos = collect($request->json());

        $this->registraModelos($marca, $modelos);

    }

    /**
     * Registra a os modelos relacionaados a marca.
     * @param Marca $marca
     * @param array $modelos
     */
    public function registraModelos(Marca $marca, $modelos)
    {

        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));


        foreach ($modelos["Modelos"] as $modelo) {

            if ($modelo["Value"] !== "") {


                if (!Modelo::find($modelo["Value"])) {
                    $data = [
                        "nome" => $modelo["Label"],
                        "id" => $modelo["Value"],
                        "placa" => trim($faker->vehicleRegistration("[A-Z]{3}-[0-9]{1}[A-Z]{1}[0-9]{2}")),
                        "ano" => mt_rand(2010, date("Y"))
                    ];
                    $create = $marca->modelos()->saveMany([new Modelo($data)]);
                    if ($create) {

                        $str = sprintf("Veículo %s de placa %s ano %s foi cadastrado com sucesso.",
                            $data["nome"], $data["placa"], $data["ano"]);
                        $this->info($str);
                    }
                }
            }
        }
    }

}
