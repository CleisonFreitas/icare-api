<?php
namespace App\Enums\Servico;

enum StatusServicoEnum: string
{
    case PENDENTE = 'PENDENTE';
    case REALIZANDO = 'REALIZANDO';
    case REALIZADO = 'REALIZADO';
}