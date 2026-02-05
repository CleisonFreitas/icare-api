<?php

namespace App\Enums\Servico;

enum StatusSolicitacaoEnum: string
{
    case PENDENTE = 'PENDENTE';
    case EM_TRAMITE = 'EM_TRAMITE';
    case RESOLVIDO = 'RESOLVIDO';
}
