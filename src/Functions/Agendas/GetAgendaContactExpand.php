<?php

namespace Fousky\Component\iDoklad\Functions\Agendas;

use Fousky\Component\iDoklad\Functions\iDokladAbstractFunction;
use Fousky\Component\iDoklad\Model\Agendas\ContactApiModelExpand;

/**
 * @author Lukáš Brzák <lukas.brzak@aquadigital.cz>
 */
class GetAgendaContactExpand extends iDokladAbstractFunction
{
    /**
     * Get iDokladModelInterface class.
     *
     * @see iDokladModelInterface
     *
     * @return string
     */
    public function getModelClass(): string
    {
        return ContactApiModelExpand::class;
    }

    /**
     * GET|POST|PUT|DELETE e.g.
     *
     * @see iDoklad::request()
     *
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * Return base URI, e.g. /invoices; /invoice/1/edit and so on.
     *
     * @see iDoklad::call()
     *
     * @return string
     */
    public function getUri(): string
    {
        return 'Agendas/GetAgendaContactExpand';
    }

    /**
     * Vrátí seznam parametrů, které se předají GuzzleHttp\Client
     *
     * @see \GuzzleHttp\Client::request()
     * @see iDoklad::call()
     *
     * @return array
     */
    public function getGuzzleOptions(): array
    {
        return [];
    }
}