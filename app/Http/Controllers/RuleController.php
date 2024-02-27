<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleFormRequest;
use App\Models\Rule;
use App\RepositoryInterfaces\RuleRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class RuleController extends Controller
{
    protected RuleRepositoryInterface $ruleRepository;
    public function __construct(RuleRepositoryInterface $ruleRepository)
    {
        $this->ruleRepository = $ruleRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $rules = $this->ruleRepository->getAllModel();
        return view('rules.index', compact('rules'));
    }

    /**
     * @param Rule|int $ruleId
     * @return View
     */
    public function show(Rule|int $ruleId): View
    {
        $product = $this->ruleRepository->getModelByid($ruleId);
        return view('rules.show', compact('product'));
    }

    /**
     * @param RuleFormRequest $ruleDetails
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(RuleFormRequest $ruleDetails): RedirectResponse
    {
        $this->ruleRepository->createModel($ruleDetails->safe()->toArray());
        return redirect()->route('rules.index');
    }

    /**
     * @param RuleFormRequest $ruleDetails
     * @param Rule|int $ruleId
     * @return RedirectResponse
     */
    public function update(RuleFormRequest $ruleDetails, Rule|int $ruleId): RedirectResponse
    {
        $this->ruleRepository->updateModel($ruleDetails->safe()->toArray(), $ruleId);
        return redirect()->route('rules.index');
    }

    /**
     * @param Rule|int $ruleId
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Rule|int $ruleId): RedirectResponse
    {
        $this->ruleRepository->deleteModel($ruleId);
        return redirect()->route('rules.index');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('rules.create');
    }

    /**
     * @param Rule|int $ruleId
     * @return View
     */
    public function edit(Rule|int $ruleId): View
    {
        $rule = $this->ruleRepository->getModelByid($ruleId);
        return view('rules.edit', compact('rule'));
    }
}
