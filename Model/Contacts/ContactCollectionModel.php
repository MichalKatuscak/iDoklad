<?php

namespace Fousky\Component\iDoklad\Model\Contacts;

use Doctrine\Common\Collections\ArrayCollection;
use Fousky\Component\iDoklad\Exception\InvalidResponseException;
use Fousky\Component\iDoklad\Model\iDokladAbstractModel;
use Fousky\Component\iDoklad\Model\iDokladModelInterface;
use Fousky\Component\iDoklad\Util\ResponseUtil;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
class ContactCollectionModel extends iDokladAbstractModel
{
    /** @var ContactApiModel[]|ArrayCollection $Data */
    protected $Data;

    /** @var int $TotalItems */
    protected $TotalItems = 0;

    /** @var int $TotalPages */
    protected $TotalPages = 0;

    public function __construct()
    {
        $this->Data = new ArrayCollection();
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws \RuntimeException
     * @throws InvalidResponseException
     *
     * @return iDokladModelInterface
     */
    public static function createFromResponse(ResponseInterface $response): iDokladModelInterface
    {
        $responseData = (array) ResponseUtil::handle($response);

        if (!array_key_exists('Data', $responseData)) {
            throw new InvalidResponseException();
        }

        $model = new static();
        $items = new ArrayCollection();

        foreach ($responseData['Data'] as $index => $contact) {
            $items->add(ContactApiModel::createFromStd($contact));
        }

        $model->Data = $items;
        $model->TotalPages = $responseData['TotalPages'];
        $model->TotalItems = $responseData['TotalItems'];

        return $model;
    }
}