<?php

namespace App\Domain;

use Illuminate\Support\Str;

/**
 * Class CacheMachine
 * @package App\Domain
 */
class CacheMachine implements CacheMachineInterface
{
    /**
     * @var
     */
    private $availableNotes;

    /**
     * @var
     */
    private $withdrawalAmount;

    /**
     * @var array
     */
    private $notesDescriptionArray = [];

    /**
     * @var
     */
    private $notesDescriptionResponse = 'A(s) nota(s) disponíveis são maiores que o valor do saque';

    /**
     * @param $availableNotes
     * @param $withdrawalAmount
     * @return mixed
     */
    public function handle($availableNotes, $withdrawalAmount)
    {
        $this->availableNotes = $availableNotes;
        $this->withdrawalAmount = $withdrawalAmount;

        $this->generateAvailableNotesArray();
        $this->orderAvailableNotesDesc();
        $this->fillNotesDescriptionArray();
        $this->generateNotesDescription();
        $this->generateObservationIfRestWithdrawalAmount();

        return $this->notesDescriptionResponse;
    }

    /**
     *
     */
    private function generateAvailableNotesArray()
    {
        $this->availableNotes = explode(',', $this->availableNotes);
    }

    /**
     *
     */
    private function orderAvailableNotesDesc()
    {
        arsort($this->availableNotes);
    }

    /**
     *
     */
    private function fillNotesDescriptionArray()
    {
        if ($this->availableNotes && count($this->availableNotes)) {
            foreach ($this->availableNotes as $availableNote) {
                $this->addNotesDescriptionArray($availableNote);
            }
        }
    }

    /**
     * @param $note
     */
    private function addNotesDescriptionArray($note)
    {
        if ($note <= $this->withdrawalAmount) {
            $qtdNotes = (int) ($this->withdrawalAmount / $note);
            $notaPlural = Str::plural('nota', $qtdNotes);
            $this->notesDescriptionArray[] = $qtdNotes . ' ' .  $notaPlural . ' de ' . $note;
            $this->subtractWithdrawalAmountValue($qtdNotes * $note);
        }
    }

    /**
     * @param $value
     */
    private function subtractWithdrawalAmountValue($value)
    {
        $this->withdrawalAmount -= $value;
    }

    /**
     *
     */
    private function generateNotesDescription()
    {

        if ($this->notesDescriptionArray && count($this->notesDescriptionArray)) {
            $this->notesDescriptionResponse =  implode(', ', $this->notesDescriptionArray);
            $this->replaceLastCommaCharacterForE();
        }
    }

    /**
     *
     */
    private function replaceLastCommaCharacterForE()
    {
        $lastCommaPosition = strrpos($this->notesDescriptionResponse, ',');
        if ($lastCommaPosition) {
            $description = $this->notesDescriptionResponse;
            $this->notesDescriptionResponse = substr($description, 0, $lastCommaPosition);
            $this->notesDescriptionResponse .= ' e';
            $this->notesDescriptionResponse .= substr($description, $lastCommaPosition + 1, strlen($description));
        }
    }

    /**
     *
     */
    public function generateObservationIfRestWithdrawalAmount()
    {
        if ($this->notesDescriptionArray && count($this->notesDescriptionArray) && $this->withdrawalAmount > 0) {
            $this->notesDescriptionResponse .= '. Observação: sobrou ' .$this->withdrawalAmount . ' adicione mais notas para gerar o resultado correto';
        }
    }
}
