<?php

namespace Fousky\Component\iDoklad\Functions\Contacts;

use Fousky\Component\iDoklad\Functions\iDokladAbstractFunction;
use Fousky\Component\iDoklad\Model\Contacts\ContactApiModel;
use Fousky\Component\iDoklad\Model\Contacts\ContactPostApiModel;

/**
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
class CreateContact extends iDokladAbstractFunction
{
    /** @var ContactPostApiModel $data */
    protected $data;

    /**
     * @param ContactPostApiModel $data
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(ContactPostApiModel $data)
    {
        $this->data = $data;

        $this->validate();
    }

    /**
     * Get iDokladModelInterface class.
     *
     * @see iDokladModelInterface
     *
     * @return string
     */
    public function getModelClass(): string
    {
        return ContactApiModel::class;
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
        return 'POST';
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
        return 'Contacts';
    }

    /**
     * Vrátí seznam parametrů, které se předají GuzzleHttp\Client.
     *
     * @see \GuzzleHttp\Client::request()
     * @see iDoklad::call()
     *
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function getGuzzleOptions(): array
    {
        return [
            'json' => $this->data->toArray(),
        ];
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function validate()
    {
        foreach ($this->data->getErrors() as $error) {
            throw new \InvalidArgumentException(sprintf(
                'Property %s of class %s is not valid - %s',
                $error->getPropertyPath(),
                get_class($this->data),
                $error->getMessage()
            ));
        }
    }
}
