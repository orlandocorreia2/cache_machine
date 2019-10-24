<?php

namespace App\Http\Controllers;

use App\Domain\CacheMachineInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class CacheMachineController
 * @package App\Http\Controllers
 */
class CacheMachineController extends BaseController
{
    /**
     * @var CacheMachineInterface
     */
    private $cacheMachine;

    /**
     * CacheMachineController constructor.
     * @param CacheMachineInterface $cacheMachine
     */
    public function __construct(CacheMachineInterface $cacheMachine)
    {
        $this->cacheMachine = $cacheMachine;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateNotes(Request $request)
    {
        $notes = 'Preencha os campos corretamente';

        if ($request->availableNotes &&  $request->withdrawalAmount) {
            $notes = $this->cacheMachine->handle($request->availableNotes, $request->withdrawalAmount);
        }

        return view('cache_machine', compact('notes'));
    }
}

