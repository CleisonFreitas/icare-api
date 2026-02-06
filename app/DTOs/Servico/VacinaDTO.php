<?php

declare(strict_types=1);

namespace App\DTOs\Servico;

use App\DTOs\BaseDTO;
use App\Http\Requests\Servico\VacinaStoreRequest;
use App\Http\Requests\Servico\VacinaUpdateRequest;
use Carbon\Carbon;

readonly class VacinaDTO extends BaseDTO
{
    public function __construct(
        private readonly ?int $pet_id,
        private readonly string $nome,
        private readonly ?Carbon $data_administrada,
        private readonly ?int $aplicado_por,
        private readonly ?string $fabricante,
        private readonly ?int $dosagem,
        private readonly ?int $servico_id
    ) {}

    public static function fromApiRequest(VacinaStoreRequest|VacinaUpdateRequest $request): self
    {
        $dados = $request->validated();
        $dataAdministrada = data_get($dados, 'data_administrada');
        return new self(
            data_get($dados, 'pet_id'),
            data_get($dados, 'nome'),
            $dataAdministrada ? Carbon::parse($dataAdministrada) : null,
            data_get($dados, 'aplicado_por'),
            data_get($dados, 'fabricante'),
            data_get($dados, 'dosagem'),
            data_get($dados, 'servico_id'),
        );
    }
}
