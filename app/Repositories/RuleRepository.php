<?php

namespace App\Repositories;

use App\Models\Rule;
use App\RepositoryInterfaces\RuleRepositoryInterface;

class RuleRepository extends BaseRepository implements RuleRepositoryInterface
{
    public function __construct(Rule $rule)
    {
        parent::__construct($rule);
    }
}
